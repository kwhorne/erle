<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Documents;

use App\Filament\App\Resources\Documents\Pages\CreateDocument;
use App\Filament\App\Resources\Documents\Pages\ListDocuments;
use App\Filament\App\Resources\Documents\Pages\ViewDocument;
use App\Filament\App\Resources\Documents\Schemas\DocumentForm;
use App\Filament\App\Resources\Documents\Tables\DocumentsTable;
use App\Models\Document;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

final class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Dokumenter';
    
    protected static ?string $modelLabel = 'Dokument';
    
    protected static ?string $pluralModelLabel = 'Dokumenter';

    protected static string|UnitEnum|null $navigationGroup = 'Dokumenter';
    
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return DocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentsTable::configure($table);
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
            'index' => ListDocuments::route('/'),
            'create' => CreateDocument::route('/create'),
            'view' => ViewDocument::route('/{record}'),
        ];
    }
}
