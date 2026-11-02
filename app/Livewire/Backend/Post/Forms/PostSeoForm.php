<?php

namespace App\Livewire\Backend\Post\Forms;

use App\Support\Seo\SeoAnalyzer;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Get;

class PostSeoForm
{
    public static function schema(): Section
    {
        return Section::make('SEO')
            ->description('Search engine and social sharing settings for this article.')
            ->collapsible()
            ->schema([
                Forms\Components\TextInput::make('meta_title')
                    ->label('Meta title')
                    ->maxLength(70)
                    ->helperText('Ideal length: 30-60 characters. Leave empty to use the article title.')
                    ->live(onBlur: true)
                    ->translatable(),
                Forms\Components\Textarea::make('meta_description')
                    ->label('Meta description')
                    ->rows(3)
                    ->maxLength(170)
                    ->helperText('Ideal length: 120-160 characters. Leave empty to use the article excerpt.')
                    ->live(onBlur: true)
                    ->translatable(),
                Forms\Components\TextInput::make('focus_keyword')
                    ->label('Focus keyword')
                    ->helperText('The main keyword this article should rank for.')
                    ->live(onBlur: true)
                    ->translatable(),
                Forms\Components\TextInput::make('canonical_url')
                    ->label('Canonical URL')
                    ->url()
                    ->helperText('Optional. Leave empty to use this article URL.'),
                Forms\Components\Select::make('robots')
                    ->label('Search engine visibility')
                    ->options([
                        'index,follow' => 'Index, follow',
                        'noindex,follow' => 'No index, follow',
                        'index,nofollow' => 'Index, no follow',
                        'noindex,nofollow' => 'No index, no follow',
                    ])
                    ->default('index,follow')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('og_image')
                    ->label('Social share image')
                    ->collection('post_og_image')
                    ->image()
                    ->helperText('Optional. Recommended size: 1200x630. Falls back to the featured image.'),
                ViewField::make('seo_preview')
                    ->view('backend.filament.seo-preview')
                    ->viewData(fn (Get $get) => static::previewData($get))
                    ->dehydrated(false)
                    ->columnSpanFull(),
                ViewField::make('seo_checklist')
                    ->view('backend.filament.seo-checklist')
                    ->viewData(fn (Get $get) => SeoAnalyzer::analyze(
                        [
                            'title' => $get('title'),
                            'excerpt' => $get('excerpt'),
                            'content' => $get('content'),
                            'meta_title' => $get('meta_title'),
                            'meta_description' => $get('meta_description'),
                            'focus_keyword' => $get('focus_keyword'),
                            'slug' => $get('slug'),
                            'canonical_url' => $get('canonical_url'),
                        ],
                        app()->getLocale(),
                        filled($get('image')) || filled($get('og_image'))
                    ))
                    ->dehydrated(false)
                    ->columnSpanFull(),
            ])
            ->columns(1)
            ->columnSpanFull();
    }

    /**
     * @return array{title: string, description: string, url: string}
     */
    protected static function previewData(Get $get): array
    {
        $locale = app()->getLocale();

        $title = SeoAnalyzer::value($get('meta_title'), $locale)
            ?: SeoAnalyzer::value($get('title'), $locale)
            ?: __('Untitled article');

        $description = SeoAnalyzer::value($get('meta_description'), $locale)
            ?: SeoAnalyzer::value($get('excerpt'), $locale)
            ?: __('Add a meta description to control how this article appears in search results.');

        $slug = SeoAnalyzer::value($get('slug'), $locale);
        $url = $get('canonical_url') ?: url('/artikel/' . ($slug ?: 'your-article-slug'));

        return [
            'title' => $title,
            'description' => $description,
            'url' => $url,
        ];
    }
}
