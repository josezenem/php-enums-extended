<?php

namespace Josezenem\PhpEnumsExtended\Traits;

trait PhpEnumsExtendedTrait
{
    public static function equals(...$params): bool
    {
        $cases = self::cases();
        foreach ($params as $param) {
            foreach ($cases as $case) {
                if ($case->value === $param) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function toOptionsArray(): array
    {
        array_map(static function ($case) use (&$data) {
            $value = $case->value ?? $case->name;
            $data[$value] = $case->name;
        }, self::cases());

        return $data;
    }

    public static function toOptionsInversedArray(): array
    {
        array_map(static function ($case) use (&$data) {
            $value = $case->value ?? $case->name;
            $data[$case->name] = $value;
        }, self::cases());

        return $data;
    }
}
