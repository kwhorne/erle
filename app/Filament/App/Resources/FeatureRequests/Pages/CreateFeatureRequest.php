<?php

namespace App\Filament\App\Resources\FeatureRequests\Pages;

use App\Filament\App\Resources\FeatureRequests\FeatureRequestResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFeatureRequest extends CreateRecord
{
    protected static string $resource = FeatureRequestResource::class;

    public function getTitle(): string
    {
        return __('feature_requests.pages.create');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['requested_by'] = Auth::id();
        return $data;
    }
}
