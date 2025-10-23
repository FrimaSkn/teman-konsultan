<?php

namespace App\Services;

use App\Models\Order;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\OrderItem;
use Exception;

class OrderService extends BaseService
{
/**
 * Construct a new OrderService instance.
 *
 * @param \App\Models\Order $order
 */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

/**
 * Get an order by its order number.
 *
 * @param string $order_number
 * @return \App\Models\Order
 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
 */
    public function getByOrderNumber($order_number)
    {
        return $this->model->where('order_number', $order_number)->firstOrFail();
    }

/**
 * Store a new order.
 *
 * @return void
 */
    public function store(array $data = []): Order
    {
        DB::beginTransaction();

        try {
            $order = $this->createOrder([
                'user_id' => $data['user_id'],
                'order_number' => $data['order_number'],
                'total_amount' =>  $data['total_amount'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this order. Please try again.'));
        }

        DB::commit();

        return $order;
    }

    public function updateStatus(Order $order, $status)
    {
        $order->status = $status;
        return tap($order)->save();
    }

    protected function createOrder(array $data = []): Order
    {
        return $this->model::create([
            'user_id' => $data['user_id'],
            'order_number' => $data['order_number'],
            'total_amount' =>  $data['total_amount'],
        ]);
    }

    public function createOrderItem(Order $order, array $data = []): OrderItem
    {
        return $order->orderItems()->create([
            'package_id' => $data['package_id'],
            'payload' => $data['payload'],
            'contract_type' => $data['contract_type'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
        ]);
    }
}
