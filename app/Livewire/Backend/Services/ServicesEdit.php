<?php

namespace App\Livewire\Backend\Services;

use Filament\Forms;
use Livewire\Component;
use App\Models\Services;
use Filament\Forms\Form;
use App\Models\ServicesCategory;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class ServicesEdit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Services $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->options(ServicesCategory::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Service Name'),
                Forms\Components\TextArea::make('description')
                    ->nullable()
                    ->maxLength(1000)
                    ->label('Description'),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);

        Notification::make()
            ->title('Updated successfully')
            ->success()
            ->send();

        return redirect()->route('admin.services.index')->with('flash_success', 'Service updated successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.services.services-edit');
    }
}
