<?php

namespace App\Enums\Traits;

use ReflectionEnum;

trait BaseEnums
{
    public static function tryFromName(string $name): ?static
    {
        $reflection = new ReflectionEnum(static::class);

        return $reflection->hasCase($name)
            ? $reflection->getCase($name)->getValue()
            : null;
    }

    public static function toOptions(): array
    {
        return collect(self::cases())->mapWithKeys(function ($item) {
            return [$item->name => $item->value];
        })->toArray();
    }

    public static function toNames()
    {
        return collect(self::cases())->pluck('name')->toArray();
    }

    public static function description($name): string
    {
        if (empty($name)) {
            return '-';
        }
        $instance = new ReflectionEnum(static::class);

        return trim(preg_replace('/[^A-Za-z0-9 ]/', '', $instance->getCase($name)->getDocComment()));
    }
}
