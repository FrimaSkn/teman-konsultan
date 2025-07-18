<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('about.banner', null);
        $this->migrator->add('about.content', null);
        $this->migrator->add('about.values', null);
        $this->migrator->add('about.vision', null);
        $this->migrator->add('about.mission', null);
    }
};
