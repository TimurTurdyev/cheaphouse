<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final class SettingEloquentStorage
{
    protected string $group = 'global';
    protected string $cacheKey = 'app_settings';

    public function all(bool $fresh = false): Collection
    {
        if ($fresh) {
            return $this->modelQuery()->get(['val', 'name', 'type'])->map(function ($item) {
                $item->val = $this->castValue($item->val, $item->type);
                return $item;
            })->mapWithKeys(fn($item) => [$item->name => $item->val]);
        }

        return Cache::rememberForever($this->getCacheKey(), function () {
            return $this->modelQuery()->get(['val', 'name', 'type'])->map(function ($item) {
                $item->val = $this->castValue($item->val, $item->type);
                return $item;
            })->mapWithKeys(fn($item) => [$item->name => $item->val]);
        });
    }

    public function get(string $key, bool|int|float|array|string|null|object $default = null, bool $fresh = false)
    {
        return $this->all($fresh)->get($key, $default);
    }

    public function set(array|string $key, bool|int|float|array|string|null|object $val = null)
    {
        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $this->set($name, $value);
            }

            return true;
        }

        $setting = $this
            ->modelQuery()
            ->firstOrNew([
                'name' => $key,
            ]);

        $type = gettype($val);

        $setting->group = $this->group;
        $setting->val = $this->valueToString($val, $type);
        $setting->type = $type;

        $setting->save();

        $this->flushCache();

        return $val;
    }

    public function has(string $key)
    {
        return $this->all()->has($key);
    }

    public function remove(string $key = null)
    {
        $deleted = $this->modelQuery()->when(!is_null($key), static fn($query) => $query->where('name', $key))->delete();

        $this->flushCache();

        return $deleted;
    }

    public function flushCache(): bool
    {
        return Cache::forget($this->getCacheKey());
    }

    public function group(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    private function getCacheKey(): string
    {
        return $this->cacheKey . '.' . $this->group;
    }

    private function modelQuery(): Builder
    {
        return Setting::query()->group($this->group);
    }

    private function valueToString(bool|int|float|array|string|null|object $val, string $type): false|string
    {
        return match ($type) {
            'array' => json_encode($val, true),
            'object' => json_encode($val),
            default => (string)$val,
        };
    }

    private static function castValue(bool|int|float|array|string|null|object $val, string $castTo): bool|int|float|array|string|null|object
    {
        return match ($castTo) {
            'integer' => intval($val),
            'boolean' => boolval($val),
            'array' => json_decode($val, true),
            'double' => floatval($val),
            'object' => json_decode($val),
            default => (string)$val,
        };
    }
}
