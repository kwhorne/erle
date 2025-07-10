<?php

namespace App\Filament\App\Resources\Projects\Pages;

use App\Filament\App\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    public function getTitle(): string
    {
        return __('projects.pages.list');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
