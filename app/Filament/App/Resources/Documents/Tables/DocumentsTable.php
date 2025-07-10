<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Documents\Tables;

use App\Models\Document;
use App\Models\DocumentCategory;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

final class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Tittel')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn (Document $record): string => $record->description ?? ''),
                    
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (Document $record): string => $record->category->color ?? 'gray')
                    ->icon(fn (Document $record): string => $record->category->icon ?? 'heroicon-o-folder')
                    ->sortable(),
                    
                TextColumn::make('file_type')
                    ->label('Type')
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
                    
                TextColumn::make('file_size_human')
                    ->label('Størrelse')
                    ->sortable(['file_size'])
                    ->alignment('right'),
                    
                IconColumn::make('is_public')
                    ->label('Offentlig')
                    ->boolean()
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->trueColor('success')
                    ->falseColor('gray'),
                    
                TextColumn::make('download_count')
                    ->label('Nedlastinger')
                    ->numeric()
                    ->sortable()
                    ->alignment('center')
                    ->badge()
                    ->color('info'),
                    
                TextColumn::make('uploader.name')
                    ->label('Lastet opp av')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('created_at')
                    ->label('Opprettet')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('last_accessed_at')
                    ->label('Sist åpnet')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->placeholder('Aldri')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('document_category_id')
                    ->label('Kategori')
                    ->options(DocumentCategory::active()->ordered()->pluck('name', 'id'))
                    ->multiple()
                    ->preload(),
                    
                SelectFilter::make('file_type')
                    ->label('Filtype')
                    ->options([
                        'pdf' => 'PDF',
                        'docx' => 'Word',
                        'xlsx' => 'Excel',
                        'pptx' => 'PowerPoint',
                        'txt' => 'Tekst',
                        'jpg' => 'Bilde',
                        'png' => 'PNG',
                    ])
                    ->multiple(),
                    
                Filter::make('is_public')
                    ->label('Kun offentlige')
                    ->query(fn (Builder $query): Builder => $query->where('is_public', true)),
                    
                Filter::make('recent')
                    ->label('Nylige (siste 30 dager)')
                    ->query(fn (Builder $query): Builder => $query->where('created_at', '>=', now()->subDays(30))),
                    
                Filter::make('popular')
                    ->label('Populære (10+ nedlastinger)')
                    ->query(fn (Builder $query): Builder => $query->where('download_count', '>=', 10)),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Vis')
                        ->icon('heroicon-o-eye'),
                        
                    Action::make('download')
                        ->label('Last ned')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function (Document $record) {
                            $record->incrementDownloadCount();
                            $downloadUrl = $record->getDownloadUrl();
                            if ($downloadUrl) {
                                return redirect($downloadUrl);
                            }
                        })
                        ->visible(fn (Document $record): bool => $record->getDownloadUrl() !== null),
                        
                    DeleteAction::make()
                        ->label('Slett')
                        ->icon('heroicon-o-trash')
                        ->modalHeading('Slett dokument')
                        ->modalDescription('Er du sikker på at du vil slette dette dokumentet? Denne handlingen kan ikke angres.')
                        ->modalSubmitActionLabel('Slett')
                        ->modalCancelActionLabel('Avbryt'),
                ])
            ])
            ->bulkActions([
                // Bulk actions can be added here
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->emptyStateHeading('Ingen dokumenter')
            ->emptyStateDescription('Kom i gang ved å laste opp ditt første dokument.')
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
