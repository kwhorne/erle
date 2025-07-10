<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\PostCategories\Tables;

use App\Models\PostCategory;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class PostCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Navn')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn (PostCategory $record): ?string => $record->description),
                    
                ColorColumn::make('color')
                    ->label('Farge')
                    ->sortable(),
                    
                IconColumn::make('icon')
                    ->label('Ikon')
                    ->icon(fn (PostCategory $record): string => $record->icon)
                    ->color(fn (PostCategory $record): string => $record->color),
                    
                TextColumn::make('post_count')
                    ->label('Antall innlegg')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->getStateUsing(fn (PostCategory $record): int => $record->posts()->count()),
                    
                TextColumn::make('published_post_count')
                    ->label('Publiserte')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->getStateUsing(fn (PostCategory $record): int => $record->publishedPosts()->count()),
                    
                IconColumn::make('is_active')
                    ->label('Aktiv')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                    
                TextColumn::make('sort_order')
                    ->label('Rekkefølge')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                    
                TextColumn::make('created_at')
                    ->label('Opprettet')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->label('Oppdatert')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('is_active')
                    ->label('Kun aktive')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true))
                    ->default(),
                    
                Filter::make('has_posts')
                    ->label('Med innlegg')
                    ->query(fn (Builder $query): Builder => $query->has('posts')),
                    
                Filter::make('no_posts')
                    ->label('Uten innlegg')
                    ->query(fn (Builder $query): Builder => $query->doesntHave('posts')),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->label('Rediger')
                        ->icon('heroicon-o-pencil')
                        ->modalHeading('Rediger kategori')
                        ->modalWidth('2xl'),
                        
                    Action::make('toggle_active')
                        ->label(fn (PostCategory $record) => $record->is_active ? 'Deaktiver' : 'Aktiver')
                        ->icon(fn (PostCategory $record) => $record->is_active ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                        ->color(fn (PostCategory $record) => $record->is_active ? 'warning' : 'success')
                        ->action(function (PostCategory $record) {
                            $record->update(['is_active' => !$record->is_active]);
                        })
                        ->requiresConfirmation()
                        ->modalHeading(fn (PostCategory $record) => $record->is_active ? 'Deaktiver kategori' : 'Aktiver kategori')
                        ->modalDescription(fn (PostCategory $record) => $record->is_active 
                            ? 'Er du sikker på at du vil deaktivere denne kategorien? Den vil ikke lenger være tilgjengelig for nye innlegg.'
                            : 'Er du sikker på at du vil aktivere denne kategorien?'
                        ),
                        
                    DeleteAction::make()
                        ->label('Slett')
                        ->icon('heroicon-o-trash')
                        ->modalHeading('Slett kategori')
                        ->modalDescription('Er du sikker på at du vil slette denne kategorien? Alle tilhørende innlegg vil også bli slettet. Denne handlingen kan ikke angres.')
                        ->modalSubmitActionLabel('Slett')
                        ->modalCancelActionLabel('Avbryt')
                        ->before(function (PostCategory $record) {
                            // Check if category has posts
                            if ($record->posts()->count() > 0) {
                                throw new \Exception('Kan ikke slette kategori som har innlegg. Flytt eller slett innleggene først.');
                            }
                        }),
                ])
            ])
            ->bulkActions([
                // Bulk actions can be added here
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->striped()
            ->paginated([10, 25, 50])
            ->emptyStateHeading('Ingen kategorier')
            ->emptyStateDescription('Kom i gang ved å opprette din første kategori.')
            ->emptyStateIcon('heroicon-o-tag');
    }
}
