<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\PostCategories;

use App\Filament\App\Resources\PostCategories\Pages\CreatePostCategory;
use App\Filament\App\Resources\PostCategories\Pages\ListPostCategories;
use App\Filament\App\Resources\PostCategories\Schemas\PostCategoryForm;
use App\Filament\App\Resources\PostCategories\Tables\PostCategoriesTable;
use App\Models\PostCategory;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

final class PostCategoryResource extends Resource
{
    protected static ?string $model = PostCategory::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';
    
    protected static ?string $navigationLabel = null;
    protected static ?string $modelLabel = null;
    protected static ?string $pluralModelLabel = null;
    protected static string|UnitEnum|null $navigationGroup = null;
    
    public static function getNavigationGroup(): ?string
    {
        return __('post_categories.resource.navigation_group');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('post_categories.resource.navigation_label');
    }
    
    public static function getModelLabel(): string
    {
        return __('post_categories.resource.model_label');
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('post_categories.resource.plural_model_label');
    }
    
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return PostCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostCategoriesTable::configure($table);
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
            'index' => ListPostCategories::route('/'),
            'create' => CreatePostCategory::route('/create'),
        ];
    }
}
