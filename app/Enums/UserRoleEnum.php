<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRoleEnum: string
{
    case USER = 'USER';
    case ADMIN = 'ADMIN';
    case GUEST = 'GUEST';

    public static function label(string $type): string
    {
        return match ($type) {
            UserRoleEnum::USER->value => __('User'),
            UserRoleEnum::ADMIN->value => __('Admin'),
            UserRoleEnum::GUEST->value => __('Guest'),
        };
    }

    public static function getOptions(): array
    {
        return [
            (UserRoleEnum::USER)->value => self::label((UserRoleEnum::USER)->value),
            (UserRoleEnum::ADMIN)->value => self::label((UserRoleEnum::ADMIN)->value),
            (UserRoleEnum::GUEST)->value => self::label((UserRoleEnum::GUEST)->value),
        ];
    }

    public static function getValues(): array
    {
        return [
            self::USER->value,
            self::ADMIN->value,
            self::GUEST->value,
        ];
    }
}
