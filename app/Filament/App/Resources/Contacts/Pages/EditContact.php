<?php

namespace App\Filament\App\Resources\Contacts\Pages;

use App\Filament\App\Resources\Contacts\ContactResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

    public function getTitle(): string
    {
        return __('contacts.pages.edit');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
