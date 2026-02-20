<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class TransactionTable extends DataTableComponent
{
    protected $model = Order::class;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Order::query()->where('user_id', auth()->id())->orderBy('updated_at', 'desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("Id", "id")
                ->deselected()
                ->sortable(),
            Column::make("Order number", "order_number")
                ->searchable()
                ->sortable(),
            Column::make("Status", "status")
                ->format(function ($value) {
                    $status = [
                        'pending' => '<span class="pt-1 badge badge-pill badge-secondary">Pending</span>',
                        'paid' => '<span class="pt-1 badge badge-pill badge-success">Paid</span>',
                        'failed' => '<span class="pt-1 badge badge-pill badge-danger">Failed</span>',
                        'expired' => '<span class="pt-1 badge badge-pill badge-danger">Expired</span>',
                        'cancelled' => '<span class="pt-1 badge badge-pill badge-danger">Cancelled</span>',
                    ];

                    return $status[$value] ?? $value;
                })
                ->html()
                ->searchable()
                ->sortable(),
            Column::make("Total amount", "total_amount")
                ->format(fn($value) => 'Rp ' . number_format($value, 0, ',', '.'))
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(fn($value) => $value->format('d M Y H:i:s'))
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->format(fn($value) => $value->format('d M Y H:i:s'))
                ->sortable(),
            Column::make(__('Actions'))
                ->label(fn($row) => view('frontend.user.transaction.includes.actions', ['model' => $row])),
        ];
    }

    public function filters(): array
{
    return [
        SelectFilter::make('Status')
            ->options([
                'pending' => 'Pending',
                'paid' => 'Paid',
                'failed' => 'Failed',
                'cancelled' => 'Cancelled',
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->where('status', $value);
            }),
    ];
}
}
