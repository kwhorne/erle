<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users\Schemas;

use App\Filament\Admin\Resources\Users\Pages\CreateUser;
use App\Mail\UserInvitationMail;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

final class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->schema([
                Tabs::make('UserTabs')
                    ->columnSpan(2)
                    ->tabs([
                        Tab::make('Grunnleggende informasjon')
                            ->icon('heroicon-o-user')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Navn')
                                    ->maxLength(255)
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('address')
                                    ->label('Adresse')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('postal_code')
                                            ->label('Postnummer')
                                            ->maxLength(10),
                                        TextInput::make('city')
                                            ->label('Sted')
                                            ->maxLength(255),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('email')
                                            ->label('E-post')
                                            ->maxLength(255)
                                            ->unique()
                                            ->email()
                                            ->required(),
                                        TextInput::make('phone')
                                            ->label('Telefon')
                                            ->tel()
                                            ->maxLength(255),
                                    ]),
                            ]),
                            
                        Tab::make('Jobbinformasjon')
                            ->icon('heroicon-o-briefcase')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('job_title')
                                            ->label('Stillingstittel')
                                            ->maxLength(255),
                                        TextInput::make('department')
                                            ->label('Avdeling')
                                            ->maxLength(255),
                                    ]),
                                TextInput::make('location')
                                    ->label('Arbeidsplass')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Textarea::make('bio')
                                    ->label('Biografi')
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->columnSpanFull(),
                            ]),
                    ]),
                    
                Section::make('Brukerinnstillinger')
                    ->description('Roller, tilganger og personlig informasjon')
                    ->columnSpan(1)
                    ->schema([
                        Toggle::make('is_employee')
                            ->label('Er ansatt')
                            ->helperText('Markerer brukeren som ansatt i systemet')
                            ->default(false),
                        Toggle::make('is_admin')
                            ->label('Administrator')
                            ->helperText('Gir brukeren full admin-tilgang til systemet')
                            ->default(false),
                        TextInput::make('password')
                            ->label('Passord')
                            ->password()
                            ->required(fn ($livewire): bool => $livewire instanceof CreateUser)
                            ->revealable(filament()->arePasswordsRevealable())
                            ->rule(Password::default())
                            ->autocomplete('new-password')
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->suffixActions([
                                Action::make('generatePassword')
                                    ->label('Generer')
                                    ->icon('heroicon-o-key')
                                    ->action(function ($set) {
                                        $password = Str::random(12);
                                        $set('password', $password);
                                        Notification::make()
                                            ->title('Passord generert')
                                            ->body('Et nytt passord er generert og vist i feltet.')
                                            ->success()
                                            ->send();
                                    }),
                            ]),
                        DatePicker::make('birth_date')
                            ->label('Fødselsdato')
                            ->maxDate(now()),
                        TextInput::make('country')
                            ->label('Land')
                            ->maxLength(255)
                            ->default('Norge'),
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url()
                            ->maxLength(255)
                            ->suffixIcon('heroicon-m-link'),
                        TextInput::make('twitter_url')
                            ->label('Twitter URL')
                            ->url()
                            ->maxLength(255)
                            ->suffixIcon('heroicon-m-link'),
                    ]),
            ]);
    }
}
