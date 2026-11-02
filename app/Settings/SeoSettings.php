<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public $site_name;
    public $title_template;
    public $default_meta_description;
    public $default_og_image;
    public $default_robots;
    public $twitter_site;
    public $google_site_verification;
    public $bing_site_verification;
    public $google_analytics_id;
    public $organization_name;
    public $organization_logo;
    public $organization_same_as;
    public $robots_txt;
    public $sitemap_enabled;

    public static function group(): string
    {
        return 'seo';
    }
}
