<?php

namespace App\Livewire\Backend\Pages;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Settings\SettingAbout;
use Filament\Contracts\Plugin;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use App\Livewire\Trait\FrimzTranslatableFields;
use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ManageAbout extends Component implements HasForms, Plugin
{
    use InteractsWithForms, FrimzTranslatableFields;

    public ?array $data = [];

    public function mount(SettingAbout $record): void
    {
        $this->form->fill($record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('banner')
                    ->label(__('Image'))
                    ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file): string => (string) str('img-banner-about.'.$file->getClientOriginalExtension()))
                    ->image()
                    ->disk('public_pages')
                    ->directory('about/banner')
                    ->required()
                    ->maxSize(1024)
                    ->acceptedFileTypes(['image/*']),
                Forms\Components\RichEditor::make('content')
                    ->label(__('Description'))
                    ->required()
                    ->translatable(),
                Forms\Components\Fieldset::make('Values')
                    ->schema([
                        Forms\Components\Repeater::make('values')
                            ->label(__(''))
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->translatable(),
                                Forms\Components\Textarea::make('desc')
                                    ->label(__('Description'))
                                    ->required()
                                    ->translatable(),
                            ])->columns(2),
                    ])->columns(1),
                Forms\Components\Fieldset::make('Vision')
                    ->schema([
                        Forms\Components\Repeater::make('vision')
                            ->label(__(''))
                            ->schema([
                                Forms\Components\Textarea::make('desc')
                                    ->label(__('Text'))
                                    ->required()
                                    ->translatable(),
                            ]),
                    ])->columns(1),
                Forms\Components\Fieldset::make('Mission')
                    ->schema([
                        Forms\Components\Repeater::make('mission')
                            ->label(__(''))
                            ->schema([
                                Forms\Components\Textarea::make('desc')
                                    ->label(__('Text'))
                                    ->required()
                                    ->translatable(),
                            ]),
                    ])->columns(1),
            ])
            ->statePath('data')
            ->model(SettingAbout::class);
    }

    public function save(SettingAbout $record)
    {
        $data = $this->form->getState();

        $record->fill($data);
        $record->save();

        return redirect()->route('admin.settings.about')->with('flash_success', 'About Settings updated successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.pages.manage-about');
    }
}
