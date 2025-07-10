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
    
    protected static ?string $navigationLabel = 'Kategorier';
    
    protected static ?string $modelLabel = 'Kategori';
    
    protected static ?string $pluralModelLabel = 'Kategorier';

    protected static string|UnitEnum|null $navigationGroup = 'Feed';
    
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
