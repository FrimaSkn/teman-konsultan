<?php

namespace App\Livewire\Backend\Services;

use Redirect;
use Filament\Forms;
use Livewire\Component;
use App\Models\Services;
use Filament\Forms\Form;
use Filament\Contracts\Plugin;
use App\Models\ServicesCategory;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Concerns\InteractsWithForms;

class ServicesCreate extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

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
                    ->maxLength(255)
                    ->translatable(),
                Forms\Components\Textarea::make('description')
                    ->translatable()
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
