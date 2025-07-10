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
    
    protected static string|UnitEnum|null $navigationGroup = null;
    protected static ?string $navigationLabel = null;
    protected static ?string $modelLabel = null;
    protected static ?string $pluralModelLabel = null;
    protected static ?int $navigationSort = 1;
    
    public static function getNavigationGroup(): ?string
    {
        return __('contacts.resource.navigation_group');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('contacts.resource.navigation_label');
    }
    
    public static function getModelLabel(): string
    {
        return __('contacts.resource.model_label');
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('contacts.resource.plural_model_label');
    }

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
