<?php
    namespace App\Console\Commands\Trait;

    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Facades\DB;

    trait ExternalDatabase {
        public function getExternalDatabase() {
            Config::set("database.connections.mysql_external", [
                'driver' => 'mysql',
                "host" => "localhost",
                "database" => "db_teman_konsultan",
                "username" => "root",
                "password" => "",
                "port" => '3306',
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
            ]);
        }

        public function getExternalDatabaseConnection() {
            $this->getExternalDatabase();
            return DB::connection('mysql_external');
        }

    }
