<?php

namespace App\Filament\App\Resources\Projects\Tables;

use App\ProjectPriority;
use App\ProjectStatus;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_number')
                    ->label('Prosjektnummer')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Prosjektnummer kopiert!')

                    ->weight('bold'),

                TextColumn::make('name')
                    ->label('Prosjektnavn')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    })
,

                TextColumn::make('contact.name')
                    ->label('Kunde')
                    ->searchable(['contacts.name', 'contacts.organization'])
                    ->sortable()
                    ->limit(25)

                    ->url(fn ($record) => $record->contact ? route('filament.app.resources.contacts.edit', $record->contact) : null)
                    ->color(Color::Blue),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state): string => $state instanceof ProjectStatus ? $state->getLabel() : ProjectStatus::from($state)->getLabel())
                    ->colors([
                        'warning' => 'planning',
                        'info' => 'active',
                        'gray' => 'on_hold',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                        'purple' => 'maintenance',
                    ])
                    ->sortable(),

                BadgeColumn::make('priority')
                    ->label('Prioritet')
                    ->formatStateUsing(fn ($state): string => $state instanceof ProjectPriority ? $state->getLabel() : ProjectPriority::from($state)->getLabel())
                    ->colors([
                        'gray' => 'low',
                        'info' => 'normal',
                        'warning' => 'high',
                        'orange' => 'urgent',
                        'danger' => 'critical',
                    ])
                    ->sortable(),

                TextColumn::make('progress_percentage')
                    ->label('Fremdrift')
                    ->suffix('%')
                    ->sortable()
                    ->color(function ($state) {
                        if ($state >= 100) return Color::Green;
                        if ($state >= 75) return Color::Blue;
                        if ($state >= 50) return Color::Yellow;
                        if ($state >= 25) return Color::Orange;
                        return Color::Red;
                    }),

                TextColumn::make('projectManager.name')
                    ->label('Prosjektleder')
                    ->searchable(['users.name'])
                    ->sortable()
                    ->limit(20)

                    ->placeholder('Ikke tildelt'),

                TextColumn::make('start_date')
                    ->label('Planlagt start')
                    ->date('d.m.Y')
                    ->sortable()

                    ->placeholder('Ikke satt'),

                TextColumn::make('end_date')
                    ->label('Planlagt slutt')
                    ->date('d.m.Y')
                    ->sortable()

                    ->color(function ($record) {
                        if (!$record->end_date) return null;
                        return $record->isOverdue() ? Color::Red : null;
                    })
                    ->placeholder('Ikke satt'),

                TextColumn::make('budget')
                    ->label('Budsjett')
                    ->money('NOK')
                    ->sortable()

                    ->placeholder('kr 0'),

                TextColumn::make('actual_cost')
                    ->label('Faktisk kostnad')
                    ->money('NOK')
                    ->sortable()

                    ->color(function ($record) {
                        if (!$record->budget || !$record->actual_cost) return null;
                        return $record->actual_cost > $record->budget ? Color::Red : Color::Green;
                    })
                    ->placeholder('kr 0'),

                BooleanColumn::make('is_billable')
                    ->label('Fakturerbar')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Opprettet')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Oppdatert')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
