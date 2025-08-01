<?php

namespace App\Filament\App\Resources\WorkOrders;

use App\Filament\App\Resources\WorkOrders\Pages\CreateWorkOrder;
use App\Filament\App\Resources\WorkOrders\Pages\EditWorkOrder;
use App\Filament\App\Resources\WorkOrders\Pages\ListWorkOrders;
use App\Filament\App\Resources\WorkOrders\Schemas\WorkOrderForm;
use App\Filament\App\Resources\WorkOrders\Tables\WorkOrdersTable;
use App\Models\WorkOrder;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WorkOrderResource extends Resource
{
    protected static ?string $model = WorkOrder::class;

    protected static string|UnitEnum|null $navigationGroup = null;
    protected static ?string $navigationLabel = null;
    protected static ?string $modelLabel = null;
    protected static ?string $pluralModelLabel = null;
    
    public static function getNavigationGroup(): ?string
    {
        return __('work_orders.resource.navigation_group');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('work_orders.resource.navigation_label');
    }
    
    public static function getModelLabel(): string
    {
        return __('work_orders.resource.model_label');
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('work_orders.resource.plural_model_label');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrench;
    
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return WorkOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkOrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorkOrders::route('/'),
            'create' => CreateWorkOrder::route('/create'),
            'edit' => EditWorkOrder::route('/{record}/edit'),
        ];
    }
}
