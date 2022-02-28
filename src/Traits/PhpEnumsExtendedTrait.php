<?php

namespace Josezenem\PhpEnumsExtended\Traits;

use Josezenem\PhpEnumsExtended\Exceptions\EnumsExtendedException;

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

    public static function options(): array
    {
        foreach (self::cases() as $case) {
            $value = $case->value ?? $case->name;
            $data[$value] = $case->name;
        }

        return $data;
    }

    public static function names()
    {
        foreach (self::cases() as $case) {
            $data[$case->name] = $case->name;
        }

        return $data;
    }

    public static function values()
    {
        foreach (self::cases() as $case) {
            $value = $case->value ?? $case->name;
            $data[$value] = $value;
        }

        return $data;
    }

    public static function optionsFlipped(): array
    {
        return array_flip(self::options());
    }

    protected static function normalizedMethods($prefix = null)
    {
        array_map(static function ($case) use (&$data, $prefix) {
            $value = $case->value ?? $case->name;
            $normalized_name = self::methodNameNormalizer($case->name, $prefix);
            $data[$normalized_name] = $value;
            if ($prefix === null && str_contains($case->name, '_')) {
                $data[strtolower($case->name)] = $value;
            }
        }, self::cases());

        return $data;
    }

    protected static function methodNameNormalizer($name, $prefix): string
    {
        return $prefix . str_replace('_', '', strtolower($name));
    }

    /**
     * @throws EnumsExtendedException
     */
    public function __call($name, $arguments)
    {
        $self_value = $this->value ?? $this->name;

        if (! isset(self::normalizedMethods('is')[strtolower($name)])) {
            throw new EnumsExtendedException('Enum method ' . $name . ' not found: ');
        }

        return ($self_value === self::normalizedMethods('is')[strtolower($name)]);
    }

    /**
     * @throws EnumsExtendedException
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (! isset(self::normalizedMethods()[strtolower($name)])) {
            throw new EnumsExtendedException('Enum static method ' . $name . ' not found: ');
        }

        return self::normalizedMethods()[strtolower($name)];
    }
}
