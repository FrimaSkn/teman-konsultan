<?php

namespace App\Livewire\Backend;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

/**
 * Class UsersTable.
 */
class UsersTable extends DataTableComponent
{
    /**
     * @var
     */
    public $status;

    /**
     * @var array|string[]
     */
    public array $sortNames = [
        'email_verified_at' => 'Verified',
        'two_factor_auth_count' => '2FA',
    ];

    /**
     * @var array|string[]
     */
    public array $filterNames = [
        'type' => 'User Type',
        'verified' => 'E-mail Verified',
    ];

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
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

    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        $query = User::with('roles', 'twoFactorAuth')->withCount('twoFactorAuth');

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }

        return $query
            ->when($this->getAppliedFilterWithValue('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getAppliedFilterWithValue('type'), fn ($query, $type) => $query->where('type', $type))
            ->when($this->getAppliedFilterWithValue('active'), fn ($query, $active) => $query->where('active', $active === 'yes'))
            ->when($this->getAppliedFilterWithValue('verified'), fn ($query, $verified) => $verified === 'yes' ? $query->whereNotNull('email_verified_at') : $query->whereNull('email_verified_at'));
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            SelectFilter::make('User Type', 'type')
                ->options([
                    '' => 'Any',
                    User::TYPE_ADMIN => 'Administrators',
                    User::TYPE_USER => 'Users',
                ]),
            SelectFilter::make('Active', 'active')
                ->options([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
            SelectFilter::make('E-mail Verified', 'verified')
                ->options([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->sortable()
                ->label(function ($row) {
                    if ($row->type === User::TYPE_ADMIN) {
                        return __('Administrator');
                    } elseif ($row->type === User::TYPE_USER) {
                        return __('User');
                    } else {
                        return __('Unknown');
                    }
                }),
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('E-mail'), 'email')
                ->sortable(),
            Column::make(__('Verified'), 'email_verified_at')
                ->sortable()
                ->label(fn($row) => view('backend.auth.user.includes.verified', ['user' => $row])),
            Column::make(__('2FA'))
                ->sortable()
                ->label(fn($row) => view('backend.auth.user.includes.2fa', ['user' => $row])),
            Column::make(__('Roles'))
                ->label(fn($row) => $row->roles_label),
            Column::make(__('Additional Permissions'))
                ->label(fn($row) => $row->permission_label),
            Column::make(__('Actions'))
                ->label(fn($row) => view('backend.auth.user.includes.actions', ['user' => $row])),
        ];
    }
}
