<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('home.hero_title', null);
        $this->migrator->add('home.hero_desc', null);
        $this->migrator->add('home.hero_link', null);

    }
};
