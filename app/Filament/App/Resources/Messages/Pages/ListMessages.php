<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Messages\Pages;

use App\Filament\App\Resources\Messages\MessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ny melding')
                ->icon('heroicon-o-plus'),
        ];
    }
}
