<?php

namespace App\Livewire\Frontend;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Subscription;

class SubscriptionTable extends DataTableComponent
{
    protected $model = Subscription::class;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Subscription::query()->where('user_id', auth()->id())->orderBy('updated_at', 'desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("User id", "user_id")
                ->sortable(),
            Column::make("Order item", "order_item")
                ->sortable(),
            Column::make("Subscription number", "subscription_number")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Contract type", "contract_type")
                ->sortable(),
            Column::make("Started at", "started_at")
                ->sortable(),
            Column::make("Ended at", "ended_at")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
