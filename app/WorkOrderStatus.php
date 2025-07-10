<?php

namespace App;

enum WorkOrderStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';  
    case WAITING_CUSTOMER = 'waiting_customer';
    case WAITING_PARTS = 'waiting_parts';
    case TESTING = 'testing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case ON_HOLD = 'on_hold';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Venter',
            self::IN_PROGRESS => 'Pågår',
            self::WAITING_CUSTOMER => 'Venter kunde',
            self::WAITING_PARTS => 'Venter deler',
            self::TESTING => 'Testing',
            self::COMPLETED => 'Fullført',
            self::CANCELLED => 'Avbrutt',
            self::ON_HOLD => 'På vent',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::IN_PROGRESS => 'info',
            self::WAITING_CUSTOMER => 'purple',
            self::WAITING_PARTS => 'orange',
            self::TESTING => 'indigo',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
            self::ON_HOLD => 'gray',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($case) => [$case->value => $case->getLabel()]
        )->toArray();
    }
}
