<?php

namespace App\Filament\App\Resources\WorkOrders\Schemas;

use App\Models\Contact;
use App\Models\User;
use App\WorkOrderPriority;
use App\WorkOrderStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class WorkOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->schema([
                Tabs::make('WorkOrderTabs')
                    ->columnSpan(2)
                    ->tabs([
                        Tab::make('Grunnleggende informasjon')
                            ->icon('heroicon-o-clipboard-document')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('work_order_number')
                                            ->label('Ordrenummer')
                                            ->unique(ignoreRecord: true)
                                            ->prefixIcon('heroicon-o-hashtag')
                                            ->disabled(fn ($record) => $record !== null)
                                            ->default(fn () => 'WO' . now()->year . str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT)),
                                            
                                        Select::make('contact_id')
                                            ->label('Kunde/Kontakt')
                                            ->relationship('contact', 'organization')
                                            ->prefixIcon('heroicon-o-user')
                                            ->searchable()
                                            ->preload()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                if ($state) {
                                                    $contact = Contact::find($state);
                                                    if ($contact) {
                                                        $set('customer_name', $contact->organization);
                                                        $set('customer_email', $contact->email);
                                                        $set('customer_phone', $contact->phone);
                                                    }
                                                }
                                            }),
                                    ]),
                                    
                                TextInput::make('title')
                                    ->label('Tittel')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-document')
                                    ->columnSpanFull(),
                                    
                                Textarea::make('description')
                                    ->label('Beskrivelse')
                                    ->required()
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->placeholder('Detaljert beskrivelse av arbeidsoppgaven...')
                                    ->columnSpanFull(),
                                    
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('customer_name')
                                            ->label('Kundenavn')
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-building-office'),
                                            
                                        TextInput::make('customer_email')
                                            ->label('Kunde e-post')
                                            ->email()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-envelope'),
                                            
                                        TextInput::make('customer_phone')
                                            ->label('Kunde telefon')
                                            ->tel()
                                            ->maxLength(20)
                                            ->prefixIcon('heroicon-o-phone'),
                                    ]),
                                    
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('location')
                                            ->label('Lokasjon')
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-map-pin'),
                                            
                                        TextInput::make('equipment')
                                            ->label('Utstyr')
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-cog'),
                                            
                                        TextInput::make('equipment_serial')
                                            ->label('Serienummer')
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-qr-code'),
                                    ]),
                            ]),
                            
                        Tab::make('Deler og sjekkliste')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                Repeater::make('parts_used')
                                    ->label('Deler brukt')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('part_name')
                                                    ->label('Delnavn')
                                                    ->required()
                                                    ->maxLength(255),
                                                    
                                                TextInput::make('quantity')
                                                    ->label('Antall')
                                                    ->numeric()
                                                    ->default(1)
                                                    ->minValue(1),
                                                    
                                                TextInput::make('cost')
                                                    ->label('Kostnad (NOK)')
                                                    ->numeric()
                                                    ->prefix('kr'),
                                            ]),
                                            
                                        Textarea::make('notes')
                                            ->label('Notater')
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                    ])
                                    ->defaultItems(0)
                                    ->addActionLabel('Legg til del')
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['part_name'] ?? 'Ny del')
                                    ->columnSpanFull(),
                                    
                                Repeater::make('checklist')
                                    ->label('Sjekkliste')
                                    ->schema([
                                        TextInput::make('task')
                                            ->label('Oppgave')
                                            ->required()
                                            ->maxLength(255),
                                            
                                        Toggle::make('completed')
                                            ->label('Fullført')
                                            ->default(false),
                                    ])
                                    ->defaultItems(0)
                                    ->addActionLabel('Legg til oppgave')
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['task'] ?? 'Ny oppgave')
                                    ->columnSpanFull(),
                            ]),
                            
                        Tab::make('Notater')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Textarea::make('internal_notes')
                                    ->label('Interne notater')
                                    ->rows(6)
                                    ->maxLength(2000)
                                    ->placeholder('Interne notater for tekniker og ledelse...')
                                    ->columnSpanFull(),
                                    
                                Textarea::make('customer_notes')
                                    ->label('Kundenotater')
                                    ->rows(6)
                                    ->maxLength(2000)
                                    ->placeholder('Notater som kan deles med kunden...')
                                    ->columnSpanFull(),
                            ]),
                            
                        Tab::make('Vedlegg')
                            ->icon('heroicon-o-paper-clip')
                            ->schema([
                                FileUpload::make('workorder_attachments')
                                    ->label('Vedlegg')
                                    ->directory('workorders')
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
                                    ->uploadingMessage('Laster opp filer...')
                                    ->columnSpanFull(),
                            ]),
                    ]),
                    
                Section::make('Status og tidsplan')
                    ->description('Prioritet, status og tidsestimater')
                    ->columnSpan(1)
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options(WorkOrderStatus::options())
                            ->default('pending')
                            ->prefixIcon('heroicon-o-signal')
                            ->required(),
                            
                        Select::make('priority')
                            ->label('Prioritet')
                            ->options(WorkOrderPriority::options())
                            ->default('normal')
                            ->prefixIcon('heroicon-o-exclamation-triangle')
                            ->required(),
                            
                        Select::make('assigned_to')
                            ->label('Tildelt')
                            ->relationship('assignedTo', 'name')
                            ->options(User::where('is_employee', true)->pluck('name', 'id'))
                            ->prefixIcon('heroicon-o-user')
                            ->searchable()
                            ->preload(),
                            
                        DateTimePicker::make('due_date')
                            ->label('Forfallsdato')
                            ->prefixIcon('heroicon-o-calendar')
                            ->displayFormat('d.m.Y H:i'),
                            
                        DateTimePicker::make('started_at')
                            ->label('Startet')
                            ->prefixIcon('heroicon-o-play')
                            ->displayFormat('d.m.Y H:i'),
                            
                        DateTimePicker::make('completed_at')
                            ->label('Fullført')
                            ->prefixIcon('heroicon-o-check-circle')
                            ->displayFormat('d.m.Y H:i'),
                            
                        Grid::make(2)
                            ->schema([
                                TextInput::make('estimated_hours')
                                    ->label('Estimerte timer')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(1000)
                                    ->prefixIcon('heroicon-o-clock'),
                                    
                                TextInput::make('actual_hours')
                                    ->label('Faktiske timer')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(1000)
                                    ->prefixIcon('heroicon-o-clock'),
                            ]),
                            
                        Grid::make(2)
                            ->schema([
                                TextInput::make('estimated_cost')
                                    ->label('Estimert kostnad')
                                    ->numeric()
                                    ->prefix('kr')
                                    ->prefixIcon('heroicon-o-banknotes'),
                                    
                                TextInput::make('actual_cost')
                                    ->label('Faktisk kostnad')
                                    ->numeric()
                                    ->prefix('kr')
                                    ->prefixIcon('heroicon-o-banknotes'),
                            ]),
                            
                        Toggle::make('billable')
                            ->label('Fakturerbar')
                            ->default(true)
                            ->helperText('Om denne arbeidsordren skal faktureres til kunden'),
                    ]),
            ]);
    }
}
