<?php

namespace App;

enum ProjectPriority: string
{
    case LOW = 'low';
    case NORMAL = 'normal';
    case HIGH = 'high';
    case URGENT = 'urgent';
    case CRITICAL = 'critical';

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Lav',
            self::NORMAL => 'Normal',
            self::HIGH => 'Høy',
            self::URGENT => 'Haster',
            self::CRITICAL => 'Kritisk',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::LOW => 'gray',
            self::NORMAL => 'info',
            self::HIGH => 'warning',
            self::URGENT => 'orange',
            self::CRITICAL => 'danger',
        };
    }
    
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($case) => [$case->value => $case->getLabel()]
        )->toArray();
    }
}
