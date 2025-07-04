<?php

namespace App\Livewire\Backend\Packages;

use App\Livewire\Trait\FrimzTranslatableFields;
use App\Models\PackageCategory;
use Filament\Contracts\Plugin;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CategoryCreate extends Component implements HasForms, Plugin
{
    use InteractsWithForms;
    use FrimzTranslatableFields;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('layout')
                    ->options([
                        'default' => 'Default',
                        'slider' => 'Slider',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->translatable(),
                Forms\Components\Textarea::make('description')->translatable(),
                Forms\Components\Textarea::make('note')->translatable(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ])
            ->statePath('data')
            ->model(PackageCategory::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = PackageCategory::create($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->route('admin.packages.category.index')->with('flash_success', 'Category package created successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.packages.category-create');
    }
}
