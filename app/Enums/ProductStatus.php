<?php

namespace App\Enums;

enum ProductStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Sold = 'sold';

    public function label(): string
    {
        return match($this) {
            self::Active => 'Aktif',
            self::Inactive => 'Nonaktif',
            self::Sold => 'Terjual',
        };
    }
}
