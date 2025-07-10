<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\FeatureRequests;

use App\Filament\App\Resources\FeatureRequests\Pages\CreateFeatureRequest;
use App\Filament\App\Resources\FeatureRequests\Pages\EditFeatureRequest;
use App\Filament\App\Resources\FeatureRequests\Pages\ListFeatureRequests;
use App\Filament\App\Resources\FeatureRequests\Schemas\FeatureRequestForm;
use App\Filament\App\Resources\FeatureRequests\Tables\FeatureRequestsTable;
use App\Models\FeatureRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class FeatureRequestResource extends Resource
{
    protected static ?string $model = FeatureRequest::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-light-bulb';
    
    protected static ?string $navigationLabel = null;
    protected static ?string $modelLabel = null;
    protected static ?string $pluralModelLabel = null;
    protected static string|UnitEnum|null $navigationGroup = null;
    
    protected static ?int $navigationSort = 3;
    
    public static function getNavigationGroup(): ?string
    {
        return __('feature_requests.resource.navigation_group');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('feature_requests.resource.navigation_label');
    }
    
    public static function getModelLabel(): string
    {
        return __('feature_requests.resource.model_label');
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('feature_requests.resource.plural_model_label');
    }

    public static function form(Schema $schema): Schema
    {
        return FeatureRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeatureRequestsTable::configure($table);
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
            'index' => ListFeatureRequests::route('/'),
            'create' => CreateFeatureRequest::route('/create'),
            'edit' => EditFeatureRequest::route('/{record}/edit'),
        ];
    }
}
