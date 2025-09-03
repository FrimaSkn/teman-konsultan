<?php

namespace App\Livewire\Backend\Services;

use Filament\Forms;
use Livewire\Component;
use App\Models\Services;
use Filament\Forms\Form;
use Filament\Contracts\Plugin;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Concerns\InteractsWithForms;

class ServicesPage extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

    public ?array $data = [];

    public Services $record;

    public function mount(): void
    {
        $this->record->page_content = json_decode($this->record->page_content, true);
        $this->record->meta_seo = json_decode($this->record->meta_seo, true);

        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Builder::make('page_content')
                    ->blocks([
                        Builder\Block::make('banner')
                            ->schema([
                                Forms\Components\FileUpload::make('content')
                                    ->disk('public_service')
                                    ->directory('pages')
                                    ->label('Banner Image')
                                    ->image()
                                    ->required(),
                            ]),
                        Builder\Block::make('heading')
                            ->schema([
                                Forms\Components\TextInput::make('content')
                                    ->label('Heading')
                                    ->required()
                                    ->translatable()
                                    ->columnSpanFull(),
                               Forms\Components\Select::make('level')
                                    ->options([
                                        'h1' => 'Heading 1',
                                        'h2' => 'Heading 2',
                                        'h3' => 'Heading 3',
                                        'h4' => 'Heading 4',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('alignment')
                                    ->options([
                                        'left' => 'Left',
                                        'center' => 'Center',
                                        'right' => 'Right',
                                    ])
                                    ->default('center')
                                    ->required(),
                            ])->columns(2),
                        Builder\Block::make('paragraph')
                            ->schema([
                                Forms\Components\RichEditor::make('content')
                                    ->label('Paragraph')
                                    ->required()
                                    ->translatable(),
                            ]),

                        Builder\Block::make('image')
                            ->schema([
                                Forms\Components\FileUpload::make('content')
                                    ->disk('public_service')
                                    ->directory('pages/content')
                                    ->label('Image')
                                    ->image()
                                    ->required(),
                            ]),
                        // Builder\Block::make('video')
                        //     ->schema([
                        //         Forms\Components\FileUpload::make('content')
                        //             ->disk('public_service')
                        //             ->directory('pages/content')
                        //             ->label('Video')
                        //             ->acceptedFileTypes(['video/mp4', 'video/webm'])
                        //             ->helperText(__('Format: mp4, webm'))
                        //             ->required(),
                        //     ]),
                        Builder\Block::make('whatsapp')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Text')
                                    ->required()
                                    ->translatable()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('whatsapp')
                                    ->label(__('No. WhatsApp'))
                                    ->live(onBlur: true)
                                    ->mask(function (Forms\Get $get, Forms\Set $set) {
                                        if (!empty($get('whatsapp'))) {
                                            $number = $get('whatsapp');
                                            $number = preg_replace('/\D/', '', $number);

                                            if (substr($number, 0, 1) === '0') {
                                                $number = '+62' . substr($number, 1);
                                            } else if (substr($number, 0, 2) === '62') {
                                                $number = '+' . $number;
                                            } else if (substr($number, 0, 3) === '+62') {
                                            } else {
                                                $number = '+62' . $number;
                                            }
                                            $set('whatsapp', $number);
                                        }
                                    })
                                    ->helperText(__('Format: +628123456789'))
                                    ->required(),
                                Forms\Components\Select::make('alignment')
                                    ->options([
                                        'left' => 'Left',
                                        'center' => 'Center',
                                        'right' => 'Right',
                                    ])
                                    ->default('center')
                                    ->required(),
                            ])->columns(2),
                        Builder\Block::make('button')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Button Text')
                                    ->required()
                                    ->translatable()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('url')
                                    ->label('Button URL')
                                    ->url()
                                    ->required(),
                                Forms\Components\Select::make('alignment')
                                    ->options([
                                        'left' => 'Left',
                                        'center' => 'Center',
                                        'right' => 'Right',
                                    ])
                                    ->default('center')
                                    ->required(),
                            ])->columns(2),
                    ])
                ])->columnSpan(['xl' => 8]),
                Section::make()->schema([
                    Builder::make('meta_seo')
                    ->label('Meta SEO')
                    ->maxItems(1)
                    ->blocks([
                        Builder\Block::make('meta_seo')
                            ->label('Meta SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->required()
                                    ->translatable()
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->helperText('Max 160 characters')
                                    ->required()
                                    ->translatable()
                                    ->columnSpanFull(),
                            ]),
                    ])
                ])->columnSpan(['xl' => 4]),
            ])
            ->columns(12)
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);

        return redirect()->route('admin.services.page', $this->record)->with('flash_success', 'Page Service updated successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.services.services-page');
    }
}
