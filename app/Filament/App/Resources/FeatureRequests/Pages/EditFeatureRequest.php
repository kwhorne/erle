<?php

namespace App\Filament\App\Resources\FeatureRequests\Pages;

use App\Filament\App\Resources\FeatureRequests\FeatureRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFeatureRequest extends EditRecord
{
    protected static string $resource = FeatureRequestResource::class;

    public function getTitle(): string
    {
        return __('feature_requests.pages.edit');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
