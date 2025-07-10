<?php

namespace App\Filament\App\Resources\WorkOrders\Tables;

use App\Models\User;
use App\Models\WorkOrder;
use App\WorkOrderPriority;
use App\WorkOrderStatus;
use Filament\Actions\Action;

use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class WorkOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('work_order_number')
                    ->label('Ordrenummer')
                    ->copyable()
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('title')
                    ->label('Tittel')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                    
                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (WorkOrderStatus $state) => $state->getLabel())
                    ->colors([
                        'warning' => WorkOrderStatus::PENDING,
                        'info' => WorkOrderStatus::IN_PROGRESS,
                        'gray' => WorkOrderStatus::ON_HOLD,
                        'purple' => WorkOrderStatus::WAITING_CUSTOMER,
                        'orange' => WorkOrderStatus::WAITING_PARTS,
                        'indigo' => WorkOrderStatus::TESTING,
                        'success' => WorkOrderStatus::COMPLETED,
                        'danger' => WorkOrderStatus::CANCELLED,
                    ])
                    ->sortable(),
                    
                BadgeColumn::make('priority')
                    ->label('Prioritet')
                    ->formatStateUsing(fn (WorkOrderPriority $state) => $state->getLabel())
                    ->colors([
                        'gray' => WorkOrderPriority::LOW,
                        'info' => WorkOrderPriority::NORMAL,
                        'warning' => WorkOrderPriority::HIGH,
                        'orange' => WorkOrderPriority::URGENT,
                        'danger' => WorkOrderPriority::CRITICAL,
                    ])
                    ->sortable(),
                    
                TextColumn::make('contact.organization')
                    ->label('Kunde')
                    ->sortable()
                    ->searchable()
                    ->limit(25),
                    
                TextColumn::make('assignedTo.name')
                    ->label('Tildelt')
                    ->sortable()
                    ->placeholder('Ikke tildelt')
                    ->limit(20),
                    
                TextColumn::make('due_date')
                    ->label('Forfallsdato')
                    ->date('d.m.Y')
                    ->sortable(),
                    
                TextColumn::make('estimated_hours')
                    ->label('Timer (est.)')
                    ->numeric()
                    ->suffix(' h')
                    ->sortable(),
                    
                TextColumn::make('estimated_cost')
                    ->label('Kostnad (est.)')
                    ->money('NOK')
                    ->sortable(),
                    
                IconColumn::make('billable')
                    ->label('Fakturerbar')
                    ->boolean(),
                    
                TextColumn::make('created_at')
                    ->label('Opprettet')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(WorkOrderStatus::options())
                    ->multiple(),
                    
                SelectFilter::make('priority')
                    ->label('Prioritet')
                    ->options(WorkOrderPriority::options())
                    ->multiple(),
                    
                SelectFilter::make('assigned_to')
                    ->label('Tildelt')
                    ->relationship('assignedTo', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (WorkOrder $record): string => route('filament.app.resources.work-orders.edit', $record)),
            ])
            ->emptyStateHeading('Ingen arbeidsordrer')
            ->emptyStateDescription('Opprett din første arbeidsordre for å komme i gang')
            ->emptyStateIcon('heroicon-o-wrench');
    }
}
