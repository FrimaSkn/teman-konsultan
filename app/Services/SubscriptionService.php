<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Subscription;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SubscriptionService extends BaseService
{
/**
 * Construct a new instance of the SubscriptionService
 *
 * @param Subscription $subscription
 */
    public function __construct(Subscription $subscription)
    {
        $this->model = $subscription;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            foreach ($data as $key => $value) {
                $item = [
                    'user_id' => auth()->id(),
                    'order_item' => $value['id'],
                    'subscription_number' => 'SUBS-' . strtoupper(uniqid()),
                    'status' => 'active',
                    'contract_type' => $value['contract_type']
                ];

                switch ($value['contract_type']) {
                    case 'daily':
                        $item['started_at'] = Carbon::now();
                        $item['ended_at'] = Carbon::now()->addDays($value['quantity']);
                        break;
                    case 'monthly':
                        $item['started_at'] = Carbon::now();
                        $item['ended_at'] = Carbon::now()->addMonths($value['quantity']);
                        break;
                    case 'yearly':
                        $item['started_at'] = Carbon::now();
                        $item['ended_at'] = Carbon::now()->addYears($value['quantity']);
                        break;
                    case 'periode':
                        break;
                    case 'once':
                        break;
                    default:
                        break;
                }

                $this->create($item);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception('There was a problem creating this subscription. Please try again.');
        }

        DB::commit();
    }

    protected function create(array $data = []): Subscription
    {
        return $this->model::create([
            'user_id' => $data['user_id'],
            'order_item' => $data['order_item'],
            'subscription_number' => $data['subscription_number'],
            'status' => $data['status'],
            'contract_type' => $data['contract_type'],
            'started_at' => $data['started_at'] ?? null,
            'ended_at' => $data['ended_at'] ?? null,
        ]);
    }
}
