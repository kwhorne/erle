<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Documents\Pages;

use App\Filament\App\Resources\Documents\DocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nytt dokument')
                ->icon('heroicon-o-plus')
                ->modalHeading('Last opp nytt dokument')
                ->modalWidth('5xl'),
        ];
    }
}
