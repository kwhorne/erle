<?php

namespace App\Filament\App\Resources\Projects\Schemas;

use App\Models\Contact;
use App\Models\User;
use App\ProjectPriority;
use App\ProjectStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->schema([
                // Main content (2/3 width)
                Tabs::make('ProjectTabs')
                    ->columnSpan(2)
                    ->tabs([
                        // Basic Information Tab
                        Tab::make('Grunnleggende')
                            ->icon(Heroicon::OutlinedInformationCircle)
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('project_number')
                                            ->label('Prosjektnummer')
                                            ->disabled()
                                            ->placeholder('Genereres automatisk')
                                            ->helperText('Automatisk generert ved lagring'),

                                        Select::make('contact_id')
                                            ->label('Kunde')
                                            ->relationship('contact', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->optionsLimit(50)

                                            ->helperText('Velg kunde for prosjektet'),
                                    ]),

                                TextInput::make('name')
                                    ->label('Prosjektnavn')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull()
,

                                Textarea::make('description')
                                    ->label('Beskrivelse')
                                    ->rows(4)
                                    ->columnSpanFull()
                                    ->placeholder('Detaljert beskrivelse av prosjektet...'),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('location')
                                            ->label('Lokasjon')
                                            ->maxLength(255)

                                            ->placeholder('Prosjektlokasjon'),

                                        TextInput::make('scope')
                                            ->label('Omfang')
                                            ->maxLength(255)

                                            ->placeholder('Prosjektomfang'),
                                    ]),

                                Textarea::make('requirements')
                                    ->label('Krav og spesifikasjoner')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->placeholder('Spesifikke krav for prosjektet...'),

                                Textarea::make('deliverables')
                                    ->label('Leveranser')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->placeholder('Forventede leveranser...'),
                            ]),

                        // Project Management Tab
                        Tab::make('Prosjektledelse')
                            ->icon(Heroicon::OutlinedUsers)
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Select::make('project_manager_id')
                                            ->label('Prosjektleder')
                                            ->relationship('projectManager', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->optionsLimit(50)
                                            ->options(
                                                User::where('is_employee', true)
                                                    ->orderBy('name')
                                                    ->pluck('name', 'id')
                                            )

                                            ->helperText('Hovedansvarlig for prosjektet'),

                                        Select::make('team_lead_id')
                                            ->label('Teamleder')
                                            ->relationship('teamLead', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->optionsLimit(50)
                                            ->options(
                                                User::where('is_employee', true)
                                                    ->orderBy('name')
                                                    ->pluck('name', 'id')
                                            )

                                            ->helperText('Teamleder for utførelse'),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('progress')
                                            ->label('Fremdrift (%)')
                                            ->numeric()
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->suffix('%')
                                            ->default(0)
,

                                        Toggle::make('is_template')
                                            ->label('Prosjektmal')
                                            ->helperText('Bruk som mal for nye prosjekter')
                                            ->default(false),
                                    ]),

                                Textarea::make('milestones')
                                    ->label('Milepæler')
                                    ->rows(4)
                                    ->columnSpanFull()
                                    ->placeholder('JSON format: [{"name": "Milepæl 1", "date": "2025-12-31", "completed": false}]')
                                    ->helperText('Lagres som JSON - kan utvides med egen editor senere'),

                                Textarea::make('risks')
                                    ->label('Risikoer')
                                    ->rows(4)
                                    ->columnSpanFull()
                                    ->placeholder('JSON format: [{"risk": "Risiko beskrivelse", "probability": "high", "impact": "medium"}]')
                                    ->helperText('Lagres som JSON - kan utvides med egen editor senere'),
                            ]),

                        // Notes & Documents Tab
                        Tab::make('Notater og dokumenter')
                            ->icon(Heroicon::OutlinedDocumentText)
                            ->schema([
                                RichEditor::make('notes')
                                    ->label('Prosjektnotater')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'bulletList',
                                        'orderedList',
                                        'link',
                                        'undo',
                                        'redo',
                                    ])
                                    ->placeholder('Interne notater for prosjektet...'),

                                RichEditor::make('client_notes')
                                    ->label('Kundenotater')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'bulletList',
                                        'orderedList',
                                        'link',
                                        'undo',
                                        'redo',
                                    ])
                                    ->placeholder('Notater som kan deles med kunde...'),

                                FileUpload::make('attachments')
                                    ->label('Vedlegg')
                                    ->multiple()
                                    ->directory('projects')
                                    ->disk('public')
                                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'image/*'])
                                    ->maxSize(10240) // 10MB
                                    ->helperText('Maks 10MB per fil. Tillatte formater: PDF, Word, Excel, bilder')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                // Sidebar (1/3 width)
                Section::make('Status og tidsplan')
                    ->columnSpan(1)
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options(ProjectStatus::options())
                            ->default('planning')
                            ->required()
                            ->native(false)
,

                        Select::make('priority')
                            ->label('Prioritet')
                            ->options(ProjectPriority::options())
                            ->default('normal')
                            ->required()
                            ->native(false)
,

                        Grid::make(2)
                            ->schema([
                                DatePicker::make('start_date')
                                    ->label('Planlagt start')
                                    ->native(false)
                                    ->displayFormat('d.m.Y'),

                                DatePicker::make('end_date')
                                    ->label('Planlagt slutt')
                                    ->native(false)
                                    ->displayFormat('d.m.Y'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                DatePicker::make('actual_start_date')
                                    ->label('Faktisk start')
                                    ->native(false)
                                    ->displayFormat('d.m.Y')
,

                                DatePicker::make('actual_end_date')
                                    ->label('Faktisk slutt')
                                    ->native(false)
                                    ->displayFormat('d.m.Y')
,
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('estimated_hours')
                                    ->label('Estimerte timer')
                                    ->numeric()
                                    ->minValue(0)
                                    ->suffix('timer')
,

                                TextInput::make('actual_hours')
                                    ->label('Faktiske timer')
                                    ->numeric()
                                    ->minValue(0)
                                    ->suffix('timer')
,
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('budget')
                                    ->label('Budsjett')
                                    ->numeric()
                                    ->prefix('kr')
                                    ->minValue(0)
,

                                TextInput::make('actual_cost')
                                    ->label('Faktisk kostnad')
                                    ->numeric()
                                    ->prefix('kr')
                                    ->minValue(0)
,
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('hourly_rate')
                                    ->label('Timepris')
                                    ->numeric()
                                    ->prefix('kr')
                                    ->minValue(0)
,

                                Toggle::make('is_billable')
                                    ->label('Fakturerbar')
                                    ->default(true)
                                    ->helperText('Kan faktureres til kunde'),
                            ]),

                        Textarea::make('custom_fields')
                            ->label('Tilpassede felter')
                            ->rows(3)
                            ->placeholder('JSON format for tilpassede data')
                            ->helperText('Lagres som JSON for fleksibilitet'),

                        // Display calculated values (read-only)
                        Placeholder::make('calculated_budget')
                            ->label('Beregnet budsjett')
                            ->content(function (callable $get) {
                                $hours = $get('estimated_hours') ?: 0;
                                $rate = $get('hourly_rate') ?: 0;
                                return 'kr ' . number_format($hours * $rate, 0, ',', ' ');
                            })
                            ->visible(fn (callable $get) => $get('estimated_hours') && $get('hourly_rate')),


                     ]),
            ]);
    }
}
