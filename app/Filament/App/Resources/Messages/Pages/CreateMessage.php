<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Messages\Pages;

use App\Filament\App\Resources\Messages\MessageResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

final class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;

    public function getTitle(): string
    {
        return __('messages.pages.create');
    }

    protected static ?string $maxWidth = 'full';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Melding sendt')
            ->body('Din melding har blitt sendt.');
    }
}
