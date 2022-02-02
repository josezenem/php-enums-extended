<?php

namespace Josezenem\PhpEnumsExtended\Traits;

trait PhpEnumsExtendedTrait
{
    public static function equals(...$params): bool
    {
        $cases = self::cases();
        foreach ($params as $param) {
            foreach ($cases as $case) {
                $case_value = $case->value ?? $case->name;
                $param_value = $param->value ?? $param->name;
                if ($case_value === $param_value) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function doesNotEqual(...$params): bool
    {
        return ! self::equals($params);
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
        return array_flip(self::toOptionsArray());
    }
}
