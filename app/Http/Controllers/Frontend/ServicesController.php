<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function page($slug)
    {
        $service = Services::where('slug', $slug)->firstOrFail();

        return view('frontend.pages.services.page', [
            'service' => $service,
        ]);
    }
}
