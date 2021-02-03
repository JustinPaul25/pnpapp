<?php

namespace App\Types;

final class RoleType
{
    const ADMINISTRATOR = 'Administrator';
    const POLICE = 'Police';
    const BRGYPOLICE = 'Barangay Police';
    const NORMALUSER = 'Normal User';

    public static function toArray(): array
    {
        return [
            self::ADMINISTRATOR,
            self::POLICE,
            self::BRGYPOLICE,
            self::NORMALUSER
        ];
    }
}