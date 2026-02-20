<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\Api\pivotService;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function index()
    {
        $order = CartItem::with('package')->where('user_id', auth()->id())->get();

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
}
