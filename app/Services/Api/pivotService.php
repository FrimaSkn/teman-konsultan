<?php

namespace App\Services\Api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Support\Facades\Log;

class pivotService
{
    protected $baseUrl;
    protected $clientId;
    protected $secretKey;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('pivot-payment.base_url');
        $this->clientId = config('pivot-payment.client_id');
        $this->secretKey = config('pivot-payment.client_secret');
        $this->token = cache()->get('pivot_token');
    }

    public function redirectPayment(Order $order)
    {
        $productDetail = [];
        foreach ($order->orderItems as $item) {
            $package = Package::where('id', $item->package_id)->first();
            $payload = json_decode($item->payload);
            $packagePayload = json_decode($package->payload);
            $description = '';

            switch ($payload->type) {
                case 'table':
                    $data = collect($packagePayload)->where('type', $payload->type)->first();
                    $value = (array) $data->data->table[$payload->sub_package_key]->data->table;
                    $string = '';
                    foreach ($value[app()->getLocale()] as $k => $v) {
                        $string .= $k . ': ' . $v . ', ';
                    }
                    $description = $string;
                    break;
                case 'list':
                    $data = collect($packagePayload)->where('type', $payload->type)->first();
                    $value = (array) $data->data->list[$payload->sub_package_key]->key;
                    $description = $value[app()->getLocale()];
                    break;
                default:
                    $description = '-';
                    break;
            }

            $productDetail[] = [
                'quantity' => $item->quantity,
                'name' => $package->title . ' - ' . $package->category->name,
                "type" => "PHYSICAL",
                "category" => $item->package->category->name,
                "name" => $item->package->title,
                "description" => $description,
                "price" => [
                    'value' => $item->price,
                    'currency' => 'IDR'
                ]
            ];
        }

        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->addHour(1)->format('H:i:s');

        // API Pivot
        $headers = [
            'X-MERCHANT-ID' => $this->clientId,
            'X-MERCHANT-SECRET' => $this->secretKey,
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];

        $body = [
            'clientReferenceId' => $order->order_number,
            'amount' => [
                'value' => $order->total_amount,
                'currency' => 'IDR'
            ],
            'paymentType' => 'SINGLE',
            'mode' => 'REDIRECT',
            'redirectUrl' => [
                'successReturnUrl' => route('redirect.payment.success', ['order_number' => $order->order_number]),
                'failureReturnUrl' => route('redirect.payment.failed', ['order_number' => $order->order_number]),
                'expirationReturnUrl' => route('redirect.payment.expired', ['order_number' => $order->order_number])
            ],
            'customer' => [
                'givenName' => $order->user->name,
                'email' => $order->user->email,
                'phoneNumber' => [
                    'countryCode' => '+62',
                    'number' => substr($order->user->phone, 1)
                ]
            ],
            'orderInformation' => [
                'productDetails' => $productDetail
            ],
            'transactionTime' => $date . 'T' . $time . 'Z'
        ];

        try {
            $client = new \GuzzleHttp\Client();
            $url  = config('pivot-payment.base_url');
            $request = $client->request('POST', $url . '/v2/payments', [
                'headers' => $headers,
                'body' => json_encode($body)
            ]);

            return response()->json(json_decode($request->getBody()->getContents()), 200);
        }catch (\Exception $e) {
            Log::error('Pivot Payment Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function retrievePaymentById($transactionId)
    {
        $headers = [
            'X-MERCHANT-ID' => $this->clientId,
            'X-MERCHANT-SECRET' => $this->secretKey,
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];

        try {
            $client = new \GuzzleHttp\Client();
            $url  = config('pivot-payment.base_url');
            $request = $client->request('GET', $url . '/v2/payments/' . $transactionId, [
                'headers' => $headers
            ]);

            return response()->json(json_decode($request->getBody()->getContents()), 200);
        }catch (\Exception $e) {
            Log::error('Pivot Payment Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
