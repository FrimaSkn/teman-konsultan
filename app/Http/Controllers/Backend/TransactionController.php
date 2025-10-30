<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        return view('backend.transaction.index');
    }

    public function show($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();
        $payment = json_decode($order->payment->payload ?? '');
        return view('backend.transaction.show', [
            'order' => $order,
            'payment' => $payment
        ]);
    }
}
