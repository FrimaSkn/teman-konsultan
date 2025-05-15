<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function payment()
    {
        $this->setupMidtransConfig();

        $transaction_details = [
            'order_id' => uniqid(),
            'gross_amount' => 10000,
        ];

        $item_details = [
            [
                'id' => 'item1',
                'price' => 10000,
                'quantity' => 1,
                'name' => 'Adidas f50'
            ]
        ];

        $customer_details = [
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'email'         => 'john@doe.com',
            'phone'         => '081234567890',
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            return view('frontend.order.payment', compact('snapToken'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    protected function setupMidtransConfig()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }

}
