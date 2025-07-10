<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Employees\Pages;

use App\Filament\App\Resources\Employees\EmployeeResource;
use Filament\Resources\Pages\ListRecords;

final class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    public function getTitle(): string
    {
        return __('employees.pages.list');
    }

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
