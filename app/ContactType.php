<?php

namespace App;

enum ContactType: string
{
    case CUSTOMER = 'customer';
    case SUPPLIER = 'supplier';
    case PARTNER = 'partner';
    case POTENTIAL_CUSTOMER = 'potential_customer';
    case VENDOR = 'vendor';
    case CONSULTANT = 'consultant';
    case INVESTOR = 'investor';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match($this) {
            self::CUSTOMER => 'Kunde',
            self::SUPPLIER => 'Leverandør',
            self::PARTNER => 'Partner',
            self::POTENTIAL_CUSTOMER => 'Potensiell Kunde',
            self::VENDOR => 'Leverandør/Forhandler',
            self::CONSULTANT => 'Konsulent',
            self::INVESTOR => 'Investor',
            self::OTHER => 'Annet',
        };
    }

    public function getColor(): string
    {
        return match($this) {
            self::CUSTOMER => 'success',
            self::SUPPLIER => 'info',
            self::PARTNER => 'warning',
            self::POTENTIAL_CUSTOMER => 'primary',
            self::VENDOR => 'secondary',
            self::CONSULTANT => 'purple',
            self::INVESTOR => 'indigo',
            self::OTHER => 'gray',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [
            $case->value => $case->getLabel()
        ])->toArray();
    }
}
