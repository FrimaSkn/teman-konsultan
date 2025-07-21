<?php

namespace App\Livewire\Backend\Pages;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Settings\GeneralSettings as ModelGeneralSettings;
use Filament\Forms\Components\Grid;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GeneralSettings extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(ModelGeneralSettings $record): void
    {
        $this->form->fill($record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Banner Pages')
                    ->schema([
                        Forms\Components\FileUpload::make('banner_article')
                            ->label(__('Banner Page Article'))
                            ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file): string => (string) str('img-banner-article.'.$file->getClientOriginalExtension()))
                            ->image()
                            ->disk('public_pages')
                            ->directory('banner')
                            ->required()
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*']),
                        Forms\Components\FileUpload::make('banner_contact')
                            ->label(__('Banner Page Contact Us'))
                            ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file): string => (string) str('img-banner-contact.'.$file->getClientOriginalExtension()))
                            ->image()
                            ->disk('public_pages')
                            ->directory('banner')
                            ->required()
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*'])
                    ])->columns(1),
                Forms\Components\Fieldset::make('Contact Information')
                    ->schema([
                        Forms\Components\Section::make('Address')
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        Forms\Components\ViewField::make('Preview')
                                            ->view('backend.filament.google-maps'),
                                    ])->columnSpan(2),
                                Grid::make(1)
                                    ->schema([
                                            Forms\Components\Textarea::make('addrs_head_office')
                                                ->label(__('Address Head Office'))
                                                ->required(),
                                            Forms\Components\Textarea::make('gmap_head_office')
                                                    ->label(__('Google Map Head Office'))
                                                    ->live(onBlur: true)
                                                    ->required(),
                                            Forms\Components\Textarea::make('addrs_workshop')
                                                ->label(__('Address Workshop'))
                                                ->required(),
                                            Forms\Components\Textarea::make('gmap_workshop')
                                                    ->label(__('Google Map Workshop'))
                                                    ->live(onBlur: true)
                                                    ->required(),
                                    ])->columnSpan(3),

                            ])->columns(5),
                        Forms\Components\TextInput::make('whatsapp')
                            ->label(__('WhatsApp'))
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

                                    // $number = ltrim($number, '+');
                                    // $countryCode = substr($number, 0, 2);
                                    // $rest = substr($number, 2);
                                    // $part1 = substr($rest, 0, 3);
                                    // $part2 = substr($rest, 3, 4);
                                    // $part3 = substr($rest, 7, 4);

                                    // $number = "+" . $countryCode . " " . $part1 . "-" . $part2 . "-" . $part3;
                                    $set('whatsapp', $number);
                                }
                            })
                            ->helperText(__('Format: +628123456789'))
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('Phone'))
                            ->required(),
                    ])->columns(1),
                Forms\Components\Fieldset::make('Social Media')
                    ->schema([
                        Forms\Components\Repeater::make('social_media')
                            ->schema([
                                Forms\Components\FileUpload::make('icon')
                                    ->label(__('Icon'))
                                    ->image()
                                    ->disk('public_pages')
                                    ->directory('social')
                                    ->required()
                                    ->maxSize(1024),
                                Forms\Components\Grid::make(1)
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label(__('Name'))
                                            ->required(),
                                        Forms\Components\TextInput::make('link')
                                            ->label(__('Link'))
                                            ->required(),
                                    ])->columnSpan(1)
                            ])->columns(2)
                    ])->columns(1)
            ])
            ->statePath('data')
            ->model(ModelGeneralSettings::class);
    }

    public function save(ModelGeneralSettings $record)
    {
        $data = $this->form->getState();

        $record->fill($data);
        $record->save();

        return redirect()->route('admin.settings.general')->with('flash_success', 'General Settings updated successfully.');

    }

    public function render(): View
    {
        return view('livewire.backend.pages.general-settings');
    }
}
