<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\Api\pivotService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Validation\Rules\Can;

class OrderController extends Controller
{
    protected $apiService;
    protected $paymentService;


    public function __construct(PaymentService $paymentService, pivotService $apiService)
    {
        $this->paymentService = $paymentService;
        $this->apiService = $apiService;
    }

    public function index($order_number)
    {
        $order = Order::with('orderItems')->where('order_number', $order_number)->firstOrFail();

        return view('frontend.order.index', [
            'order' => $order
        ]);
    }

    public function payment_pivot($order_number)
    {
        $order = Order::with('orderItems')->where('order_number', $order_number)->firstOrFail();

        $response = $this->apiService->redirectPayment($order);

        if ($response->getStatusCode() == 200) {
            $body = $response->getData();
            $data = $body->data;

            $payload = json_encode($body);

            $this->paymentService->store([
                'order_number' => $data->clientReferenceId,
                'transaction_id' => $data->id,
                'currency' => $data->amount->currency,
                'amount' => $data->amount->value,
                'status' => $data->status,
                'payment_url' => $data->paymentUrl,
                'payload' => $payload,
            ]);

            return redirect()->to($data->paymentUrl);
        }else {
            return redirect()->back()->with('error', "The request was invalid, or an error occurred in downstream provider");
        }
    }

    public function payment($order_number)
    {
        $this->setupMidtransConfig();

        try {
            $order = Order::with('orderItems')->where('order_number', $order_number)->firstOrFail();

            $user = auth()->user();


            $transaction_details = [
                'order_id' => $order->order_number,
                'gross_amount' => $order->total_amount,
            ];

            $item_details = [];

            foreach ($order->orderItems as $item) {
                $package = Package::where('id', $item->package_id)->first();
                $item_details[] = [
                    'id' => $item->package_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'name' => $package->title . ' - ' . $package->category->name,
                ];
            }

            $customer_details = [
                'first_name'    => $user->name,
                'email'         => $user->email,
                'phone'         => $user->phone,
            ];

            $transaction = [
                'transaction_details' => $transaction_details,
                'item_details' => $item_details,
                'customer_details' => $customer_details,
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            return view('frontend.order.payment', compact('snapToken', 'order'));

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('frontend.user.transaction.index');

        }
    }

    public function paymentStore(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $order = Order::where('order_number', $data['order_id'])->firstOrFail();
            $order->status = 'paid';
            $order->save();

            $payment = $this->createPayment($data);

            $this->createSubscription($order->orderItems);
        }catch (\Exception $e) {
            DB::rollBack();
        }
        DB::commit();

        return response()->json(['success' => true, 'message' => 'Payment successful', 'data' => $payment]);
    }

    public function paymentStatus(Request $request)
    {
        $order = Order::where('order_number', $request->input('order_id'))->firstOrFail();

        if ($order->status != 'paid') {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $order->order_number . '/status', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents());

            if ($data->status_code == 200) {
                if (in_array($data->transaction_status, ['capture', 'settlement'])) {

                    DB::beginTransaction();
                    try {
                        $order->status = 'paid';
                        $order->save();
                        $payment = $this->createPayment((array) $data);
                        $this->createSubscription($order->orderItems);
                    }catch (\Exception $e) {
                        DB::rollBack();
                        return response()->json(['status' => $order->status]);
                    }
                    DB::commit();

                    return response()->json(['status' => $order->status]);
                }
            }else{
                return response()->json(['status' => $order->status]);
            }

        }

        return response()->json(['status' => $order->status]);
    }

    public function finishPayment($order_id)
    {
        $order = Order::where('order_number', $order_id)->firstOrFail();

        if ($order->status != 'paid') {
            return redirect()->route('frontend.order.payment', $order->order_number);
        }

        return view('frontend.order.finish', [
            'order' => $order
        ]);
    }

    public function createPayment($data)
    {
        $result = Payment::create([
            'order_number' => $data['order_id'],
            'fraud_status' => $data['fraud_status'],
            'gross_amount' => $data['gross_amount'],
            'payment_type' => $data['payment_type'],
            'transaction_id' => $data['transaction_id'],
            'transaction_status' => $data['transaction_status'],
            'transaction_time' => $data['transaction_time'],
            'url' => $data['pdf_url'] ?? null,
            'status_code' => $data['status_code'] ?? null,
            'status_message' => $data['status_message'] ?? null,
            'va_numbers' => isset($data['va_numbers']) ? json_encode($data['va_numbers']) : null,
        ]);

        return $result;
    }

    public function createSubscription($items)
    {
        foreach ($items as $item) {
            $data = [
                'user_id' => auth()->id(),
                'order_item' => $item->id,
                'subscription_number' => 'SUBS-' . strtoupper(uniqid()),
                'status' => 'active',
                'contract_type' => $item->contract_type
            ];

            switch ($item->contract_type) {
                case 'daily':
                    $data['started_at'] = Carbon::now();
                    $data['ended_at'] = Carbon::now()->addDays($item->quantity);
                    break;
                case 'monthly':
                    $data['started_at'] = Carbon::now();
                    $data['ended_at'] = Carbon::now()->addMonths($item->quantity);
                    break;
                case 'yearly':
                    $data['started_at'] = Carbon::now();
                    $data['ended_at'] = Carbon::now()->addYears($item->quantity);
                    break;
                case 'periode':
                    break;
                case 'once':
                    break;
                default:
                    break;
            }

            Subscription::create($data);
        }
    }

    protected function setupMidtransConfig()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }

    public function package(Request $request)
    {
        $data = json_decode($request->input('package'));
        // dd($data);

        $package = Package::where('id', $data->id)
            ->where('slug', $data->slug)
            ->firstOrFail();

        $sub_package = json_decode($package->payload);

        if ($data->type != 'table' && $data->type != 'list') {
            # code...
            dd($sub_package);
        }else{
            $sub_package = collect($sub_package)->where('type', $data->type)->first();

            switch ($data->type) {
                case 'table':
                    # code...
                    dd($sub_package->data->table[$data->sub_package_key]);
                    break;
                case 'list':
                    # code...
                    dd($sub_package->data->list[$data->sub_package_key]);
                    break;

                default:
                    # code...
                    dd('Type not found');
                    break;
            }
        }

        // Logic to handle the package view
        return view('frontend.order.package', compact('package'));
    }
}
