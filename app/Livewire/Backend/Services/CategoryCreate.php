<?php

namespace App\Livewire\Backend\Services;

use App\Models\ServicesCategory;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CategoryCreate extends Component implements HasForms
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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
            ])
            ->statePath('data')
            ->model(ServicesCategory::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = ServicesCategory::create($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->route('admin.services-category.index')->with('flash_success', 'Service created successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.services.category-create');
    }
}
