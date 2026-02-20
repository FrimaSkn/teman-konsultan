<?php

namespace App\Livewire\Backend;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class TransactionTable extends DataTableComponent
{
    protected $model = Order::class;

    public function builder(): Builder
    {
        return Order::query()->orderBy('created_at', 'desc');
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
    }

    public function updateStatus($id, $status)
    {
        $order = Order::find($id);
        $order->status = $status;
        $order->save();
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("Id", "id")
                ->deselected(),
            Column::make("User", "user.name")
                ->searchable()
                ->sortable(),
            Column::make("Order number", "order_number")
                ->sortable(),
            Column::make("Status", "status")
                // ->format(function ($value) {
                //         $status = [
                //             'pending' => '<span class="pt-1 badge badge-pill badge-secondary">Pending</span>',
                //             'paid' => '<span class="pt-1 badge badge-pill badge-success">Paid</span>',
                //             'failed' => '<span class="pt-1 badge badge-pill badge-danger">Failed</span>',
                //             'cancelled' => '<span class="pt-1 badge badge-pill badge-warning">Cancelled</span>',
                //         ];

                //         return $status[$value] ?? $value;
                //     })
                // ->html()
                ->format(fn($value, $row, $column) => view('backend.transaction.includes.status', ['value' => $value, 'row' => $row, 'column' => $column]))
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
                ->label(fn($row) => view('backend.transaction.includes.actions', ['model' => $row])),
        ];
    }
}
