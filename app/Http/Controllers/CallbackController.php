<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\Api\pivotService;
use Illuminate\Support\Facades\Log;
use App\Services\SubscriptionService;

class CallbackController extends Controller
{
    protected $apiService;
    protected $orderService;
    protected $paymentService;
    protected $subscriptionService;

    public function __construct(OrderService $orderService, PaymentService $paymentService, pivotService $apiService, SubscriptionService $subscriptionService)
    {
        $this->apiService = $apiService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
        $this->subscriptionService = $subscriptionService;
    }

    public function paymentCallback(Request $request)
    {
        $response = $request->all();
        Log::info("Payment callback received: " . json_encode($response));

        // if array key clientReferenceId exists
        if (array_key_exists('clientReferenceId', $request['data'])) {
            $order = $this->orderService->getByOrderNumber($request['data']['clientReferenceId']);

            switch ($response['data']['status']) {
                case 'PAID':
                    $this->orderService->updateStatus($order, 'paid');
                    break;
                case 'FAILED':
                    $this->orderService->updateStatus($order, 'failed');
                    break;
                case 'EXPIRED':
                    $this->orderService->updateStatus($order, 'expired');
                    break;
                case 'CANCELLED':
                    $this->orderService->updateStatus($order, 'cancelled');
                    break;
                case 'PROCESSING':
                    $this->orderService->updateStatus($order, 'pending');
                    break;
                default:
                    Log::info('Unknown payment status received in callback: ' . $request['data']['status']);
                    break;
            }

            $this->paymentCallbackUpdate($order->payment, $response);
            $this->subscriptionService->store($order->orderItems->toArray());
        }

        return response()->json(['message' => 'Callback processed successfully'], 200);
    }

    public function successReturnUrl($order_number)
    {
        $order = $this->orderService->getByOrderNumber($order_number);

        if ($order->status != 'paid') {
            $this->orderService->updateStatus($order, 'paid');
        }

        if ($order->payment->status != 'PAID') {
            $this->paymentUpdate($order->payment->transaction_id, $order->payment);
        }

        if ($order->orderItems->count() > 0 && $order->status == 'paid') {
            $this->subscriptionService->store($order->orderItems->toArray());
        }

        return view('frontend.order.finish', [
            'order' => $order
        ]);
    }

    public function failureReturnUrl($order_number)
    {
        $order = $this->orderService->getByOrderNumber($order_number);

        $this->orderService->updateStatus($order, 'failed');

        $this->paymentUpdate($order->payment->transaction_id, $order->payment);

        return redirect()->route('frontend.user.transaction.index');
    }

    public function expirationReturnUrl($order_number)
    {
        $order = $this->orderService->getByOrderNumber($order_number);

        $this->orderService->updateStatus($order, 'expired');

        $this->paymentUpdate($order->payment->transaction_id, $order->payment);

        return redirect()->route('frontend.user.transaction.index');
    }

    protected function paymentCallbackUpdate(Payment $payment, array $data = [])
    {
        return $this->paymentService->update($payment, [
            'currency' => $data['data']['amount']['currency'],
            'amount' => $data['data']['amount']['value'],
            'payment_url' => $data['data']['paymentUrl'],
            'status' => $data['data']['status'],
            'payload' => json_encode($data),
        ]);
    }

    protected function paymentUpdate($transactionId, Payment $payment)
    {
        $request = $this->apiService->retrievePaymentById($transactionId);
            if ($request->getStatusCode() == 200) {
                $body = $request->getData();
                $data = $body->data;

                $this->paymentService->update($payment, [
                    'currency' => $data->amount->currency,
                    'amount' => $data->amount->value,
                    'payment_url' => $data->paymentUrl,
                    'status' => $data->status,
                    'payload' => json_encode($body),
                ]);
            }
    }
}
