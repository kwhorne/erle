<?php

namespace App\Filament\App\Resources\FeatureRequests\Pages;

use App\Filament\App\Resources\FeatureRequests\FeatureRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeatureRequests extends ListRecords
{
    protected static string $resource = FeatureRequestResource::class;

    public function getTitle(): string
    {
        return __('feature_requests.pages.list');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
