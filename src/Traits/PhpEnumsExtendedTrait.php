<?php

namespace Josezenem\PhpEnumsExtended\Traits;

trait PhpEnumsExtendedTrait
{
    public function equals(...$params): bool
    {
        foreach ($params as $param) {
            $self_value = $this->value ?? $this->name;
            $param_value = $param->value ?? $param->name;
            if ($self_value === $param_value) {
                return true;
            }
        }

        return false;
    }

    public function doesNotEqual(...$params): bool
    {
        return ! $this->equals(...$params);
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
