<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\FeatureRequests\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class FeatureRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('feature_requests.sections.basic_info.title'))
                    ->description(__('feature_requests.sections.basic_info.description'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('feature_requests.fields.title'))
                                    ->placeholder(__('feature_requests.placeholders.title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                
                                Textarea::make('description')
                                    ->label(__('feature_requests.fields.description'))
                                    ->placeholder(__('feature_requests.placeholders.description'))
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make(__('feature_requests.sections.classification.title'))
                    ->description(__('feature_requests.sections.classification.description'))
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('type')
                                    ->label(__('feature_requests.fields.type'))
                                    ->options([
                                        'feature' => __('feature_requests.types.feature'),
                                        'enhancement' => __('feature_requests.types.enhancement'),
                                        'bug_fix' => __('feature_requests.types.bug_fix'),
                                        'integration' => __('feature_requests.types.integration'),
                                        'performance' => __('feature_requests.types.performance'),
                                        'ui_ux' => __('feature_requests.types.ui_ux'),
                                    ])
                                    ->required()
                                    ->default('feature'),

                                Select::make('priority')
                                    ->label(__('feature_requests.fields.priority'))
                                    ->options([
                                        'low' => __('feature_requests.priorities.low'),
                                        'normal' => __('feature_requests.priorities.normal'),
                                        'high' => __('feature_requests.priorities.high'),
                                        'critical' => __('feature_requests.priorities.critical'),
                                    ])
                                    ->required()
                                    ->default('normal'),

                                Select::make('status')
                                    ->label(__('feature_requests.fields.status'))
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
                                    ->required()
                                    ->default('pending')
                                    ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('category')
                                    ->label(__('feature_requests.fields.category'))
                                    ->placeholder(__('feature_requests.placeholders.category'))
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
                                    ->searchable(),

                                TagsInput::make('tags')
                                    ->label(__('feature_requests.fields.tags'))
                                    ->placeholder(__('feature_requests.placeholders.tags'))
                                    ->separator(',')
                                    ->splitKeys(['Tab', ','])
                                    ->nestedRecursiveRules([
                                        'min:2',
                                        'max:50',
                                    ]),
                            ]),
                    ]),

                Section::make(__('feature_requests.sections.assignment.title'))
                    ->description(__('feature_requests.sections.assignment.description'))
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('requested_by')
                                    ->label(__('feature_requests.fields.requested_by'))
                                    ->relationship('requestedBy', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->default(Auth::id())
                                    ->required()
                                    ->disabled(),

                                Select::make('assigned_to')
                                    ->label(__('feature_requests.fields.assigned_to'))
                                    ->relationship('assignedTo', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Ikke tildelt')
                                    ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),

                                Select::make('reviewed_by')
                                    ->label(__('feature_requests.fields.reviewed_by'))
                                    ->relationship('reviewedBy', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Ikke vurdert')
                                    ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
                            ]),
                    ]),

                Section::make(__('feature_requests.sections.details.title'))
                    ->description(__('feature_requests.sections.details.description'))
                    ->schema([
                        Textarea::make('business_justification')
                            ->label(__('feature_requests.fields.business_justification'))
                            ->placeholder(__('feature_requests.placeholders.business_justification'))
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('technical_requirements')
                            ->label(__('feature_requests.fields.technical_requirements'))
                            ->placeholder(__('feature_requests.placeholders.technical_requirements'))
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('acceptance_criteria')
                            ->label(__('feature_requests.fields.acceptance_criteria'))
                            ->placeholder(__('feature_requests.placeholders.acceptance_criteria'))
                            ->rows(3)
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('estimated_hours')
                                    ->label(__('feature_requests.fields.estimated_hours'))
                                    ->numeric()
                                    ->suffix('timer')
                                    ->minValue(0),

                                TextInput::make('estimated_cost')
                                    ->label(__('feature_requests.fields.estimated_cost'))
                                    ->numeric()
                                    ->prefix('NOK')
                                    ->minValue(0)
                                    ->step('0.01'),
                            ]),
                    ]),

                Section::make(__('feature_requests.sections.implementation.title'))
                    ->description(__('feature_requests.sections.implementation.description'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('target_date')
                                    ->label(__('feature_requests.fields.target_date'))
                                    ->native(false),

                                DatePicker::make('completed_date')
                                    ->label(__('feature_requests.fields.completed_date'))
                                    ->native(false)
                                    ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
                            ]),

                        Textarea::make('implementation_notes')
                            ->label(__('feature_requests.fields.implementation_notes'))
                            ->placeholder(__('feature_requests.placeholders.implementation_notes'))
                            ->rows(3)
                            ->columnSpanFull()
                            ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),

                        TextInput::make('version_released')
                            ->label(__('feature_requests.fields.version_released'))
                            ->maxLength(50)
                            ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
                    ]),

                Section::make(__('feature_requests.sections.attachments.title'))
                    ->description(__('feature_requests.sections.attachments.description'))
                    ->schema([
                        TextInput::make('external_reference')
                            ->label(__('feature_requests.fields.external_reference'))
                            ->placeholder(__('feature_requests.placeholders.external_reference'))
                            ->maxLength(255)
                            ->url(),

                        Textarea::make('user_comments')
                            ->label(__('feature_requests.fields.user_comments'))
                            ->placeholder(__('feature_requests.placeholders.user_comments'))
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('feature_requests.sections.review.title'))
                    ->description(__('feature_requests.sections.review.description'))
                    ->schema([
                        Textarea::make('rejection_reason')
                            ->label(__('feature_requests.fields.rejection_reason'))
                            ->placeholder(__('feature_requests.placeholders.rejection_reason'))
                            ->rows(3)
                            ->columnSpanFull()
                            ->visible(fn ($livewire, $record) => $livewire instanceof \Filament\Resources\Pages\EditRecord && $record?->status === 'rejected'),
                    ])
                    ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
            ]);
    }
}
