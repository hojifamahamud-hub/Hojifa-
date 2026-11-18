<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('t')) {
    function t(?string $bn, ?string $en): ?string
    {
        if (app()->getLocale() === 'en') {
            return $en ?: $bn;
        }
        return $bn ?: $en;
    }
}

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return Cache::rememberForever("settings.{$key}", function () use ($key, $default) {
            $row = Setting::query()->where('key', $key)->first();
            return $row?->value ?? $default;
        });
    }
}

if (!function_exists('setting_group')) {
    function setting_group(): array
    {
        return Cache::rememberForever('settings.all', fn () => Setting::query()->pluck('value', 'key')->all());
    }
}

if (!function_exists('clear_settings_cache')) {
    function clear_settings_cache(): void
    {
        Cache::forget('settings.all');
        Setting::query()->get(['value', 'key'])->each(fn ($row) => Cache::put("settings.{$row->key}", $row->value));
    }
}

if (!function_exists('site_name')) {
    function site_name(): string
    {
        return (string) (setting('site_name_bn') ?: config('app.name'));
    }
}
