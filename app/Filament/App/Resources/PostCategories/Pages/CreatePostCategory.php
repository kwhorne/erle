<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\PostCategories\Pages;

use App\Filament\App\Resources\PostCategories\PostCategoryResource;
use Filament\Resources\Pages\CreateRecord;

final class CreatePostCategory extends CreateRecord
{
    protected static string $resource = PostCategoryResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Kategori opprettet';
    }
}
