<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Documents\Schemas;

use App\Models\DocumentCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Dokumentinformasjon')
                    ->description('Grunnleggende informasjon om dokumentet')
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Tittel')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                                    
                                Textarea::make('description')
                                    ->label('Beskrivelse')
                                    ->rows(3)
                                    ->columnSpan(2),
                                    
                                Select::make('document_category_id')
                                    ->label('Kategori')
                                    ->options(DocumentCategory::active()->ordered()->pluck('name', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Navn')
                                            ->required(),
                                        Textarea::make('description')
                                            ->label('Beskrivelse'),
                                        TextInput::make('color')
                                            ->label('Farge')
                                            ->default('#3B82F6'),
                                        TextInput::make('icon')
                                            ->label('Ikon')
                                            ->default('heroicon-o-folder'),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                        return DocumentCategory::create($data)->id;
                                    }),
                                    
                                TextInput::make('keywords')
                                    ->label('Nøkkelord')
                                    ->placeholder('Skriv inn nøkkelord separert med komma')
                                    ->helperText('Bruk komma for å separere nøkkelord (f.eks: kontrakt, avtale, juridisk)'),
                            ]),
                    ]),
                    
                Section::make('Filopplasting')
                    ->description('Last opp dokumentfil')
                    ->icon('heroicon-o-cloud-arrow-up')
                    ->columnSpanFull()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('document')
                            ->label('Dokument')
                            ->collection('document')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                'text/plain',
                                'image/jpeg',
                                'image/png',
                                'image/gif',
                            ])
                            ->maxSize(10240) // 10MB
                            ->required()
                            ->helperText('Støttede formater: PDF, Word, Excel, PowerPoint, Tekst, Bilder. Maks størrelse: 10MB'),
                    ]),
                    
                Section::make('Innstillinger')
                    ->description('Tilgjengelighet og synlighet')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_public')
                                    ->label('Offentlig tilgjengelig')
                                    ->helperText('Gjør dokumentet tilgjengelig for alle ansatte')
                                    ->default(false),
                                    
                                Toggle::make('is_active')
                                    ->label('Aktiv')
                                    ->helperText('Aktiver eller deaktiver dokumentet')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }
}
