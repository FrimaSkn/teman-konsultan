<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class RolesTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users')
            ->when($this->getAppliedFilterWithValue('search'), fn ($query, $term) => $query->search($term));
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

    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->label(function ($row) {
                    if ($row->type === \App\Domains\Auth\Models\User::TYPE_ADMIN) {
                        return __('Administrator');
                    }elseif ($row->type === \App\Domains\Auth\Models\User::TYPE_USER) {
                        return __('User');
                    }else{
                        return __('Unknown');
                    }
                })
                ->html()
                ->sortable(),
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('Permissions'))
                ->label(fn ($row) => $row->permissions_label),
            Column::make(__('Number of Users'))
                ->label(fn ($row) => $row->users_count)
                ->sortable(),
            Column::make(__('Actions'))
                ->label(fn ($row) => view('backend.auth.role.includes.actions', ['model' => $row])),
        ];
    }
}
