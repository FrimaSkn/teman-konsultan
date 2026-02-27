<?php

namespace App\Livewire\Backend;

use App\Models\Package;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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

    public function filters(): array
    {
        return [
            SelectFilter::make('Category')
                ->options(
                    \App\Models\PackageCategory::all()
                        ->pluck('name', 'id')
                        ->toArray()
                )
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereHas('orderItem.package.category', function ($query) use ($value) {
                        $query->where('id', $value);
                    });
                }),
            SelectFilter::make('Package')
                ->options(
                    \App\Models\Package::all()
                        ->pluck('title', 'id')
                        ->toArray()
                )
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereHas('orderItem.package', function ($query) use ($value) {
                        $query->where('id', $value);
                    });
                }),
        ];
    }


    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("Id", "id")
                ->deselected()
                ->sortable(),
            Column::make("User ID", "user.unique_id")
                    ->sortable()
                    ->searchable(),
            // Column::make("User", "user.name")
            //     ->sortable()
            //     ->searchable(),
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
            Column::make("Sub Package", "orderItem.payload")
                ->format(function ($value, $row) {
                    $payload = json_decode($value);
                    $package = Package::find($payload->package_id);
                    $packagePayload = json_decode($package->payload);

                    switch ($payload->type) {
                        case 'table':
                            $data = collect($packagePayload)->where('type', $payload->type)->first();
                            $value = (array) $data->data->table[$payload->sub_package_key]->data->table;
                            $string = '';
                            foreach ($value[app()->getLocale()] as $k => $v) {
                                $string .= $k . ': ' . $v . '<br>';
                            }
                            return '<span>' .  $string . '</span>';
                            break;
                        case 'list':
                            $data = collect($packagePayload)->where('type', $payload->type)->first();
                            $value = (array) $data->data->list[$payload->sub_package_key]->key;
                            return '<span>' . $value[app()->getLocale()] . '</span>';
                            break;
                        default:
                            return '-';
                            break;
                    }
                })
                ->html()
                ->sortable(),
            Column::make('Notes', 'note'),
            Column::make("Subscription number", "subscription_number")
                ->format(function ($value) {
                    return '<span class="text-no-wrap">' . $value . '</span>';
                })
                ->html()
                ->searchable()
                ->sortable(),
            Column::make("Order number", "orderItem.order.order_number")
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
                        $subscription->status = 'Inactive';
                        return '<span class="pt-1 badge badge-pill badge-secondary">' . $subscription->status . '</span>';
                    }

                    if (Carbon::now()->format('Y-m-d') <= $subscription->ended_at && Carbon::now()->format('Y-m-d') >= $subscription->started_at) {
                        $subscription->status = 'Active';
                        return '<span class="pt-1 badge badge-pill badge-success">' . $subscription->status . '</span>';
                    }elseif (Carbon::now()->format('Y-m-d') < $subscription->started_at) {
                        $subscription->status = 'Inactive';
                        return '<span class="pt-1 badge badge-pill badge-secondary">' . $subscription->status . '</span>';
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
