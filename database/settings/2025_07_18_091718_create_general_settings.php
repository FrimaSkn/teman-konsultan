<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.banner_article', null);
        $this->migrator->add('general.banner_contact', null);
        $this->migrator->add('general.addrs_head_office', null);
        $this->migrator->add('general.gmap_head_office', null);
        $this->migrator->add('general.addrs_workshop', null);
        $this->migrator->add('general.gmap_workshop', null);
        $this->migrator->add('general.whatsapp', null);
        $this->migrator->add('general.email', null);
        $this->migrator->add('general.phone', null);
        $this->migrator->add('general.social_media', null);
    }
};
