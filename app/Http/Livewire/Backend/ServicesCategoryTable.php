<?php

namespace App\Http\Livewire\Backend;

use App\Models\ServicesCategory;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ServicesCategoryTable extends DataTableComponent
{
    protected $model = ServicesCategory::class;

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
            Column::make("No", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            // Column::make("Description", "description")
            //     ->sortable(),
        ];
    }
}
