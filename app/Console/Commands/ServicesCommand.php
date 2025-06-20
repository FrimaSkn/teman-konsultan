<?php

namespace App\Console\Commands;

use App\Models\Services;
use Illuminate\Console\Command;

class ServicesCommand extends Command
{
    use \App\Console\Commands\Trait\ExternalDatabase;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:services-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data =  $this->getExternalDatabaseConnection()->table('services_bk')->get();

        foreach ($data as $key => $value) {
            Services::create([
                'category_id' => $value->category_id,
                'name' => json_encode([
                    'en' => $value->name,
                    'id' => $value->name
                ]),
                'description' => json_encode([
                    'en' => $value->description,
                    'id' => $value->description
                ]),
                'slug' => $value->slug,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at

            ]);
        }

        $this->info('Command executed successfully.');

    }
}
