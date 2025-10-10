<?php

namespace App\Livewire\Backend\Packages;

use Filament\Forms;
use App\Models\Package;
use Filament\Forms\Get;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use Filament\Contracts\Plugin;
use App\Models\PackageCategory;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Builder;
use Filament\Forms\Contracts\HasForms;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Concerns\InteractsWithForms;

class PackageEdit extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

    public ?array $data = [];

    public $layout;

    public Package $record;


    public function mount(): void
    {
        $this->record->payload = json_decode($this->record->payload, true);
        $this->layout = $this->record->category->layout ?? 'default';
        $this->form->fill($this->record->attributesToArray());
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
                        $this->layout = $data->layout ?? null;
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
                            ->visible(fn () => $this->layout === 'default')
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
                                                Forms\Components\Fieldset::make('Minimum kontrak')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('min_contract')
                                                            ->label('Kontrak')
                                                            ->required(),
                                                        Forms\Components\Select::make('contract_type')
                                                            ->options([
                                                                'daily' => 'Hari',
                                                                'monthly' => 'Bulan',
                                                                'yearly' => 'Tahun',
                                                                'periode' => 'Periode',
                                                                'once' => 'One Time',
                                                                'package' => 'Package',
                                                            ])
                                                            ->required(),
                                                    ]),
                                                Forms\Components\Fieldset::make('Action Button')
                                                    ->schema([
                                                        Forms\Components\Select::make('button_type')
                                                            ->options([
                                                                'order' => 'Order',
                                                                'contact' => 'Contact Us',
                                                            ])
                                                            ->live(onBlur: false)
                                                            ->required(),
                                                        Forms\Components\TextInput::make('package_price')
                                                            ->label('Harga Paket')
                                                            ->visible(fn (Get $get) => $get('button_type') === 'order')
                                                            ->mask(RawJs::make('$money($input)'))
                                                            ->stripCharacters(',')
                                                            ->numeric()
                                                            ->required(),
                                                        Forms\Components\TextInput::make('button_url')
                                                            ->label('Redirect URL')
                                                            ->visible(fn (Get $get) => $get('button_type') === 'contact')
                                                            ->default('#')
                                                            ->required(),
                                                ])
                                            ]),
                                    ])->cloneable()
                            ]),
                        Builder\Block::make('list')
                            ->visible(fn () => $this->layout === 'default')
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
                                        Forms\Components\Fieldset::make('Minimum kontrak')
                                            ->schema([
                                                Forms\Components\TextInput::make('min_contract')
                                                    ->label('Kontrak')
                                                    ->required(),
                                                Forms\Components\Select::make('contract_type')
                                                    ->options([
                                                        'daily' => 'Hari',
                                                        'monthly' => 'Bulan',
                                                        'yearly' => 'Tahun',
                                                        'periode' => 'Periode',
                                                        'once' => 'One Time',
                                                        'package' => 'Package',
                                                    ])
                                                    ->required(),
                                            ]),
                                        Forms\Components\Fieldset::make('button')
                                            ->schema([
                                                Forms\Components\Select::make('button_type')
                                                    ->options([
                                                        'order' => 'Order',
                                                        'contact' => 'Contact Us',
                                                    ])
                                                    ->live(onBlur: false)
                                                    ->required(),
                                                Forms\Components\TextInput::make('package_price')
                                                    ->label('Harga Paket')
                                                    ->visible(fn (Get $get) => $get('button_type') === 'order')
                                                    ->mask(RawJs::make('$money($input)'))
                                                    ->stripCharacters(',')
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('button_url')
                                                    ->label('Redirect URL')
                                                    ->visible(fn (Get $get) => $get('button_type') === 'contact')
                                                    ->default('#')
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
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Harga')
                                    ->required()
                                    ->translatable(),
                            ]),
                        Builder\Block::make('minimum_contract')
                            ->label('Minimum kontrak')
                            ->schema([
                                Forms\Components\TextInput::make('min_contract')
                                    ->label('Kontrak')
                                    ->required(),
                                Forms\Components\Select::make('contract_type')
                                    ->options([
                                        'daily' => 'Hari',
                                        'monthly' => 'Bulan',
                                        'yearly' => 'Tahun',
                                        'periode' => 'Periode',
                                        'once' => 'One Time',
                                        'package' => 'Package',
                                    ])
                                    ->required(),
                            ])->columns(2),
                        Builder\Block::make('coverage')
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\KeyValue::make('coverage')
                                    ->translatable()
                            ]),
                        Builder\Block::make('fitur')
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\KeyValue::make('fitur')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('free')
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\KeyValue::make('free')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('additional')
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\KeyValue::make('additional')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('meeting')
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\KeyValue::make('meeting')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('pembukuan')
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\KeyValue::make('pembukuan')
                                    ->translatable(),
                            ]),
                        Builder\Block::make('support')
                            ->visible(fn () => $this->layout === 'slider')
                            ->schema([
                                Forms\Components\KeyValue::make('support')
                                    ->translatable(),

                            ]),
                        Builder\Block::make('button')
                            ->schema([
                                Forms\Components\Select::make('button_type')
                                    ->options([
                                        'order' => 'Order',
                                        'contact' => 'Contact Us',
                                    ])
                                    ->live(onBlur: false)
                                    ->required(),
                                Forms\Components\TextInput::make('package_price')
                                    ->label('Harga Paket')
                                    ->visible(fn (Get $get) => $get('button_type') === 'order')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('button_url')
                                    ->label('Redirect URL')
                                    ->visible(fn (Get $get) => $get('button_type') === 'contact')
                                    ->default('#')
                                    ->required(),
                            ]),
                        Builder\Block::make('text_editor')
                            ->label('Teks Editor')
                            ->schema([
                                Forms\Components\RichEditor::make('text_editor')
                                    ->required()
                                    ->translatable(),
                            ])
                            ->visible(fn () => $this->layout === 'default'),
                ])->blockNumbers(false)
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        // dd($data);

        $this->record->update($data);

        return redirect()->route('admin.packages.index')
            ->with('flash_success', 'Paket berhasil diperbarui.');
    }

    public function render(): View
    {
        return view('livewire.backend.packages.packages-edit');
    }
}
