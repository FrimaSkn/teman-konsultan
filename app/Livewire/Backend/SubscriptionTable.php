<?php

namespace App\Livewire\Backend;

use Carbon\Carbon;
use App\Models\Subscription;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class SubscriptionTable extends DataTableComponent
{
    protected $model = Subscription::class;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Subscription::query()->orderBy('created_at', 'desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTrAttributes(
            fn() => ['default' => false]
        );
        $this->setTableAttributes([
            'class' => 'table table-striped table-hover',
        ]);
        $this->setColumnSelectStatus(false);
        $this->setThAttributes(function(Column $column) {
                if (!$column->isField('id')) {
                    return ['class' => 'text-no-wrap'];
                }

                return [];
            });
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("Id", "id")
                ->deselected()
                ->sortable(),
            Column::make("User", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Category", "orderItem.package.category.name")
                ->format(function ($value) {
                    $lang = app()->getLocale();
                    $value = (array) json_decode($value);
                    return $value[$lang];
                })
                ->sortable(),
            Column::make("Package name", "orderItem.package.title")
                ->format(function ($value) {
                    $lang = app()->getLocale();
                    $value = (array) json_decode($value);
                    return $value[$lang];
                })
                ->sortable(),
            Column::make("Subscription number", "subscription_number")
                ->format(function ($value) {
                    return '<span class="text-no-wrap">' . $value . '</span>';
                })
                ->html()
                ->searchable()
                ->sortable(),
            Column::make("Status", "id")
                ->format(function ($value) {
                    $subscription = Subscription::find($value);

                    if ($subscription->ended_at == null && $subscription->started_at == null) {
                        return 'N/A';
                    }

                    if (Carbon::now()->format('Y-m-d') < $subscription->started_at  ) {
                        $subscription->status = 'Pending';
                        return '<span class="pt-1 badge badge-pill badge-secondary">' . $subscription->status . '</span>';

                    }elseif (Carbon::now()->format('Y-m-d') <= $subscription->ended_at && Carbon::now()->format('Y-m-d') >= $subscription->started_at){
                        $subscription->status = 'Active';
                        return '<span class="pt-1 badge badge-pill badge-success">' . $subscription->status . '</span>';
                    }else{
                        $subscription->status = 'Expired';
                        return '<span class="pt-1 badge badge-pill badge-danger">' . $subscription->status . '</span>';
                    }
                })
                ->html()
                ->sortable(),
            Column::make("Contract type", "contract_type")
                ->setLabelAttributes(['class' => 'text-no-wrap'])
                ->format(function ($value) {
                    switch ($value) {
                        case 'daily':
                            return 'Daily';
                        case 'monthly':
                            return 'Monthly';
                        case 'yearly':
                            return 'Yearly';
                        case 'once':
                            return 'One time';
                        case 'periode':
                            return 'Periode';
                        default:
                            return 'Package';
                    }
                })
                ->sortable(),
            Column::make("Quantity", "orderItem.quantity"),
            Column::make("Started at", "started_at")
                ->format(function ($value) {
                    if ($value == null) {
                        return 'N/A';
                    }
                    $date = date('d F Y', strtotime($value));
                    return '<span class="text-no-wrap">' . $date . '</span>';
                })
                ->html()
                ->sortable(),
            Column::make("Ended at", "ended_at")
                ->format(function ($value) {
                    if ($value == null) {
                        return 'N/A';
                    }
                    $date = date('d F Y', strtotime($value));
                    return '<span class="text-no-wrap">' . $date . '</span>';
                })
                ->html()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make(__('Actions'))
                ->label(fn($row) => view('backend.subscription.includes.actions', ['model' => $row]))
        ];
    }
}
