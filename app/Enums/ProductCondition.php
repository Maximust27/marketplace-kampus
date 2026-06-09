<?php

namespace App\Enums;

enum ProductCondition: string
{
    case New = 'new';
    case UsedGood = 'used_good';
    case UsedNormal = 'used_normal';

    public function label(): string
    {
        return match($this) {
            self::New => 'Baru',
            self::UsedGood => 'Bekas (Masih Bagus)',
            self::UsedNormal => 'Bekas (Wajar Pakai)',
        };
    }
}
