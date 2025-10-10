<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;

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
}
