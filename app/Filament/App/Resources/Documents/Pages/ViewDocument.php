<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Documents\Pages;

use App\Filament\App\Resources\Documents\DocumentResource;
use App\Models\Document;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

use Filament\Schemas\Schema;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;

final class ViewDocument extends ViewRecord
{
    protected static string $resource = DocumentResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Action::make('download')
                ->label('Last ned')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    $this->getRecord()->incrementDownloadCount();
                    $downloadUrl = $this->getRecord()->getDownloadUrl();
                    if ($downloadUrl) {
                        return redirect($downloadUrl);
                    }
                })
                ->visible(fn (): bool => $this->getRecord()->getDownloadUrl() !== null),
                
            EditAction::make()
                ->label('Rediger')
                ->icon('heroicon-o-pencil')
                ->modalHeading('Rediger dokument')
                ->modalWidth('5xl'),
                
            DeleteAction::make()
                ->label('Slett')
                ->icon('heroicon-o-trash')
                ->modalHeading('Slett dokument')
                ->modalDescription('Er du sikker på at du vil slette dette dokumentet? Denne handlingen kan ikke angres.')
                ->modalSubmitActionLabel('Slett')
                ->modalCancelActionLabel('Avbryt'),
        ];
    }
    
    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Dokumentinformasjon')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Tittel')
                                    ->weight(FontWeight::Bold)
                                    ->size('xl'),
                                    
                                TextEntry::make('category.name')
                                    ->label('Kategori')
                                    ->badge()
                                    ->color(fn (Document $record): string => $record->category->color ?? 'gray')
                                    ->icon(fn (Document $record): string => $record->category->icon ?? 'heroicon-o-folder'),
                                    
                                TextEntry::make('description')
                                    ->label('Beskrivelse')
                                    ->columnSpanFull()
                                    ->placeholder('Ingen beskrivelse tilgjengelig'),
                                    
                                TextEntry::make('keywords')
                                    ->label('Nøkkelord')
                                    ->badge()
                                    ->separator(',')
                                    ->columnSpanFull()
                                    ->placeholder('Ingen nøkkelord definert'),
                            ]),
                    ]),
                    
                Section::make('Filinformasjon')
                    ->icon('heroicon-o-document-arrow-down')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('file_type')
                                    ->label('Filtype')
                                    ->badge()
                                    ->color(fn (string $state): string => match (strtolower($state)) {
                                        'pdf' => 'danger',
                                        'docx', 'doc' => 'info',
                                        'xlsx', 'xls' => 'success',
                                        'pptx', 'ppt' => 'warning',
                                        'txt' => 'gray',
                                        'jpg', 'jpeg', 'png', 'gif' => 'purple',
                                        default => 'secondary',
                                    })
                                    ->icon(fn (string $state): string => match (strtolower($state)) {
                                        'pdf' => 'heroicon-o-document-text',
                                        'docx', 'doc' => 'heroicon-o-document',
                                        'xlsx', 'xls' => 'heroicon-o-table-cells',
                                        'pptx', 'ppt' => 'heroicon-o-presentation-chart-line',
                                        'txt' => 'heroicon-o-document-text',
                                        'jpg', 'jpeg', 'png', 'gif' => 'heroicon-o-photo',
                                        default => 'heroicon-o-document',
                                    }),
                                    
                                TextEntry::make('file_size_human')
                                    ->label('Filstørrelse'),
                                    
                                TextEntry::make('mime_type')
                                    ->label('MIME-type')
                                    ->copyable()
                                    ->copyMessage('MIME-type kopiert')
                                    ->copyMessageDuration(1500),
                            ]),
                    ]),
                    
                Section::make('Statistikk og tilgjengelighet')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        IconEntry::make('is_public')
                                            ->label('Offentlig tilgjengelig')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-eye')
                                            ->falseIcon('heroicon-o-eye-slash')
                                            ->trueColor('success')
                                            ->falseColor('gray'),
                                            
                                        IconEntry::make('is_active')
                                            ->label('Aktiv')
                                            ->boolean()
                                            ->trueIcon('heroicon-o-check-circle')
                                            ->falseIcon('heroicon-o-x-circle')
                                            ->trueColor('success')
                                            ->falseColor('danger'),
                                    ]),
                                    
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('download_count')
                                            ->label('Nedlastinger')
                                            ->numeric()
                                            ->badge()
                                            ->color('info'),
                                            
                                        TextEntry::make('last_accessed_at')
                                            ->label('Sist åpnet')
                                            ->dateTime('d.m.Y H:i')
                                            ->placeholder('Aldri åpnet'),
                                    ]),
                            ]),
                    ]),
                    
                Section::make('Metadata')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('uploader.name')
                                    ->label('Lastet opp av')
                                    ->icon('heroicon-o-user'),
                                    
                                TextEntry::make('created_at')
                                    ->label('Opprettet')
                                    ->dateTime('d.m.Y H:i')
                                    ->icon('heroicon-o-calendar'),
                                    
                                TextEntry::make('updated_at')
                                    ->label('Sist oppdatert')
                                    ->dateTime('d.m.Y H:i')
                                    ->icon('heroicon-o-clock'),
                            ]),
                    ]),
            ]);
    }
}
