<?php

namespace App\Livewire\Trait;

use Closure;
use Filament\Panel;
use Illuminate\Support\Arr;
use Filament\Contracts\Plugin;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Field;

trait FrimzTranslatableFields
{
    protected array|Closure $supportedLocales = [];

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }

    public function getId(): string
    {
        return 'outerweb-filament-translatable-fields';
    }

    public function supportedLocales(array|Closure $supportedLocales): static
    {
        $this->supportedLocales = $supportedLocales;

        return $this;
    }

    public function getSupportedLocales(): array
    {
        $locales = is_callable($this->supportedLocales) ? call_user_func($this->supportedLocales) : $this->supportedLocales;


        if (empty($locales)) {
            $lang = config('boilerplate.locale.languages');

            // maps the $lang key => name
            $mapped = Arr::mapWithKeys($lang, function ($item, $key) {
                return [$key => $item['name']];
            });
            $locales = $mapped;
        }

        return $locales;
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        $supportedLocales = $this->getSupportedLocales();

        Field::macro('translatable', function (bool $translatable = true, ?array $customLocales = null, ?array $localeSpecificRules = null) use ($supportedLocales) {
            if (! $translatable) {
                return $this;
            }

            /**
             * @var Field $field
             * @var Field $this
             */
            $field = $this->getClone();

            $tabs = collect($customLocales ?? $supportedLocales)
                ->map(function ($label, $key) use ($field, $localeSpecificRules) {
                    $locale = is_string($key) ? $key : $label;

                    $clone = $field
                        ->getClone()
                        ->name("{$field->getName()}.{$locale}")
                        ->label($field->getLabel())
                        ->statePath("{$field->getStatePath(false)}.{$locale}");

                    if ($localeSpecificRules && isset($localeSpecificRules[$locale])) {
                        $clone->rules($localeSpecificRules[$locale]);
                    }

                    return Tabs\Tab::make($locale)
                        ->label(is_string($key) ? $label : strtoupper($locale))
                        ->schema([$clone]);
                })
                ->toArray();

            $tabsField = Tabs::make('translations')
                ->tabs($tabs);

            return $tabsField;
        });
    }
}
