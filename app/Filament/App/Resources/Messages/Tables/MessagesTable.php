<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Messages\Tables;

use App\Models\Message;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class MessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(
                Message::query()
                    ->where(function ($query) {
                        $query->where('recipient_id', auth()->id())
                              ->orWhere('sender_id', auth()->id());
                    })
                    ->with(['sender', 'recipient'])
            )
            ->columns([
                IconColumn::make('read_status')
                    ->label('')
                    ->icon(fn (Message $record): string => 
                        $record->recipient_id === auth()->id() && $record->isUnread() 
                            ? 'heroicon-s-envelope' 
                            : 'heroicon-o-envelope-open'
                    )
                    ->color(fn (Message $record): string => 
                        $record->recipient_id === auth()->id() && $record->isUnread() 
                            ? 'primary' 
                            : 'gray'
                    )
                    ->tooltip(fn (Message $record): string => 
                        $record->recipient_id === auth()->id() && $record->isUnread() 
                            ? 'Ulest melding' 
                            : 'Lest melding'
                    ),
                    
                BadgeColumn::make('direction')
                    ->label('Type')
                    ->getStateUsing(fn (Message $record): string => 
                        $record->sender_id === auth()->id() ? 'Sendt' : 'Mottatt'
                    )
                    ->colors([
                        'success' => 'Sendt',
                        'info' => 'Mottatt',
                    ])
                    ->icons([
                        'heroicon-o-arrow-up-right' => 'Sendt',
                        'heroicon-o-arrow-down-left' => 'Mottatt',
                    ]),
                    
                TextColumn::make('other_person')
                    ->label('Fra/Til')
                    ->getStateUsing(fn (Message $record): string => 
                        $record->sender_id === auth()->id() 
                            ? $record->recipient->name 
                            : $record->sender->name
                    )
                    ->searchable(['sender.name', 'recipient.name'])
                    ->sortable(),
                    
                TextColumn::make('subject')
                    ->label('Emne')
                    ->searchable()
                    ->limit(50)
                    ->weight(fn (Message $record): string => 
                        $record->recipient_id === auth()->id() && $record->isUnread() 
                            ? 'bold' 
                            : 'normal'
                    ),
                    
                BadgeColumn::make('priority')
                    ->label('Prioritet')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Lav',
                        'normal' => 'Normal',
                        'high' => 'Høy',
                        'urgent' => 'Haster!',
                        default => $state,
                    })
                    ->colors([
                        'secondary' => 'low',
                        'primary' => 'normal',
                        'warning' => 'high',
                        'danger' => 'urgent',
                    ])
                    ->icons([
                        'heroicon-o-minus' => 'low',
                        'heroicon-o-exclamation-triangle' => 'high',
                        'heroicon-s-exclamation-triangle' => 'urgent',
                    ])
                    ->toggleable(),
                    
                TextColumn::make('created_at')
                    ->label('Sendt')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->since()
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('unread')
                    ->label('Kun uleste')
                    ->query(fn (Builder $query): Builder => 
                        $query->where('recipient_id', auth()->id())
                              ->whereNull('read_at')
                    ),
                    
                Filter::make('sent')
                    ->label('Kun sendte')
                    ->query(fn (Builder $query): Builder => 
                        $query->where('sender_id', auth()->id())
                    ),
                    
                Filter::make('received')
                    ->label('Kun mottatte')
                    ->query(fn (Builder $query): Builder => 
                        $query->where('recipient_id', auth()->id())
                    ),
                    
                SelectFilter::make('priority')
                    ->label('Prioritet')
                    ->options([
                        'low' => 'Lav',
                        'normal' => 'Normal',
                        'high' => 'Høy',
                        'urgent' => 'Haster!',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Les')
                    ->icon('heroicon-o-eye'),
                    
                Action::make('reply')
                    ->label('Svar')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('info')
                    ->url(fn (Message $record) => route('filament.app.resources.messages.create', [
                        'recipient' => $record->sender_id === auth()->id() ? $record->recipient_id : $record->sender_id,
                        'subject' => 'Re: ' . $record->subject,
                    ]))
                    ->visible(fn (Message $record) => $record->recipient_id === auth()->id()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchOnBlur()
            ->striped()
            ->paginated([10, 25, 50])
            ->emptyStateHeading('Ingen meldinger')
            ->emptyStateDescription('Du har ingen meldinger ennå.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
    }
}
