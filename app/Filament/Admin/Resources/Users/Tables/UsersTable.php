<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users\Tables;

use App\Mail\UserInvitationMail;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

final class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Navn')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-post')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('E-post kopiert!')
                    ->icon('heroicon-m-envelope'),
                TextColumn::make('phone')
                    ->label('Telefon')
                    ->toggleable()
                    ->copyable()
                    ->icon('heroicon-m-phone'),
                TextColumn::make('job_title')
                    ->label('Stillingstittel')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('department')
                    ->label('Avdeling')
                    ->toggleable()
                    ->searchable(),
                BooleanColumn::make('is_employee')
                    ->label('Ansatt')
                    ->sortable()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
                BooleanColumn::make('is_admin')
                    ->label('Administrator')
                    ->sortable()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-shield-exclamation'),
                TextColumn::make('last_login_at')
                    ->label('Siste pålogging')
                    ->dateTime()
                    ->sortable()
                    ->toggleable()
                    ->since(),
                TextColumn::make('email_verified_at')
                    ->label('E-post verifisert')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Opprettet')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label('Oppdatert')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_employee')
                    ->label('Ansatt')
                    ->trueLabel('Kun ansatte')
                    ->falseLabel('Kun ikke-ansatte')
                    ->queries(
                        true: fn ($query) => $query->where('is_employee', true),
                        false: fn ($query) => $query->where('is_employee', false),
                    ),
                TernaryFilter::make('is_admin')
                    ->label('Administrator')
                    ->trueLabel('Kun administratorer')
                    ->falseLabel('Kun ikke-administratorer')
                    ->queries(
                        true: fn ($query) => $query->where('is_admin', true),
                        false: fn ($query) => $query->where('is_admin', false),
                    ),
                Filter::make('email_verified')
                    ->label('E-post verifisert')
                    ->query(fn ($query) => $query->whereNotNull('email_verified_at')),
                Filter::make('recent_login')
                    ->label('Logget inn siste 30 dager')
                    ->query(fn ($query) => $query->where('last_login_at', '>=', now()->subDays(30))),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('sendInvitation')
                    ->label('Send invitasjon')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Send invitasjon til bruker')
                    ->modalDescription('Dette vil generere et nytt passord og sende en e-postinvitasjon til brukeren.')
                    ->modalSubmitActionLabel('Send invitasjon')
                    ->action(function ($record) {
                        if (!$record->email || !$record->name) {
                            Notification::make()
                                ->title('Manglende informasjon')
                                ->body('Brukeren mangler navn eller e-postadresse.')
                                ->danger()
                                ->send();
                            return;
                        }
                        
                        // Generate a new password
                        $password = Str::random(12);
                        $record->update(['password' => \Illuminate\Support\Facades\Hash::make($password)]);
                        
                        try {
                            Mail::to($record->email)->send(new UserInvitationMail($record->name, $record->email, $password));
                            
                            Notification::make()
                                ->title('Invitasjon sendt')
                                ->body('E-postinvitasjon er sendt til ' . $record->email . ' med nytt passord.')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Feil ved sending')
                                ->body('Kunne ikke sende e-post: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->visible(fn ($record) => $record->email && $record->name),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
