<?php

use Carbon\Carbon;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Laravel Boilerplate');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     * @return Carbon
     *
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return 'admin.dashboard';
            }

            if (auth()->user()->isUser()) {
                return 'frontend.user.dashboard';
            }
        }

        return 'frontend.home';
    }
}

if (!function_exists('activeMenu')) {
    function activeMenu($uri = '', $activeClass = 'active') {
        $active = '';
        if (Request::routeIs($uri) || Request::routeIs($uri . '*')) {
            $active = $activeClass;
        }
        return $active;
    }
}

// translate helper
if (!function_exists('translate')) {
    function translate($value = '') {
        if ($value === null || $value === '') {
            return '';
        }

        $locale = session()->get('locale') ?? config('app.locale');

        return $value[$locale];
    }
}

if (!function_exists('mask_wa')) {
    function mask_wa($number = '')
    {
        // Hilangkan tanda plus jika ada
        $number = ltrim($number, '+');

        // Pisahkan kode negara (2 digit pertama)
        $countryCode = substr($number, 0, 2);
        $rest = substr($number, 2);

        // Format sisanya jadi 3-4-4 digit
        $part1 = substr($rest, 0, 3);
        $part2 = substr($rest, 3, 4);
        $part3 = substr($rest, 7, 4);

        return "+" . $countryCode . " " . $part1 . "-" . $part2 . "-" . $part3;
    }
}

if (!function_exists('mask_phone')) {
    function mask_phone($number = '')
    {
        $countryCode = substr($number, 0, 3);
        $rest = substr($number, 3);

        $part1 = substr($rest, 0, 3);
        $part2 = substr($rest, 3, 4);
        $part3 = substr($rest, 7, 4);

        return $countryCode . " - " . $part1 . " " . $part2 . " " . $part3;
    }
}
