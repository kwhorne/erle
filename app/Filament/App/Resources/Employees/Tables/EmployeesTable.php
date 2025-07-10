<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Employees\Tables;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png'))
                    ->size(50),
                    
                TextColumn::make('name')
                    ->label('Navn')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->size('lg'),
                    
                TextColumn::make('job_title')
                    ->label('Stilling')
                    ->searchable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-briefcase'),
                    
                TextColumn::make('department')
                    ->label('Avdeling')
                    ->searchable()
                    ->badge()
                    ->color('success'),
                    
                TextColumn::make('email')
                    ->label('E-post')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('E-post kopiert!')
                    ->icon('heroicon-m-envelope')
                    ->iconColor('gray'),
                    
                TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Telefonnummer kopiert!')
                    ->icon('heroicon-m-phone')
                    ->iconColor('gray')
                    ->toggleable(),
                    
                TextColumn::make('location')
                    ->label('Lokasjon')
                    ->searchable()
                    ->icon('heroicon-o-map-pin')
                    ->iconColor('gray')
                    ->toggleable(),
                    
                TextColumn::make('last_login_at')
                    ->label('Sist pålogget')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('department')
                    ->label('Avdeling')
                    ->options(function () {
                        return \App\Models\User::where('is_employee', true)
                            ->whereNotNull('department')
                            ->distinct()
                            ->pluck('department', 'department')
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),
                    
                SelectFilter::make('job_title')
                    ->label('Stilling')
                    ->options(function () {
                        return \App\Models\User::where('is_employee', true)
                            ->whereNotNull('job_title')
                            ->distinct()
                            ->pluck('job_title', 'job_title')
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),
                    
                SelectFilter::make('location')
                    ->label('Lokasjon')
                    ->options(function () {
                        return \App\Models\User::where('is_employee', true)
                            ->whereNotNull('location')
                            ->distinct()
                            ->pluck('location', 'location')
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),
                    
                Filter::make('recent_login')
                    ->label('Aktive brukere (siste 30 dager)')
                    ->query(fn (Builder $query): Builder => $query->where('last_login_at', '>=', now()->subDays(30))),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Se profil')
                    ->icon('heroicon-o-eye'),
                    
                Action::make('sendMessage')
                    ->label('Send melding')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('info')
                    ->url(fn ($record) => route('filament.app.resources.messages.create', ['recipient' => $record->id])),
            ])
            ->defaultSort('name')
            ->searchOnBlur()
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->emptyStateHeading('Ingen ansatte funnet')
            ->emptyStateDescription('Ingen ansatte matcher dine søkekriterier.')
            ->emptyStateIcon('heroicon-o-users');
    }
}
