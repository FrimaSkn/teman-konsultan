<?php

namespace App\Http\Livewire\Backend;

use App\Models\Services;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\CountColumn;

class ServicesTable extends DataTableComponent
{
    protected $model = Services::class;

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

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Type", "category_id")
                ->format(function ($value, $row) {
                    return $row->category ? $row->category->name : 'N/A';
                })
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
        ];
    }
}
