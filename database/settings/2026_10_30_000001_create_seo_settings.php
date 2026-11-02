<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.site_name', config('app.name', 'Teman Konsultan'));
        $this->migrator->add('seo.title_template', '{title} | {site}');
        $this->migrator->add('seo.default_meta_description', null);
        $this->migrator->add('seo.default_og_image', null);
        $this->migrator->add('seo.default_robots', 'index,follow');
        $this->migrator->add('seo.twitter_site', null);
        $this->migrator->add('seo.google_site_verification', null);
        $this->migrator->add('seo.bing_site_verification', null);
        $this->migrator->add('seo.google_analytics_id', null);
        $this->migrator->add('seo.organization_name', config('app.name', 'Teman Konsultan'));
        $this->migrator->add('seo.organization_logo', null);
        $this->migrator->add('seo.organization_same_as', []);
        $this->migrator->add('seo.robots_txt', "User-agent: *\nAllow: /");
        $this->migrator->add('seo.sitemap_enabled', true);
    }
};
