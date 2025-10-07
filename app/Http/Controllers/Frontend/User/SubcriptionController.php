<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubcriptionController extends Controller
{
    public function index()
    {
        return view('frontend.user.subscription.index');
    }

    public function show()
    {
        return view('frontend.user.subscription.show');
    }
}
