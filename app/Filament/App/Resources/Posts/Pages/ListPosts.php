<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Posts\Pages;

use App\Filament\App\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public function getTitle(): string
    {
        return __('posts.pages.list');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nytt innlegg')
                ->icon('heroicon-o-plus')
                ->modalHeading('Opprett nytt innlegg')
                ->modalWidth('7xl'),
        ];
    }
}
