<?php

namespace App\Support\Seo;

use Illuminate\Support\Str;

class SeoAnalyzer
{
    /**
     * Analyze the SEO state of an article for one locale.
     *
     * @return array{score: int, passed: int, total: int, checks: array<int, array{key: string, label: string, ok: bool, hint: string}>}
     */
    public static function analyze(array $state, ?string $locale = null, bool $hasImage = false): array
    {
        $locale = $locale ?: app()->getLocale();

        $title = self::value($state['title'] ?? null, $locale);
        $excerpt = self::value($state['excerpt'] ?? null, $locale);
        $content = self::value($state['content'] ?? null, $locale);
        $metaTitle = self::value($state['meta_title'] ?? null, $locale) ?: $title;
        $metaDescription = self::value($state['meta_description'] ?? null, $locale) ?: $excerpt;
        $keyword = self::value($state['focus_keyword'] ?? null, $locale);
        $slug = self::value($state['slug'] ?? null, $locale);
        $canonical = trim((string) ($state['canonical_url'] ?? ''));
        $wordCount = self::wordCount($content);

        $titleLength = mb_strlen($metaTitle);
        $descriptionLength = mb_strlen($metaDescription);

        $checks = [
            self::check(
                'meta_title',
                'Meta title is 30-60 characters',
                $titleLength >= 30 && $titleLength <= 60,
                $titleLength . ' characters'
            ),
            self::check(
                'meta_description',
                'Meta description is 120-160 characters',
                $descriptionLength >= 120 && $descriptionLength <= 160,
                $descriptionLength . ' characters'
            ),
            self::check(
                'focus_keyword',
                'Focus keyword is set',
                filled($keyword),
                filled($keyword) ? $keyword : 'Add a focus keyword'
            ),
            self::check(
                'keyword_in_title',
                'Focus keyword appears in the meta title',
                filled($keyword) && Str::contains(Str::lower($metaTitle), Str::lower($keyword)),
                filled($keyword) ? 'Keyword: ' . $keyword : 'Set a focus keyword first'
            ),
            self::check(
                'keyword_in_description',
                'Focus keyword appears in the meta description',
                filled($keyword) && Str::contains(Str::lower($metaDescription), Str::lower($keyword)),
                filled($keyword) ? 'Keyword: ' . $keyword : 'Set a focus keyword first'
            ),
            self::check(
                'content_length',
                'Article has at least 300 words',
                $wordCount >= 300,
                $wordCount . ' words'
            ),
            self::check(
                'image',
                'Featured or social image is available',
                $hasImage,
                $hasImage ? 'Image available' : 'Upload a featured or OG image'
            ),
            self::check(
                'slug',
                'Slug is available',
                filled($slug),
                filled($slug) ? $slug : 'Save the article to generate a slug'
            ),
            self::check(
                'canonical',
                'Canonical URL is valid',
                $canonical === '' || filter_var($canonical, FILTER_VALIDATE_URL) !== false,
                $canonical === '' ? 'Using the article URL' : $canonical
            ),
        ];

        $passed = count(array_filter($checks, fn (array $check) => $check['ok']));
        $total = count($checks);

        return [
            'score' => $total > 0 ? (int) round(($passed / $total) * 100) : 0,
            'passed' => $passed,
            'total' => $total,
            'checks' => $checks,
        ];
    }

    public static function value(mixed $value, ?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();

        if (is_string($value) && Str::startsWith(ltrim($value), '{')) {
            $decoded = json_decode($value, true);

            if (is_array($decoded)) {
                $value = $decoded;
            }
        }

        if (is_array($value)) {
            $supportedLocales = array_keys(config('boilerplate.locale.languages', []));

            if (count(array_intersect(array_keys($value), $supportedLocales)) > 0) {
                $fallback = reset($value);
                $value = $value[$locale] ?? ($fallback ?: '');
            }
        }

        if (is_array($value)) {
            return trim(self::extractText($value));
        }

        return trim((string) $value);
    }

    protected static function extractText(array $value): string
    {
        $parts = [];

        array_walk_recursive($value, function ($item, $key) use (&$parts) {
            if ($key === 'text' && is_string($item)) {
                $parts[] = $item;
            }
        });

        return implode(' ', $parts);
    }

    public static function wordCount(string $content): int
    {
        $text = trim(preg_replace('/\s+/u', ' ', strip_tags($content)));

        if ($text === '') {
            return 0;
        }

        return count(preg_split('/\s+/u', $text) ?: []);
    }

    protected static function check(string $key, string $label, bool $ok, string $hint): array
    {
        return compact('key', 'label', 'ok', 'hint');
    }
}
