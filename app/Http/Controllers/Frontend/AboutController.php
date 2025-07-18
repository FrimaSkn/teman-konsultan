<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Settings\SettingAbout;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index(SettingAbout $settings)
    {
        return view('frontend.pages.about', [
            'settings' => $settings,
        ]);
    }
}
