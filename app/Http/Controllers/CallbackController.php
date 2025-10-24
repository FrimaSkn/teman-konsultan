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
        $response = response()->json([
            'message' => 'Callback received',
            'headers' => $request->headers->all(),
            'data' => $request->all()], 200);
        return $response->getData();

        if (!empty($request->all())) {
            $data = $request->all();

            if ($data['data']['status'] == 'PAID') {
                $order = $this->orderService->getByOrderNumber($data['data']['clientReferenceId']);
                $this->orderService->updateStatus($order, 'paid');
            }

            $payment = $this->paymentService->getByOrderNumber($data['data']['clientReferenceId']);
            $payload = json_encode($data);
            $this->paymentService->update($payment, [
                    'currency' => $data['data']['amount']['currency'],
                    'amount' => $data['data']['amount']['value'],
                    'payment_url' => $data['data']['paymentUrl'],
                    'status' => $data,
                    'payload' => json_encode($payload),
                ]);

            Log::info('Callback Request:', json_encode($request->all()));
        }else {
            Log::info('Callback Request: No Request Data');
        }
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
