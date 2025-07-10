<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Posts;

use App\Filament\App\Resources\Posts\Pages\CreatePost;
use App\Filament\App\Resources\Posts\Pages\ListPosts;
use App\Filament\App\Resources\Posts\Pages\ViewPost;
use App\Filament\App\Resources\Posts\Schemas\PostForm;
use App\Filament\App\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

final class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';
    
    protected static ?string $navigationLabel = 'Innlegg';
    
    protected static ?string $modelLabel = 'Innlegg';
    
    protected static ?string $pluralModelLabel = 'Innlegg';

    protected static string|UnitEnum|null $navigationGroup = 'Feed';
    
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'view' => ViewPost::route('/{record}'),
        ];
    }
}
