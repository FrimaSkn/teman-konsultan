<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SettingAbout extends Settings
{
    public $banner;
    public $content;
    public $values;
    public $vision;
    public $mission;

    public static function group(): string
    {
        return 'about';
    }
}
