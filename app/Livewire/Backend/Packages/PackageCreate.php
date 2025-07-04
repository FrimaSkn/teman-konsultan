<?php

namespace App\Livewire\Backend\Packages;

use Filament\Forms;
use App\Models\Package;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\PackageCategory;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Builder;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Get;

class PackageCreate extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $layout;

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
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (?string $state) {
                        $data = PackageCategory::find($state);
                        $this->layout = $data->layout ?? 'default';
                    })
                    ->label('Category')
                    ->options(PackageCategory::all()->pluck('name', 'id'))
                    ->searchable(),
                Builder::make('payload')
                    ->blocks([
                        Builder\Block::make('table')
                            ->schema([
                                Forms\Components\KeyValue::make('table')
                                    ->addActionLabel('Add Field')

                            ])
                            ->hidden(function () {
                                if ($this->layout === 'default') {
                                    return false;
                                }
                                return true;
                            }),
                        Builder\Block::make('paragraph')
                            ->schema([
                                Forms\Components\Textarea::make('content')
                                    ->label('Paragraph')
                                    ->required(),
                            ]),
                        Builder\Block::make('image')
                            ->schema([
                                Forms\Components\FileUpload::make('url')
                                    ->label('Image')
                                    ->image()
                                    ->required(),
                                Forms\Components\TextInput::make('alt')
                                    ->label('Alt text')
                                    ->required(),
                            ]),
                ])->blockNumbers(false)
            ])
            ->statePath('data')
            ->model(Package::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();
        dd($data);

        $data['payload'] = json_encode($data['payload']);


        $record = Package::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.backend.packages.package-create');
    }
}
