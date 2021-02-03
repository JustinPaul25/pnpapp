<?php

namespace App\Types;

final class RoleType
{
    const ADMINISTRATOR = 'Administrator';
    const POLICE = 'Police';

    public static function toArray(): array
    {
        return [
            self::ADMINISTRATOR,
            self::POLICE
        ];
    }
}