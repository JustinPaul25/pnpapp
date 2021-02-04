<?php

namespace App\Types;

final class RoleType
{
    const POLICEADMIN = 'Police Administrator';
    const BRGYADMIN = 'Barangay Administrator';
    const COMPLAINANT = 'Complainant';

    public static function toArray(): array
    {
        return [
            self::POLICEADMIN,
            self::BRGYADMIN,
            self::COMPLAINANT
        ];
    }
}