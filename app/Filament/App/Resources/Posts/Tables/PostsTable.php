<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Posts\Tables;

use App\Models\Post;
use App\Models\PostCategory;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-post.png'))
                    ->size(50),
                    
                TextColumn::make('title')
                    ->label('Tittel')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->description(fn (Post $record): string => $record->excerpt_or_content),
                    
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (Post $record): string => $record->category->color ?? 'gray')
                    ->icon(fn (Post $record): string => $record->category->icon ?? 'heroicon-o-tag')
                    ->sortable(),
                    
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'warning',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Utkast',
                        'published' => 'Publisert',
                        'archived' => 'Arkivert',
                        default => $state,
                    }),
                    
                TextColumn::make('author.name')
                    ->label('Forfatter')
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('view_count')
                    ->label('Visninger')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                TextColumn::make('like_count')
                    ->label('Likes')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),
                    
                TextColumn::make('published_at')
                    ->label('Publisert')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->placeholder('Ikke publisert')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('created_at')
                    ->label('Opprettet')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('reading_time')
                    ->label('Lesetid')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('post_category_id')
                    ->label('Kategori')
                    ->options(PostCategory::active()->ordered()->pluck('name', 'id'))
                    ->multiple()
                    ->preload(),
                    
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Utkast',
                        'published' => 'Publisert',
                        'archived' => 'Arkivert',
                    ])
                    ->multiple(),
                    
                SelectFilter::make('author_id')
                    ->label('Forfatter')
                    ->options(
                        fn () => \App\Models\User::where('is_employee', true)
                            ->orderBy('name')
                            ->pluck('name', 'id')
                    )
                    ->multiple()
                    ->preload(),
                    
                Filter::make('is_featured')
                    ->label('Kun fremhevede')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true)),
                    
                Filter::make('recent')
                    ->label('Nylige (siste 30 dager)')
                    ->query(fn (Builder $query): Builder => $query->where('created_at', '>=', now()->subDays(30))),
                    
                Filter::make('popular')
                    ->label('Populære (50+ visninger)')
                    ->query(fn (Builder $query): Builder => $query->where('view_count', '>=', 50)),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Vis')
                        ->icon('heroicon-o-eye'),
                        
                    Action::make('like')
                        ->label('Like')
                        ->icon('heroicon-o-heart')
                        ->color('danger')
                        ->action(function (Post $record) {
                            $record->incrementLikeCount();
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Like innlegg')
                        ->modalDescription('Er du sikker på at du vil like dette innlegget?'),
                        
                    Action::make('feature')
                        ->label(fn (Post $record) => $record->is_featured ? 'Fjern fremheving' : 'Fremhev')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->action(function (Post $record) {
                            $record->update(['is_featured' => !$record->is_featured]);
                        }),
                        
                    DeleteAction::make()
                        ->label('Slett')
                        ->icon('heroicon-o-trash')
                        ->modalHeading('Slett innlegg')
                        ->modalDescription('Er du sikker på at du vil slette dette innlegget? Denne handlingen kan ikke angres.')
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
            ->emptyStateHeading('Ingen innlegg')
            ->emptyStateDescription('Kom i gang ved å opprette ditt første innlegg.')
            ->emptyStateIcon('heroicon-o-newspaper');
    }
}
