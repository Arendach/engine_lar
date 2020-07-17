<?php

namespace App\Services;

use App\Models\Setting;
use Cache;
use Artisan;

class SettingService
{
    private $storage;

    public function __construct()
    {
        $this->storage = Cache::rememberForever('settings', function () {
            return Setting::all();
        });
    }

    public function get(string $key, $default = null)
    {
        if (!$this->storage) {
            return null;
        }

        $setting = $this->storage->where('key', $key)->first();

        if (!$setting) {
            $this->registerSetting($key, $default);

            return $default;
        }

        return $setting->value;
    }

    public function getEditable(string $key, $default = null)
    {
        if (!$this->storage) {
            return null;
        }

        $setting = $this->storage->where('key', $key)->first();

        if (!$setting) {
            $this->registerSetting($key, $default);

            return $default;
        }

        return $setting->editable('value');
    }

    private function registerSetting(string $key, $value): void
    {
        Setting::create([
            'key'   => $key,
            'value' => $value
        ]);

        Artisan::call('cache:clear');
    }
}