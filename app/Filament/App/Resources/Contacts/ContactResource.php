<?php

namespace App\Filament\App\Resources\Contacts;

use App\Filament\App\Resources\Contacts\Pages\CreateContact;
use App\Filament\App\Resources\Contacts\Pages\EditContact;
use App\Filament\App\Resources\Contacts\Pages\ListContacts;
use App\Filament\App\Resources\Contacts\Schemas\ContactForm;
use App\Filament\App\Resources\Contacts\Tables\ContactsTable;
use App\Models\Contact;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    
    protected static string|UnitEnum|null $navigationGroup = 'CRM';
    protected static ?string $navigationLabel = 'Kontakter';
    protected static ?string $modelLabel = 'Kontakt';
    protected static ?string $pluralModelLabel = 'Kontakter';
    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return ContactForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactsTable::configure($table);
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
            'index' => ListContacts::route('/'),
            'create' => CreateContact::route('/create'),
            'edit' => EditContact::route('/{record}/edit'),
        ];
    }
}
