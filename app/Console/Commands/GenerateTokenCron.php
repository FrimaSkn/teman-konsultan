<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Filament\Forms\Get;
use Illuminate\Console\Command;

class GenerateTokenCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:cron';

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
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->request('POST', config('pivot-payment.base_url').'/v1/access-token', [
                'headers' => [
                    'X-MERCHANT-ID' => config('pivot-payment.client_id'),
                    'X-MERCHANT-SECRET' => config('pivot-payment.client_secret'),
                    'Content-Type' => 'application/json'
                ],
                'body' => '{
                    "grantType": "client_credentials"
                }'
            ]);

            $response = json_decode($request->getBody()->getContents());

            $token = $response->data->accessToken;

            cache()->put('pivot_token', $token);

            \Log::info("Cron job Generate Token Berhasil di jalankan " . date('Y-m-d H:i:s'));
        }catch (\Throwable $th) {
            \Log::error($th->getMessage());
        }
    }
}
