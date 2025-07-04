<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SettingHome extends Settings
{
    public $banner;
    public $hero_title;
    public $hero_desc;
    public $hero_link;
    public $about_title;
    public $about_description;
    public $about_image;
    public $section_4_content;


    public static function group(): string
    {
        return 'home';
    }
}
