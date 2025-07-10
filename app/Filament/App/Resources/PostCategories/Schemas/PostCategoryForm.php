<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\PostCategories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class PostCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Grunnleggende informasjon')
                    ->description('Navn og beskrivelse av kategorien')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Navn')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', \Illuminate\Support\Str::slug($state));
                                    }),
                                    
                                TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->helperText('Automatisk generert fra navnet'),
                            ]),
                            
                        Textarea::make('description')
                            ->label('Beskrivelse')
                            ->rows(3)
                            ->maxLength(1000)
                            ->helperText('Kort beskrivelse av hva slags innlegg som hører til denne kategorien'),
                    ]),
                    
                Section::make('Utseende og innstillinger')
                    ->description('Visuelle elementer og innstillinger')
                    ->icon('heroicon-o-paint-brush')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ColorPicker::make('color')
                                    ->label('Farge')
                                    ->default('#3B82F6')
                                    ->helperText('Farge som brukes for badges og markering'),
                                    
                                Select::make('icon')
                                    ->label('Ikon')
                                    ->options([
                                        'heroicon-o-tag' => 'Tag (standard)',
                                        'heroicon-o-newspaper' => 'Avis',
                                        'heroicon-o-megaphone' => 'Megafon',
                                        'heroicon-o-chat-bubble-left-right' => 'Chat',
                                        'heroicon-o-light-bulb' => 'Lyspære',
                                        'heroicon-o-academic-cap' => 'Utdanning',
                                        'heroicon-o-briefcase' => 'Koffert',
                                        'heroicon-o-calendar' => 'Kalender',
                                        'heroicon-o-chart-bar' => 'Diagram',
                                        'heroicon-o-cog-6-tooth' => 'Innstillinger',
                                        'heroicon-o-document-text' => 'Dokument',
                                        'heroicon-o-envelope' => 'E-post',
                                        'heroicon-o-flag' => 'Flagg',
                                        'heroicon-o-gift' => 'Gave',
                                        'heroicon-o-globe-alt' => 'Globus',
                                        'heroicon-o-heart' => 'Hjerte',
                                        'heroicon-o-home' => 'Hjem',
                                        'heroicon-o-information-circle' => 'Info',
                                        'heroicon-o-key' => 'Nøkkel',
                                        'heroicon-o-lock-closed' => 'Lås',
                                        'heroicon-o-musical-note' => 'Musikk',
                                        'heroicon-o-photo' => 'Foto',
                                        'heroicon-o-puzzle-piece' => 'Puslespill',
                                        'heroicon-o-question-mark-circle' => 'Spørsmål',
                                        'heroicon-o-rocket-launch' => 'Rakett',
                                        'heroicon-o-shield-check' => 'Sikkerhet',
                                        'heroicon-o-star' => 'Stjerne',
                                        'heroicon-o-trophy' => 'Trofe',
                                        'heroicon-o-truck' => 'Lastebil',
                                        'heroicon-o-users' => 'Brukere',
                                        'heroicon-o-wrench-screwdriver' => 'Verktøy',
                                    ])
                                    ->default('heroicon-o-tag')
                                    ->searchable()
                                    ->helperText('Ikon som vises ved siden av kategorinavnet'),
                            ]),
                            
                        Grid::make(2)
                            ->schema([
                                TextInput::make('sort_order')
                                    ->label('Sorteringsrekkefølge')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->helperText('Lavere tall vises først'),
                                    
                                Toggle::make('is_active')
                                    ->label('Aktiv')
                                    ->default(true)
                                    ->helperText('Bare aktive kategorier er tilgjengelige for nye innlegg'),
                            ]),
                    ]),
            ]);
    }
}
