<?php

namespace Database\Seeders;

use App\Models\Order;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        // $this->call(AuthSeeder::class);
        // $this->call(AnnouncementSeeder::class);

        for ($i=0; $i < 10; $i++) {
            $num = 10 + $i;
            Order::create([
                'user_id' => 8,
                'order_number' => 'W' . date('ym') . str_pad($num + 1, 6, '0', STR_PAD_LEFT),
                'status' => 'failed',
                'total_amount' => 100000,
            ]);
        }



        Model::reguard();
    }
}
