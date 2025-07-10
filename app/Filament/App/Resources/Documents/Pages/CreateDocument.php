<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Documents\Pages;

use App\Filament\App\Resources\Documents\DocumentResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;
    
    protected static ?string $title = 'Last opp dokument';
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uploaded_by'] = auth()->id();
        
        return $data;
    }
    
    protected function afterCreate(): void
    {
        // Update document metadata after media is attached
        $record = $this->getRecord();
        $media = $record->getFirstMedia('document');
        
        if ($media) {
            $record->update([
                'file_type' => $media->getExtensionAttribute(),
                'file_size' => $media->size,
                'mime_type' => $media->mime_type,
            ]);
        }
    }
}
