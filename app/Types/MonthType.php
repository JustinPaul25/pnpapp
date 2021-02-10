<?php

namespace App\Types;

final class MonthType
{
    public static function toArray()
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];
    }
}