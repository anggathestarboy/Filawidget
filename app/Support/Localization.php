<?php

namespace App\Support;

class Localization
{
    /**
     * @return array<string, string>
     */
    public static function locales(): array
    {
        return config('languages.locales', []);
    }

    public static function defaultLocale(): string
    {
        return config('languages.default', 'id');
    }

    public static function localeLabel(string $locale): string
    {
        return config('languages.locales.'.$locale, $locale);
    }

    /**
     * @return array<string>
     */
    public static function otherLocales(?string $locale = null): array
    {
        $locale ??= static::defaultLocale();

        return array_keys(array_filter(
            static::locales(),
            fn ($label, $key) => $key !== $locale,
            ARRAY_FILTER_USE_BOTH
        ));
    }

    /**
     * Pick the localized value for the given locale out of a stored value.
     * Handles both the new multilingual JSON shape (["id" => ..., "en" => ...])
     * and legacy plain string values.
     */
    public static function localizedValue(mixed $value, string $locale): mixed
    {
        if (is_array($value)) {
            if (array_key_exists($locale, $value)) {
                return $value[$locale];
            }

            if (array_key_exists(static::defaultLocale(), $value)) {
                return $value[static::defaultLocale()];
            }

            if (count($value)) {
                return $value[array_key_first($value)];
            }

            return '';
        }

        return $value;
    }
}
