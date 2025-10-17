<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('backend.subscription.index');
    }

    public function create()
    {
        return view('backend.subscription.create');
    }

    public function edit(Subscription $subscription)
    {
        return view('backend.subscription.edit', compact('subscription'));
    }
}
