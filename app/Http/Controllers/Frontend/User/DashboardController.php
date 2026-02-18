<?php

namespace App\Http\Controllers\Frontend\User;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subscriptions = \App\Models\Subscription::where('user_id', auth()->user()->id)->get();
        $totalSubscriptions = $subscriptions->count();
        $latestSubscriptions = $subscriptions->sortByDesc('created_at')->take(5);

        $transactions = \App\Models\Order::where('user_id', auth()->user()->id)->get();
        $totalTransactions = $transactions->count();
        $latestTransactions = $transactions->sortByDesc('created_at')->take(5);

        return view('frontend.user.dashboard', [
            'totalSubscriptions'   => $totalSubscriptions,
            'latestSubscriptions'  => $latestSubscriptions,
            'totalTransactions'    => $totalTransactions,
            'latestTransactions'   => $latestTransactions,
        ]);
    }
}
