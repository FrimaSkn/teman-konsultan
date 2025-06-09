<?php

namespace App\Livewire\Backend\Services;

use Filament\Forms;
use Livewire\Component;
use App\Models\Services;
use Filament\Forms\Form;
use App\Models\ServicesCategory;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Redirect;

class ServicesCreate extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->options(ServicesCategory::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
            ])
            ->statePath('data')
            ->model(Services::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Services::create($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->route('admin.services.index')->with('flash_success', 'Service created successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.services.services-create');
    }
}
