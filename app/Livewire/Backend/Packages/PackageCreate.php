<?php

namespace App\Livewire\Backend\Packages;

use Filament\Forms;
use App\Models\Package;
use Filament\Forms\Get;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Contracts\Plugin;
use App\Models\PackageCategory;
use Filament\Forms\Components\Grid;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Filament\Forms\Components\Builder;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Concerns\InteractsWithForms;

class PackageCreate extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

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
                Forms\Components\TextInput::make('title')
                    ->label('Nama paket')
                    ->required()
                    ->translatable(),

                Builder::make('payload')
                    ->label('')
                    ->blocks([
                        Builder\Block::make('table')
                            ->hidden(function () {
                                if ($this->layout === 'default') {
                                    return false;
                                }
                                return true;
                            })
                            ->schema([
                                Builder::make('table')
                                    ->label('')
                                    ->schema([
                                         Builder\Block::make('row')
                                            ->schema([
                                                Forms\Components\KeyValue::make('table')
                                                ->label('')
                                                ->keyLabel('Nama Kolom')
                                                ->translatable(),
                                                Forms\Components\Fieldset::make('Action Button')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('button_text')
                                                            ->required()
                                                            ->translatable(),
                                                        Forms\Components\TextInput::make('button_url')
                                                            ->label('URL')
                                                            ->required(),
                                                ])
                                            ]),
                                    ])->cloneable()
                            ]),
                        Builder\Block::make('list')
                            ->hidden(function () {
                                if ($this->layout === 'default') {
                                    return false;
                                }
                                return true;
                            })
                            ->schema([
                                Forms\Components\Repeater::make('list')
                                    ->schema([
                                        Forms\Components\TextInput::make('key')
                                            ->label('')
                                            ->required()
                                            ->translatable(),
                                        Forms\Components\TextInput::make('value')
                                            ->label('')
                                            ->translatable(),
                                        Forms\Components\Fieldset::make('button')
                                            ->schema([
                                                Forms\Components\TextInput::make('button_text')
                                                    ->label('Teks Tombol')
                                                    ->required()
                                                    ->translatable(),
                                                Forms\Components\TextInput::make('button_url')
                                                    ->label('URL')
                                                    ->required(),
                                            ]),

                                    ])
                                    ->columns(2)

                            ]),
                        Builder\Block::make('subtitle')
                            ->schema([
                                Forms\Components\TextInput::make('sub_title')
                                    ->label('Sub title')
                                    ->required()
                                    ->translatable(),
                            ]),
                        Builder\Block::make('price')
                            ->label('Harga paket')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Harga')
                                    ->required()
                                    ->translatable(),
                            ]),
                        Builder\Block::make('minimum_contract')
                            ->label('Minimum kontrak')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\TextInput::make('min_contract')
                                    ->label('Kontrak')
                                    ->required()
                                    ->translatable(),
                            ]),
                        Builder\Block::make('coverage')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\KeyValue::make('coverage')
                                    ->translatable()
                            ]),
                        Builder\Block::make('fitur')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\KeyValue::make('fitur')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('free')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\KeyValue::make('free')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('additional')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\KeyValue::make('additional')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('meeting')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\KeyValue::make('meeting')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('pembukuan')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\KeyValue::make('pembukuan')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('support')
                            ->hidden(function () {
                                if ($this->layout !== 'slider') {
                                    return true;
                                }
                                return false;
                            })
                            ->schema([
                                Forms\Components\KeyValue::make('support')
                                    ->translatable(),

                            ]),
                        Builder\Block::make('button')
                            ->schema([
                                Forms\Components\TextInput::make('button_text')
                                    ->required()
                                    ->translatable(),
                                Forms\Components\TextInput::make('button_url')
                                    ->label('URL'),
                            ]),
                        Builder\Block::make('text_editor')
                            ->label('Teks Editor')
                            ->schema([
                                Forms\Components\RichEditor::make('text_editor')
                                    ->required()
                                    ->translatable(),
                            ])
                            ->hidden(function () {
                                if ($this->layout === 'default') {
                                    return false;
                                }
                                return true;
                            }),
                ])->blockNumbers(false)
            ])
            ->statePath('data')
            ->model(Package::class);
    }

    public function create()
    {
        $data = $this->form->getState();
        // dd($data);

        $data['payload'] = json_encode($data['payload']);


        $record = Package::create($data);

        $this->form->model($record)->saveRelationships();

        return redirect()->route('admin.packages.index')
            ->with('flash_success', 'Paket berhasil dibuat.');
    }

    public function render(): View
    {
        return view('livewire.backend.packages.package-create');
    }
}
