<?php

namespace App\Filament\App\Resources\Contacts\Tables;

use App\ContactType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(fn ($state) => $state->getLabel())
                    ->colors([
                        'success' => ContactType::CUSTOMER,
                        'info' => ContactType::SUPPLIER,
                        'warning' => ContactType::PARTNER,
                        'primary' => ContactType::POTENTIAL_CUSTOMER,
                        'secondary' => ContactType::VENDOR,
                        'purple' => ContactType::CONSULTANT,
                        'indigo' => ContactType::INVESTOR,
                        'gray' => ContactType::OTHER,
                    ])
                    ->sortable(),
                    
                TextColumn::make('name')
                    ->label('Kontaktperson')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                    
                TextColumn::make('organization')
                    ->label('Organisasjon')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                    
                TextColumn::make('email')
                    ->label('E-post')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('E-post kopiert!')
                    ->icon('heroicon-m-envelope'),
                    
                TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-phone'),
                    
                TextColumn::make('assignedTo.name')
                    ->label('Ansvarlig')
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                    
                TextColumn::make('value')
                    ->label('Verdi')
                    ->money('NOK')
                    ->sortable()
                    ->alignEnd(),
                    
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'inactive',
                        'danger' => 'archived',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Aktiv',
                        'inactive' => 'Inaktiv',
                        'archived' => 'Arkivert',
                        default => $state,
                    }),
                    
                TextColumn::make('next_followup_date')
                    ->label('Neste oppfølging')
                    ->date('d.m.Y')
                    ->sortable()
                    ->color(fn ($state) => $state && $state->isPast() ? 'danger' : 'gray')
                    ->icon(fn ($state) => $state && $state->isPast() ? 'heroicon-m-exclamation-triangle' : null),
                    
                TextColumn::make('created_at')
                    ->label('Opprettet')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Kontakttype')
                    ->options(ContactType::options())
                    ->multiple(),
                    
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktiv',
                        'inactive' => 'Inaktiv',
                        'archived' => 'Arkivert',
                    ])
                    ->default('active'),
                    
                Filter::make('needs_followup')
                    ->label('Trenger oppfølging')
                    ->query(fn (Builder $query): Builder => $query->needsFollowup()),
                    
                Filter::make('has_value')
                    ->label('Har verdi')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('value')->where('value', '>', 0)),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
