<?php

namespace App\Filament\App\Resources\Contacts\Schemas;

use App\ContactType;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Support\Enums\IconPosition;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->schema([
                Tabs::make('ContactTabs')
                    ->columnSpan(2)
                    ->tabs([
                        Tab::make('Grunnleggende informasjon')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                TextInput::make('organization')
                                    ->label('Organisasjon/Bedrift')
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-building-office')
                                    ->columnSpanFull(),
                                    
                                TextInput::make('address')
                                    ->label('Adresse')
                                    ->maxLength(500)
                                    ->prefixIcon('heroicon-o-map-pin')
                                    ->columnSpanFull(),
                                    
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('postal_code')
                                            ->label('Postnr.')
                                            ->maxLength(10)
                                            ->prefixIcon('heroicon-o-hashtag'),
                                            
                                        TextInput::make('city')
                                            ->label('Sted')
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-building-office-2'),
                                            
                                        TextInput::make('organization_number')
                                            ->label('Org.Nr.')
                                            ->maxLength(20)
                                            ->prefixIcon('heroicon-o-identification')
                                            ->placeholder('123 456 789'),
                                    ]),
                                    
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('email')
                                            ->label('E-post')
                                            ->email()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-envelope'),
                                            
                                        TextInput::make('phone')
                                            ->label('Telefon')
                                            ->tel()
                                            ->maxLength(20)
                                            ->prefixIcon('heroicon-o-phone'),
                                            
                                        TextInput::make('website')
                                            ->label('Nettside')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder('https://'),
                                    ]),
                                    
                                TextInput::make('country')
                                    ->label('Land')
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-flag')
                                    ->default('Norge')
                                    ->columnSpanFull(),
                                    
                                Textarea::make('notes')
                                    ->label('Notater')
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->placeholder('Skriv notater om kontakten, møter, avtaler etc.')
                                    ->columnSpanFull(),
                            ]),
                            
                        Tab::make('Kontaktpersoner')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Repeater::make('contact_persons')
                                    ->label('Kontaktpersoner')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Navn')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-user'),
                                                    
                                                TextInput::make('title')
                                                    ->label('Stilling/Rolle')
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-briefcase'),
                                            ]),
                                            
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('email')
                                                    ->label('E-post')
                                                    ->email()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-envelope'),
                                                    
                                                TextInput::make('phone')
                                                    ->label('Telefon')
                                                    ->tel()
                                                    ->maxLength(20)
                                                    ->prefixIcon('heroicon-o-phone'),
                                            ]),
                                            
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('linkedin')
                                                    ->label('LinkedIn')
                                                    ->url()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-link')
                                                    ->placeholder('https://linkedin.com/in/'),
                                                    
                                                TextInput::make('twitter')
                                                    ->label('Twitter/X')
                                                    ->url()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-link')
                                                    ->placeholder('https://twitter.com/'),
                                            ]),
                                            
                                        Textarea::make('notes')
                                            ->label('Personlige notater')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->placeholder('Notater om denne personen...')
                                            ->columnSpanFull(),
                                    ])
                                    ->defaultItems(1)
                                    ->addActionLabel('Legg til kontaktperson')
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Ny kontaktperson')
                                    ->columnSpanFull(),
                            ]),
                            
                        Tab::make('Dokumenter')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                FileUpload::make('contactdocs')
                                    ->label('Dokumenter')
                                    ->directory('contactdocs')
                                    ->disk('public')
                                    ->multiple()
                                    ->acceptedFileTypes([
                                        'application/pdf',
                                        'application/msword',
                                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'application/vnd.ms-excel',
                                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                        'text/plain',
                                        'image/jpeg',
                                        'image/png',
                                        'image/gif'
                                    ])
                                    ->maxFiles(10)
                                    ->maxSize(10240) // 10MB
                                    ->downloadable()
                                    ->openable()
                                    ->deletable()
                                    ->reorderable()
                                    ->uploadingMessage('Laster opp dokumenter...')
                                    ->columnSpanFull(),
                            ]),
                    ]),
                    
                Section::make('CRM Data')
                    ->description('Salgs- og oppfølgingsinformasjon')
                    ->columnSpan(1)
                    ->schema([
                        Select::make('type')
                            ->label('Type')
                            ->options(ContactType::options())
                            ->prefixIcon('heroicon-o-tag')
                            ->required(),
                            
                        Select::make('assigned_to')
                            ->label('Ansvarlig')
                            ->options(User::where('is_employee', true)->pluck('name', 'id'))
                            ->prefixIcon('heroicon-o-user')
                            ->searchable()
                            ->preload(),
                            
                        Select::make('source')
                            ->label('Kilde')
                            ->options([
                                'website' => 'Nettside',
                                'referral' => 'Anbefaling',
                                'linkedin' => 'LinkedIn',
                                'facebook' => 'Facebook',
                                'google' => 'Google/Søk',
                                'advertisement' => 'Annonse',
                                'email_campaign' => 'E-postkampanje',
                                'trade_show' => 'Messe/Utstilling',
                                'networking' => 'Nettverksarrangement',
                                'cold_call' => 'Kald oppringning',
                                'existing_customer' => 'Eksisterende kunde',
                                'partner' => 'Partner',
                                'media' => 'Media/Presse',
                                'other' => 'Annet',
                            ])
                            ->prefixIcon('heroicon-o-arrow-top-right-on-square')
                            ->placeholder('Velg hvor kontakten kom fra'),
                            
                        TextInput::make('value')
                            ->label('Verdi (NOK)')
                            ->numeric()
                            ->prefix('kr')
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder('0,00'),
                            
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Aktiv',
                                'inactive' => 'Inaktiv', 
                                'archived' => 'Arkivert',
                            ])
                            ->prefixIcon('heroicon-o-signal')
                            ->default('active')
                            ->required(),
                            
                        DatePicker::make('last_contact_date')
                            ->label('Siste kontakt')
                            ->prefixIcon('heroicon-o-calendar-days')
                            ->displayFormat('d.m.Y'),
                            
                        DatePicker::make('next_followup_date')
                            ->label('Neste oppfølging')
                            ->prefixIcon('heroicon-o-clock')
                            ->displayFormat('d.m.Y'),
                            
                        TagsInput::make('tags')
                            ->label('Tagger')
                            ->prefixIcon('heroicon-o-hashtag')
                            ->placeholder('Legg til tagger...')
                            ->suggestions([
                                'VIP',
                                'Stor kunde',
                                'Lead',
                                'Referanse',
                                'Eksisterende kunde',
                                'Potensiell kunde',
                            ]),
                    ]),
            ]);
    }
}
