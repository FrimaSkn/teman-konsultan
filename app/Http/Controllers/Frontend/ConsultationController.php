<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function free_consultation()
    {
        return view('frontend.pages.free-consultation');
    }
}
