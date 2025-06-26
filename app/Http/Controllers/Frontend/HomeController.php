<?php

namespace App\Http\Controllers\Frontend;

use App\Settings\SettingHome;

/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(SettingHome $settings)
    {
        $services = \App\Models\ServicesCategory::with('services')->get();
        return view('frontend.index', [
            'services' => $services,
            'settings' => $settings,
        ]);
    }
}
