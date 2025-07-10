<?php

namespace App;

enum ProjectStatus: string
{
    case PLANNING = 'planning';
    case ACTIVE = 'active';
    case ON_HOLD = 'on_hold';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case MAINTENANCE = 'maintenance';

    public function getLabel(): string
    {
        return match ($this) {
            self::PLANNING => 'Planlegging',
            self::ACTIVE => 'Aktiv',
            self::ON_HOLD => 'På vent',
            self::COMPLETED => 'Fullført',
            self::CANCELLED => 'Avbrutt',
            self::MAINTENANCE => 'Vedlikehold',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PLANNING => 'info',
            self::ACTIVE => 'success',
            self::ON_HOLD => 'warning',
            self::COMPLETED => 'gray',
            self::CANCELLED => 'danger',
            self::MAINTENANCE => 'purple',
        };
    }
    
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($case) => [$case->value => $case->getLabel()]
        )->toArray();
    }
}
