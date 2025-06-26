<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('home.banner', null);
        $this->migrator->add('home.about_title', 'About Us');
        $this->migrator->add('home.about_description', 'About Us');
        $this->migrator->add('home.about_image', null);
        $this->migrator->add('home.section_4_title', null);
        $this->migrator->add('home.section_4_content', null);
        $this->migrator->add('home.section_5_desc', null);
        $this->migrator->add('home.section_5_money', null);
        $this->migrator->add('home.section_5_implemented' , null);
        $this->migrator->add('home.section_5_client' , null);
    }
};
