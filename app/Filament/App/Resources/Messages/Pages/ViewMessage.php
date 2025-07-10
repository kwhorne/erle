<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Messages\Pages;

use App\Filament\App\Resources\Messages\MessageResource;
use App\Models\Message;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;
    
    protected string $view = 'filament.app.resources.messages.pages.view-message';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reply')
                ->label('Svar')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('info')
                ->url(function (Message $record) {
                    $userId = auth()->id();
                    return route('filament.app.resources.messages.create', [
                        'recipient' => $record->sender_id === $userId ? $record->recipient_id : $record->sender_id,
                        'subject' => 'Re: ' . $record->subject,
                    ]);
                })
                ->visible(function (Message $record) {
                    $userId = auth()->id();
                    return $record->recipient_id === $userId;
                }),
                
            DeleteAction::make()
                ->label('Slett')
                ->icon('heroicon-o-trash'),
        ];
    }
    
    public function mount(int|string $record): void
    {
        parent::mount($record);
        
        // Mark message as read when viewed by recipient
        $userId = auth()->id();
        if ($userId && $this->record->recipient_id === $userId && $this->record->isUnread()) {
            $this->record->markAsRead();
        }
    }
}
