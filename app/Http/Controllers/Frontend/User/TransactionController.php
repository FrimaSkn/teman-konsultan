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
}
