<?php

namespace App\Filament\App\Resources\Projects;

use App\Filament\App\Resources\Projects\Pages\CreateProject;
use App\Filament\App\Resources\Projects\Pages\EditProject;
use App\Filament\App\Resources\Projects\Pages\ListProjects;
use App\Filament\App\Resources\Projects\Schemas\ProjectForm;
use App\Filament\App\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|UnitEnum|null $navigationGroup = null;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = null;
    protected static ?string $modelLabel = null;
    protected static ?string $pluralModelLabel = null;
    
    public static function getNavigationGroup(): ?string
    {
        return __('projects.resource.navigation_group');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('projects.resource.navigation_label');
    }
    
    public static function getModelLabel(): string
    {
        return __('projects.resource.model_label');
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('projects.resource.plural_model_label');
    }

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'projects';

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
