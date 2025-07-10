<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Widgets\WelcomeWidget;
use App\Filament\App\Widgets\DashboardOverviewWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getTitle(): string
    {
        return __('dashboard.title');
    }

    public function getWidgets(): array
    {
        return [
            WelcomeWidget::class,
            DashboardOverviewWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return 1;
    }
}
