<?php

namespace App\Livewire\Backend\Pages;

use Redirect;
use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Settings\SettingHome;
use Filament\Contracts\Plugin;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;

class ManageHome extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

    public ?array $data = [];

    public function mount(SettingHome $record)
    {
        $this->form->fill($record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Hero Section')
                    ->schema([
                        Repeater::make('banner')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label(__('Image'))
                                    ->image()
                                    ->disk('public_pages')
                                    ->directory('home/banner')
                                    ->required()
                                    ->maxSize(1024)
                                    ->acceptedFileTypes(['image/*']),
                        ]),
                        Grid::make(1)
                            ->schema([
                                Forms\Components\TextInput::make('hero_title')
                                    ->label(__('Hero Title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->translatable(),
                                Forms\Components\Textarea::make('hero_desc')
                                    ->label(__('Hero Description'))
                                    ->required()
                                    ->maxLength(500)
                                    ->translatable(),
                                Forms\Components\TextInput::make('hero_link')
                                    ->label(__('Hero Link'))
                                    ->required()
                                    ->maxLength(255)
                            ])->columnSpan(1),
                    ])->columns(2),
                Fieldset::make('About Section')
                    ->schema([
                        Forms\Components\FileUpload::make('about_image')
                            ->label(__('Image'))
                            ->image()
                            ->disk('public_pages')
                            ->directory('home/about')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*']),
                        Grid::make(1)
                            ->schema([
                                Forms\Components\TextInput::make('about_title')
                                    ->label(__('Title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->translatable(),
                                Forms\Components\Textarea::make('about_description')
                                    ->label(__('Description'))
                                    ->required()
                                    ->maxLength(1000)
                                    ->translatable(),
                            ])->columnSpan(1),
                    ])
                    ->columns(2),
                Fieldset::make('why choose us Section')
                    ->schema([
                        Repeater::make('section_4_content')
                            ->label(__('Content'))
                            ->schema([
                                Forms\Components\FileUpload::make('icon')
                                    ->label(__('Icon'))
                                    ->image()
                                    ->disk('public_pages')
                                    ->directory('home/about')
                                    ->maxSize(1024)
                                    ->acceptedFileTypes(['image/*']),
                                Grid::make(1)
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label(__('Title'))
                                            ->required()
                                            ->translatable(),
                                        Forms\Components\Textarea::make('description')
                                            ->label(__('Description'))
                                            ->required()
                                            ->translatable()
                                    ])->columnSpan(1),
                            ])->columns(2)
                    ])
                    ->columns(1),
                ])
            ->statePath('data')
            ->model(SettingHome::class);
    }

    public function save(SettingHome $record)
    {
        $data = $this->form->getState();

        $record->fill($data);
        $record->save();

        return redirect()->route('admin.settings.home')->with('flash_success', 'Home Settings updated successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.pages.manage-home');
    }
}
