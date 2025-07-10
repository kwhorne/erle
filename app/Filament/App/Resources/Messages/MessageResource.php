<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Messages;

use App\Filament\App\Resources\Messages\Pages\CreateMessage;
use App\Filament\App\Resources\Messages\Pages\ListMessages;
use App\Filament\App\Resources\Messages\Pages\ViewMessage;
use App\Filament\App\Resources\Messages\Schemas\MessageForm;
use App\Filament\App\Resources\Messages\Tables\MessagesTable;
use App\Models\Message;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    
    protected static ?string $navigationLabel = 'Meldinger';
    
    protected static ?string $modelLabel = 'Melding';
    
    protected static ?string $pluralModelLabel = 'Meldinger';

    protected static string|UnitEnum|null $navigationGroup = 'Team';
    
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MessageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MessagesTable::configure($table);
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
            'index' => ListMessages::route('/'),
            'create' => CreateMessage::route('/create'),
            'view' => ViewMessage::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $userId = auth()->user()?->id;
        if (!$userId) {
            return null;
        }
        
        $unreadCount = Message::where('recipient_id', $userId)
            ->whereNull('read_at')
            ->count();
            
        return $unreadCount > 0 ? (string) $unreadCount : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}
