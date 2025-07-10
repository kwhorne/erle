<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\FeatureRequests\Schemas;

use App\Models\FeatureRequest;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FeatureRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('feature_requests.table.columns.id'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->label(__('feature_requests.table.columns.title'))
                    ->sortable()
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->title),

                BadgeColumn::make('type')
                    ->label(__('feature_requests.table.columns.type'))
                    ->sortable()
                    ->enum([
                        'feature' => __('feature_requests.types.feature'),
                        'enhancement' => __('feature_requests.types.enhancement'),
                        'bug_fix' => __('feature_requests.types.bug_fix'),
                        'integration' => __('feature_requests.types.integration'),
                        'performance' => __('feature_requests.types.performance'),
                        'ui_ux' => __('feature_requests.types.ui_ux'),
                    ])
                    ->colors([
                        'primary' => 'feature',
                        'success' => 'enhancement',
                        'warning' => 'bug_fix',
                        'info' => 'integration',
                        'gray' => 'performance',
                        'secondary' => 'ui_ux',
                    ]),

                BadgeColumn::make('priority')
                    ->label(__('feature_requests.table.columns.priority'))
                    ->sortable()
                    ->enum([
                        'low' => __('feature_requests.priorities.low'),
                        'normal' => __('feature_requests.priorities.normal'),
                        'high' => __('feature_requests.priorities.high'),
                        'critical' => __('feature_requests.priorities.critical'),
                    ])
                    ->colors([
                        'gray' => 'low',
                        'primary' => 'normal',
                        'warning' => 'high',
                        'danger' => 'critical',
                    ]),

                BadgeColumn::make('status')
                    ->label(__('feature_requests.table.columns.status'))
                    ->sortable()
                    ->enum([
                        'pending' => __('feature_requests.statuses.pending'),
                        'under_review' => __('feature_requests.statuses.under_review'),
                        'approved' => __('feature_requests.statuses.approved'),
                        'in_development' => __('feature_requests.statuses.in_development'),
                        'testing' => __('feature_requests.statuses.testing'),
                        'completed' => __('feature_requests.statuses.completed'),
                        'rejected' => __('feature_requests.statuses.rejected'),
                        'cancelled' => __('feature_requests.statuses.cancelled'),
                    ])
                    ->colors([
                        'gray' => 'pending',
                        'warning' => 'under_review',
                        'success' => 'approved',
                        'info' => 'in_development',
                        'primary' => 'testing',
                        'success' => 'completed',
                        'danger' => 'rejected',
                        'gray' => 'cancelled',
                    ]),

                TextColumn::make('requestedBy.name')
                    ->label(__('feature_requests.table.columns.requested_by'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('assignedTo.name')
                    ->label(__('feature_requests.table.columns.assigned_to'))
                    ->sortable()
                    ->searchable()
                    ->placeholder('Ikke tildelt'),

                TextColumn::make('category')
                    ->label(__('feature_requests.table.columns.category'))
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'ui' => __('feature_requests.categories.ui'),
                        'backend' => __('feature_requests.categories.backend'),
                        'mobile' => __('feature_requests.categories.mobile'),
                        'api' => __('feature_requests.categories.api'),
                        'security' => __('feature_requests.categories.security'),
                        'reporting' => __('feature_requests.categories.reporting'),
                        'integration' => __('feature_requests.categories.integration'),
                        'workflow' => __('feature_requests.categories.workflow'),
                        'automation' => __('feature_requests.categories.automation'),
                        'analytics' => __('feature_requests.categories.analytics'),
                        default => $state,
                    }),

                TextColumn::make('votes_count')
                    ->label(__('feature_requests.table.columns.votes_count'))
                    ->sortable()
                    ->numeric()
                    ->alignCenter(),

                TextColumn::make('target_date')
                    ->label(__('feature_requests.table.columns.target_date'))
                    ->sortable()
                    ->date('d.m.Y')
                    ->placeholder('Ikke satt'),

                TextColumn::make('created_at')
                    ->label(__('feature_requests.table.columns.created_at'))
                    ->sortable()
                    ->dateTime('d.m.Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('feature_requests.table.columns.updated_at'))
                    ->sortable()
                    ->dateTime('d.m.Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label(__('feature_requests.table.filters.type'))
                    ->options([
                        'feature' => __('feature_requests.types.feature'),
                        'enhancement' => __('feature_requests.types.enhancement'),
                        'bug_fix' => __('feature_requests.types.bug_fix'),
                        'integration' => __('feature_requests.types.integration'),
                        'performance' => __('feature_requests.types.performance'),
                        'ui_ux' => __('feature_requests.types.ui_ux'),
                    ])
                    ->multiple(),

                SelectFilter::make('priority')
                    ->label(__('feature_requests.table.filters.priority'))
                    ->options([
                        'low' => __('feature_requests.priorities.low'),
                        'normal' => __('feature_requests.priorities.normal'),
                        'high' => __('feature_requests.priorities.high'),
                        'critical' => __('feature_requests.priorities.critical'),
                    ])
                    ->multiple(),

                SelectFilter::make('status')
                    ->label(__('feature_requests.table.filters.status'))
                    ->options([
                        'pending' => __('feature_requests.statuses.pending'),
                        'under_review' => __('feature_requests.statuses.under_review'),
                        'approved' => __('feature_requests.statuses.approved'),
                        'in_development' => __('feature_requests.statuses.in_development'),
                        'testing' => __('feature_requests.statuses.testing'),
                        'completed' => __('feature_requests.statuses.completed'),
                        'rejected' => __('feature_requests.statuses.rejected'),
                        'cancelled' => __('feature_requests.statuses.cancelled'),
                    ])
                    ->multiple(),

                SelectFilter::make('category')
                    ->label(__('feature_requests.table.filters.category'))
                    ->options([
                        'ui' => __('feature_requests.categories.ui'),
                        'backend' => __('feature_requests.categories.backend'),
                        'mobile' => __('feature_requests.categories.mobile'),
                        'api' => __('feature_requests.categories.api'),
                        'security' => __('feature_requests.categories.security'),
                        'reporting' => __('feature_requests.categories.reporting'),
                        'integration' => __('feature_requests.categories.integration'),
                        'workflow' => __('feature_requests.categories.workflow'),
                        'automation' => __('feature_requests.categories.automation'),
                        'analytics' => __('feature_requests.categories.analytics'),
                    ])
                    ->multiple(),

                SelectFilter::make('requested_by')
                    ->label(__('feature_requests.table.filters.requested_by'))
                    ->relationship('requestedBy', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('assigned_to')
                    ->label(__('feature_requests.table.filters.assigned_to'))
                    ->relationship('assignedTo', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('my_requests')
                    ->label(__('feature_requests.actions.filter_my_requests'))
                    ->query(fn (Builder $query) => $query->where('requested_by', Auth::id()))
                    ->indicator('Mine forespørsler'),

                Filter::make('assigned_to_me')
                    ->label(__('feature_requests.actions.filter_assigned_to_me'))
                    ->query(fn (Builder $query) => $query->where('assigned_to', Auth::id()))
                    ->indicator('Tildelt meg'),

                Filter::make('high_priority')
                    ->label(__('feature_requests.actions.filter_high_priority'))
                    ->query(fn (Builder $query) => $query->whereIn('priority', ['high', 'critical']))
                    ->indicator('Høy prioritet'),
            ])
            ->actions([
                ViewAction::make()
                    ->label(__('feature_requests.table.actions.view')),
                
                EditAction::make()
                    ->label(__('feature_requests.table.actions.edit')),

                Action::make('vote')
                    ->label(__('feature_requests.table.actions.vote'))
                    ->icon('heroicon-o-heart')
                    ->color('success')
                    ->visible(fn (FeatureRequest $record) => !$record->hasUserVoted(Auth::id()) && $record->requested_by !== Auth::id())
                    ->action(function (FeatureRequest $record) {
                        $record->addVote(Auth::id());
                    })
                    ->successNotificationTitle(__('feature_requests.messages.voted')),

                Action::make('unvote')
                    ->label(__('feature_requests.table.actions.unvote'))
                    ->icon('heroicon-o-heart')
                    ->color('gray')
                    ->visible(fn (FeatureRequest $record) => $record->hasUserVoted(Auth::id()))
                    ->action(function (FeatureRequest $record) {
                        $record->removeVote(Auth::id());
                    })
                    ->successNotificationTitle(__('feature_requests.messages.unvoted')),

                Action::make('approve')
                    ->label(__('feature_requests.table.actions.approve'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (FeatureRequest $record) => $record->status === 'pending' || $record->status === 'under_review')
                    ->requiresConfirmation()
                    ->action(function (FeatureRequest $record) {
                        $record->approve(Auth::id());
                    })
                    ->successNotificationTitle(__('feature_requests.messages.approved')),

                Action::make('reject')
                    ->label(__('feature_requests.table.actions.reject'))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (FeatureRequest $record) => $record->status === 'pending' || $record->status === 'under_review')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label(__('feature_requests.fields.rejection_reason'))
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (FeatureRequest $record, array $data) {
                        $record->reject(Auth::id(), $data['rejection_reason']);
                    })
                    ->successNotificationTitle(__('feature_requests.messages.rejected')),

                DeleteAction::make()
                    ->label(__('feature_requests.table.actions.delete'))
                    ->visible(fn (FeatureRequest $record) => $record->status !== 'in_development' && $record->status !== 'completed'),
            ])
            ->bulkActions([
                BulkAction::make('approve')
                    ->label(__('feature_requests.actions.bulk_approve'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Collection $records) {
                        $records->each(function (FeatureRequest $record) {
                            if (in_array($record->status, ['pending', 'under_review'])) {
                                $record->approve(Auth::id());
                            }
                        });
                    })
                    ->successNotificationTitle(__('feature_requests.messages.approved')),

                BulkAction::make('reject')
                    ->label(__('feature_requests.actions.bulk_reject'))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label(__('feature_requests.fields.rejection_reason'))
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (Collection $records, array $data) {
                        $records->each(function (FeatureRequest $record) use ($data) {
                            if (in_array($record->status, ['pending', 'under_review'])) {
                                $record->reject(Auth::id(), $data['rejection_reason']);
                            }
                        });
                    })
                    ->successNotificationTitle(__('feature_requests.messages.rejected')),

                BulkAction::make('delete')
                    ->label(__('feature_requests.actions.bulk_delete'))
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Collection $records) {
                        $records->each(function (FeatureRequest $record) {
                            if (!in_array($record->status, ['in_development', 'completed'])) {
                                $record->delete();
                            }
                        });
                    })
                    ->successNotificationTitle(__('feature_requests.messages.deleted')),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
