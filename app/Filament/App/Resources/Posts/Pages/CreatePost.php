<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Posts\Pages;

use App\Filament\App\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

final class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure author is set
        if (empty($data['author_id'])) {
            $data['author_id'] = auth()->id();
        }
        
        // Auto-set published_at if status is published
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        
        return $data;
    }
    
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Innlegg opprettet';
    }
}
