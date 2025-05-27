<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.charge');
    }
}
