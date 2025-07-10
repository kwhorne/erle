<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Employees;

use App\Filament\App\Resources\Employees\Pages\ListEmployees;
use App\Filament\App\Resources\Employees\Pages\ViewEmployee;
use App\Filament\App\Resources\Employees\Tables\EmployeesTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use UnitEnum;

final class EmployeeResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Ansattekatalog';
    
    protected static ?string $modelLabel = 'Ansatt';
    
    protected static ?string $pluralModelLabel = 'Ansatte';

    protected static string|UnitEnum|null $navigationGroup = 'Team';
    
    protected static ?int $navigationSort = 1;

    // Only show employees
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('is_employee', true);
    }

    public static function table(Table $table): Table
    {
        return EmployeesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployees::route('/'),
            'view' => ViewEmployee::route('/{record}'),
        ];
    }
}
