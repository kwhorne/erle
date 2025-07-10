<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\PostCategories\Pages;

use App\Filament\App\Resources\PostCategories\PostCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPostCategories extends ListRecords
{
    protected static string $resource = PostCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ny kategori')
                ->icon('heroicon-o-plus')
                ->modalHeading('Opprett ny kategori')
                ->modalWidth('2xl'),
        ];
    }
}
