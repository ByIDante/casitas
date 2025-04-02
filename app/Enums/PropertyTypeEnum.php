<?php

declare(strict_types=1);

namespace App\Enums;

enum PropertyTypeEnum: string
{
    case HOUSE = 'HOUSE';
    case APARTMENT = 'APARTMENT';
    case STUDIO = 'STUDIO';
    case LOFT = 'LOFT';
    case DUPLEX = 'DUPLEX';
    case PENTHOUSE = 'PENTHOUSE';

    public static function label(string $type): string
    {
        return match ($type) {
            PropertyTypeEnum::HOUSE->value => __('House'),
            PropertyTypeEnum::APARTMENT->value => __('Apartment'),
            PropertyTypeEnum::STUDIO->value => __('Studio'),
            PropertyTypeEnum::LOFT->value => __('Loft'),
            PropertyTypeEnum::DUPLEX->value => __('Duplex'),
            PropertyTypeEnum::PENTHOUSE->value => __('Penthouse'),
        };
    }

    public static function getOptions(): array
    {
        return [
            (PropertyTypeEnum::HOUSE)->value => self::label((PropertyTypeEnum::HOUSE)->value),
            (PropertyTypeEnum::APARTMENT)->value => self::label((PropertyTypeEnum::APARTMENT)->value),
            (PropertyTypeEnum::STUDIO)->value => self::label((PropertyTypeEnum::STUDIO)->value),
            (PropertyTypeEnum::LOFT)->value => self::label((PropertyTypeEnum::LOFT)->value),
            (PropertyTypeEnum::DUPLEX)->value => self::label((PropertyTypeEnum::DUPLEX)->value),
            (PropertyTypeEnum::PENTHOUSE)->value => self::label((PropertyTypeEnum::PENTHOUSE)->value)
        ];
    }

    public static function getValues(): array
    {
        return [
            self::HOUSE->value,
            self::APARTMENT->value,
            self::STUDIO->value,
            self::LOFT->value,
            self::DUPLEX->value,
            self::PENTHOUSE->value
        ];
    }
}
