<?php

namespace App\Livewire\Backend\Pages;

use App\Settings\SeoSettings as ModelSeoSettings;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SeoSettings extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(ModelSeoSettings $record): void
    {
        $this->form->fill($record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General')
                    ->description('Defaults used when an article or page does not define its own SEO values.')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Site name')
                            ->required(),
                        Forms\Components\TextInput::make('title_template')
                            ->label('Title template')
                            ->helperText('Use {title} and {site}. Example: {title} | {site}')
                            ->required(),
                        Forms\Components\Textarea::make('default_meta_description')
                            ->label('Default meta description')
                            ->rows(3),
                        Forms\Components\FileUpload::make('default_og_image')
                            ->label('Default social share image')
                            ->image()
                            ->disk('public_pages')
                            ->directory('seo')
                            ->maxSize(2048)
                            ->helperText('Used when an article has no featured or social image. Recommended: 1200x630.'),
                        Forms\Components\Select::make('default_robots')
                            ->label('Default search engine visibility')
                            ->options([
                                'index,follow' => 'Index, follow',
                                'noindex,follow' => 'No index, follow',
                                'index,nofollow' => 'Index, no follow',
                                'noindex,nofollow' => 'No index, no follow',
                            ])
                            ->required(),
                        Forms\Components\Toggle::make('sitemap_enabled')
                            ->label('Enable sitemap.xml'),
                    ])->columns(2),
                Section::make('Social')
                    ->schema([
                        Forms\Components\TextInput::make('twitter_site')
                            ->label('Twitter / X handle')
                            ->placeholder('@temankonsultan'),
                    ])->columns(2),
                Section::make('Verification & Analytics')
                    ->schema([
                        Forms\Components\TextInput::make('google_site_verification')
                            ->label('Google site verification'),
                        Forms\Components\TextInput::make('bing_site_verification')
                            ->label('Bing site verification'),
                        Forms\Components\TextInput::make('google_analytics_id')
                            ->label('Google Analytics measurement ID')
                            ->placeholder('G-XXXXXXXXXX'),
                    ])->columns(2),
                Section::make('Organization')
                    ->description('Used for Organization structured data.')
                    ->schema([
                        Forms\Components\TextInput::make('organization_name')
                            ->label('Organization name'),
                        Forms\Components\FileUpload::make('organization_logo')
                            ->label('Organization logo')
                            ->image()
                            ->disk('public_pages')
                            ->directory('seo')
                            ->maxSize(1024),
                        Forms\Components\TagsInput::make('organization_same_as')
                            ->label('Social profile URLs')
                            ->placeholder('https://...')
                            ->helperText('Press enter after each URL.')
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('robots.txt')
                    ->description('The sitemap line is added automatically.')
                    ->schema([
                        Forms\Components\Textarea::make('robots_txt')
                            ->label('robots.txt content')
                            ->rows(8)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data')
            ->model(ModelSeoSettings::class);
    }

    public function save(ModelSeoSettings $record)
    {
        $data = $this->form->getState();

        $record->fill($data);
        $record->save();

        return redirect()->route('admin.settings.seo')->with('flash_success', 'SEO settings updated successfully.');
    }

    public function render(): View
    {
        return view('livewire.backend.pages.seo-settings');
    }
}
