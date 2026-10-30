<?php

namespace App\Support\Seo;

use App\Models\Post;
use App\Models\Services;
use App\Settings\SeoSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SeoResolver
{
    public function __construct(protected SeoSettings $settings)
    {
    }

    /**
     * Build all SEO data needed by the frontend head component.
     *
     * @return array<string, mixed>
     */
    public function resolve(?Model $model = null, ?string $title = null, ?string $description = null): array
    {
        $locale = app()->getLocale();
        $siteName = $this->settings->site_name ?: appName();
        $isPost = $model instanceof Post;
        $isService = $model instanceof Services;

        $modelTitle = match (true) {
            $isPost => $model->seo_title,
            $isService => (string) $model->name,
            default => null,
        };

        $modelDescription = match (true) {
            $isPost => $model->seo_description,
            $isService => strip_tags((string) $model->description),
            default => null,
        };

        $pageTitle = $modelTitle ?: $title ?: $siteName;
        $fullTitle = $this->fullTitle($pageTitle, $siteName);

        $metaDescription = trim(strip_tags(
            (string) ($modelDescription ?: $description ?: $this->settings->default_meta_description ?: $siteName)
        ));

        $image = $isPost ? $model->seo_image : null;
        $image = $this->absoluteUrl($image) ?: $this->publicPagesUrl($this->settings->default_og_image);

        $canonical = $isPost && filled($model->canonical_url)
            ? $model->canonical_url
            : url()->current();

        $robots = $isPost
            ? $model->seo_robots
            : ($this->settings->default_robots ?: 'index,follow');

        $publishedTime = $isPost && $model->created_at
            ? $model->created_at->toIso8601String()
            : null;

        $modifiedTime = $isPost && $model->updated_at
            ? $model->updated_at->toIso8601String()
            : null;

        $author = $isPost
            ? ($model->user?->name ?: $siteName)
            : null;

        $alternates = $this->alternates($model);
        $breadcrumbs = $this->breadcrumbs($model, $pageTitle, $canonical);
        $organizationId = url('/') . '#organization';

        $graph = [
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'url' => url('/'),
                'name' => $siteName,
                'inLanguage' => $locale,
            ],
            $this->organizationSchema($organizationId, $siteName),
        ];

        if ($isPost) {
            $graph[] = [
                '@type' => 'Article',
                '@id' => $canonical . '#article',
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $canonical,
                ],
                'headline' => Str::limit($pageTitle, 110, ''),
                'description' => $metaDescription,
                'image' => array_values(array_filter([$image])),
                'datePublished' => $publishedTime,
                'dateModified' => $modifiedTime,
                'author' => [
                    '@type' => 'Person',
                    'name' => $author,
                ],
                'publisher' => [
                    '@id' => $organizationId,
                ],
                'inLanguage' => $locale,
            ];
        }

        if (! empty($breadcrumbs)) {
            $graph[] = [
                '@type' => 'BreadcrumbList',
                'itemListElement' => collect($breadcrumbs)
                    ->map(fn (array $crumb, int $index) => [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'name' => $crumb['name'],
                        'item' => $crumb['url'],
                    ])
                    ->values()
                    ->all(),
            ];
        }

        return [
            'title' => $fullTitle,
            'pageTitle' => $pageTitle,
            'description' => $metaDescription,
            'canonical' => $canonical,
            'robots' => $robots,
            'type' => $isPost ? 'article' : 'website',
            'image' => $image,
            'locale' => $locale,
            'ogLocale' => $this->ogLocale($locale),
            'siteName' => $siteName,
            'twitterSite' => $this->settings->twitter_site,
            'alternates' => $alternates,
            'publishedTime' => $publishedTime,
            'modifiedTime' => $modifiedTime,
            'author' => $author,
            'googleSiteVerification' => $this->settings->google_site_verification,
            'bingSiteVerification' => $this->settings->bing_site_verification,
            'analyticsId' => $this->settings->google_analytics_id,
            'jsonLd' => [
                '@context' => 'https://schema.org',
                '@graph' => $graph,
            ],
        ];
    }

    protected function fullTitle(string $title, string $siteName): string
    {
        if ($title === $siteName) {
            return $siteName;
        }

        $template = $this->settings->title_template ?: '{title} | {site}';

        return str_replace(['{title}', '{site}'], [$title, $siteName], $template);
    }

    /**
     * @return array<string, string>
     */
    protected function alternates(?Model $model): array
    {
        if (! $model instanceof Post) {
            return [];
        }

        $languages = array_keys(config('boilerplate.locale.languages', []));
        $fallbackLocale = config('app.fallback_locale');
        $alternates = [];

        foreach ($languages as $locale) {
            $slug = $model->getTranslation('slug', $locale)
                ?: $model->getTranslation('slug', $fallbackLocale);

            if (blank($slug)) {
                continue;
            }

            $alternates[$locale] = LaravelLocalization::getLocalizedURL(
                $locale,
                route('frontend.post.show', ['slug' => $slug])
            );
        }

        if (! empty($alternates)) {
            $alternates['x-default'] = $alternates[$fallbackLocale] ?? reset($alternates);
        }

        return $alternates;
    }

    /**
     * @return array<int, array{name: string, url: string}>
     */
    protected function breadcrumbs(?Model $model, string $title, string $canonical): array
    {
        if (! $model instanceof Post) {
            return [];
        }

        $locale = app()->getLocale();

        return [
            [
                'name' => __('Home'),
                'url' => LaravelLocalization::getLocalizedURL($locale, route('frontend.home')),
            ],
            [
                'name' => __('Artikel'),
                'url' => LaravelLocalization::getLocalizedURL($locale, route('frontend.post.index')),
            ],
            [
                'name' => $title,
                'url' => $canonical,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function organizationSchema(string $organizationId, string $siteName): array
    {
        $schema = [
            '@type' => 'Organization',
            '@id' => $organizationId,
            'name' => $this->settings->organization_name ?: $siteName,
            'url' => url('/'),
        ];

        if ($logo = $this->publicPagesUrl($this->settings->organization_logo)) {
            $schema['logo'] = [
                '@type' => 'ImageObject',
                'url' => $logo,
            ];
        }

        $sameAs = collect($this->settings->organization_same_as ?? [])
            ->filter()
            ->values()
            ->all();

        if (! empty($sameAs)) {
            $schema['sameAs'] = $sameAs;
        }

        return $schema;
    }

    protected function publicPagesUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        return $this->absoluteUrl(Storage::disk('public_pages')->url($path));
    }

    protected function absoluteUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        if (Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }

        return url($url);
    }

    protected function ogLocale(string $locale): string
    {
        return match ($locale) {
            'id' => 'id_ID',
            'en' => 'en_US',
            default => str_replace('-', '_', $locale),
        };
    }
}
