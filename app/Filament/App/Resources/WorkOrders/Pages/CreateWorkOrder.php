<?php

namespace App\Filament\App\Resources\WorkOrders\Pages;

use App\Filament\App\Resources\WorkOrders\WorkOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkOrder extends CreateRecord
{
    protected static string $resource = WorkOrderResource::class;
}
