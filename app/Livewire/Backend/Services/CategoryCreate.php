<?php

namespace App\Livewire\Backend\Services;

use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\ServicesCategory;
use Filament\Contracts\Plugin;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CategoryCreate extends Component implements HasForms, Plugin
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
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('service_category'),
                Forms\Components\TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->translatable(),
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
