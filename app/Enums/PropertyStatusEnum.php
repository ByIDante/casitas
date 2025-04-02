<?php

declare(strict_types=1);

namespace App\Enums;

enum PropertyStatusEnum: string
{
    case AVAILABLE = 'AVAILABLE';
    case SOLD = 'SOLD';
    case RENTED = 'RENTED';
    case RESERVED = 'RESERVED';

    public static function label(string $type): string
    {
        return match ($type) {
            PropertyStatusEnum::AVAILABLE->value => __('Available'),
            PropertyStatusEnum::SOLD->value => __('Sold'),
            PropertyStatusEnum::RENTED->value => __('Rented'),
            PropertyStatusEnum::RESERVED->value => __('Reserved'),
        };
    }

    public static function getOptions(): array
    {
        return [
            (PropertyStatusEnum::AVAILABLE)->value => self::label((PropertyStatusEnum::AVAILABLE)->value),
            (PropertyStatusEnum::SOLD)->value => self::label((PropertyStatusEnum::SOLD)->value),
            (PropertyStatusEnum::RENTED)->value => self::label((PropertyStatusEnum::RENTED)->value),
            (PropertyStatusEnum::RESERVED)->value => self::label((PropertyStatusEnum::RESERVED)->value),
        ];
    }

    public static function getValues(): array
    {
        return [
            self::AVAILABLE->value,
            self::SOLD->value,
            self::RENTED->value,
            self::RESERVED->value,
        ];
    }
}
