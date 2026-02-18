<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Order::where('user_id', auth()->id())->orderBy('updated_at', 'desc')->get();
        return view('frontend.user.transaction.index', [
            'transactions' => $transactions
        ]);
    }

    public function show($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();
        $payment = json_decode($order->payment->payload ?? '');
        return view('frontend.user.transaction.show', [
            'order' => $order,
            'payment' => $payment
        ]);
    }
}
