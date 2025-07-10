<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Employees\Pages;

use App\Filament\App\Resources\Employees\EmployeeResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    public function getTitle(): string
    {
        return __('employees.pages.view');
    }
    
    protected string $view = 'filament.app.resources.employees.pages.view-employee';

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('send_message')
                ->label('Send melding')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->url(fn () => \App\Filament\App\Resources\Messages\Pages\CreateMessage::getUrl([
                    'recipient_id' => $this->record->id,
                ]))
                ->color('primary'),
        ];
    }
}
