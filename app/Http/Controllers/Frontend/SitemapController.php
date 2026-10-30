<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Services;
use App\Settings\SeoSettings;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{
    public function index(SeoSettings $settings): Response
    {
        abort_unless($settings->sitemap_enabled, 404);

        $locales = array_keys(config('boilerplate.locale.languages', []));
        $fallbackLocale = config('app.fallback_locale');
        $urls = [];

        $staticRoutes = [
            'frontend.home' => ['changefreq' => 'daily', 'priority' => '1.0'],
            'frontend.about' => ['changefreq' => 'monthly', 'priority' => '0.7'],
            'frontend.contact-us' => ['changefreq' => 'monthly', 'priority' => '0.7'],
            'frontend.pages.terms' => ['changefreq' => 'yearly', 'priority' => '0.4'],
            'frontend.harga' => ['changefreq' => 'weekly', 'priority' => '0.8'],
            'frontend.post.index' => ['changefreq' => 'daily', 'priority' => '0.8'],
        ];

        foreach ($staticRoutes as $route => $meta) {
            $alternates = $this->localizedUrls($locales, fn (string $locale) => route($route));

            foreach ($alternates as $url) {
                $urls[] = [
                    'loc' => $url,
                    'lastmod' => null,
                    'changefreq' => $meta['changefreq'],
                    'priority' => $meta['priority'],
                    'alternates' => $alternates,
                ];
            }
        }

        Post::published()
            ->with('user')
            ->get()
            ->each(function (Post $post) use (&$urls, $locales, $fallbackLocale) {
                $alternates = $this->localizedUrls($locales, function (string $locale) use ($post, $fallbackLocale) {
                    $slug = $post->getTranslation('slug', $locale)
                        ?: $post->getTranslation('slug', $fallbackLocale);

                    return $slug ? route('frontend.post.show', ['slug' => $slug]) : null;
                });

                foreach ($alternates as $url) {
                    $urls[] = [
                        'loc' => $url,
                        'lastmod' => optional($post->updated_at)->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.8',
                        'alternates' => $alternates,
                    ];
                }
            });

        Services::query()
            ->get()
            ->each(function (Services $service) use (&$urls, $locales) {
                $alternates = $this->localizedUrls($locales, function (string $locale) use ($service) {
                    return $service->slug
                        ? route('frontend.services.page', ['slug' => $service->slug])
                        : null;
                });

                foreach ($alternates as $url) {
                    $urls[] = [
                        'loc' => $url,
                        'lastmod' => optional($service->updated_at)->toAtomString(),
                        'changefreq' => 'monthly',
                        'priority' => '0.7',
                        'alternates' => $alternates,
                    ];
                }
            });

        return response()
            ->view('frontend.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(SeoSettings $settings): Response
    {
        $content = trim((string) $settings->robots_txt);

        if ($settings->sitemap_enabled && ! Str::contains($content, 'Sitemap:')) {
            $content = trim($content . "\n\nSitemap: " . url('/sitemap.xml'));
        }

        return response($content . "\n", 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    /**
     * @param  array<int, string>  $locales
     * @return array<string, string>
     */
    protected function localizedUrls(array $locales, callable $urlResolver): array
    {
        $urls = [];

        foreach ($locales as $locale) {
            $url = $urlResolver($locale);

            if (blank($url)) {
                continue;
            }

            $urls[$locale] = LaravelLocalization::getLocalizedURL($locale, $url);
        }

        return $urls;
    }
}
