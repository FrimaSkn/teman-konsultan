<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public $banner_article;
    public $banner_contact;
    public $addrs_head_office;
    public $gmap_head_office;
    public $addrs_workshop;
    public $gmap_workshop;
    public $whatsapp;
    public $email;
    public $phone;
    public $social_media;

    public static function group(): string
    {
        return 'general';
    }
}
