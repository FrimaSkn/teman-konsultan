<?php

namespace App\Services;

use App\Models\Payment;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentService extends BaseService
{
    /**
     * Construct a new PaymentService instance.
     *
     * @param \App\Models\Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->model = $payment;
    }

    /**
     * Get a payment by its order number.
     *
     * @param string $order_number
     * @return \App\Models\Payment
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getByOrderNumber($order_number)
    {
        return $this->model->where('order_number', $order_number)->firstOrFail();
    }

    /**
     * Store a new payment.
     *
     * @param array $data
     * @return \App\Models\Payment
     * @throws \Exception
     */
    public function store(array $data = []): Payment
    {
        DB::beginTransaction();

        try {
            $payment = $this->create([
                'order_number' => $data['order_number'],
                'transaction_id' => $data['transaction_id'],
                'currency' => $data['currency'],
                'amount' =>  $data['amount'],
                'status' =>  $data['status'],
                'payment_url' =>  $data['payment_url'],
                'payload' =>  $data['payload'],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Creation Error: ' . $e->getMessage());
            throw new \Exception('There was a problem creating this payment. Please try again.');
        }

        DB::commit();

        return $payment;
    }


    /**
     * Update the status of a payment.
     *
     * @param \App\Models\Payment $payment
     * @param string $status
     * @return \App\Models\Payment
     */
    public function updateStatus(Payment $payment, $status)
    {
        $payment->status = $status;
        return tap($payment)->save();
    }

    /**
     * Update a payment.
     *
     * @param \App\Models\Payment $payment
     * @param array $data
     * @return \App\Models\Payment
     * @throws \Exception
     */
    public function update(Payment $payment, array $data = []): Payment
    {
        DB::beginTransaction();
        try {
            $payment->update([
                'currency' => $data['currency'],
                'amount' =>  $data['amount'],
                'status' =>  $data['status'],
                'payment_url' =>  $data['payment_url'],
                'payload' =>  $data['payload'],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Update Error: ' . $e->getMessage());
            throw new \Exception('There was a problem updating this payment. Please try again.');
        }
        DB::commit();

        return $payment;
    }

/**
 * Create a new payment.
 *
 * @param array $data
 * @return \App\Models\Payment
 */
    protected function create(array $data = []): Payment
    {
        return $this->model::create([
            'order_number' => $data['order_number'],
            'transaction_id' => $data['transaction_id'],
            'currency' => $data['currency'],
            'amount' =>  $data['amount'],
            'status' =>  $data['status'],
            'payment_url' =>  $data['payment_url'],
            'payload' =>  $data['payload'],
        ]);
    }
}
