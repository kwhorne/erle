<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class WelcomeWidget extends Widget
{
    protected string $view = 'filament.app.widgets.welcome-widget';

    protected static ?int $sort = 0;

    public function getData(): array
    {
        $user = Auth::user();
        $firstName = explode(' ', $user->name)[0];
        
        return [
            'firstName' => $firstName,
            'fullName' => $user->name,
        ];
    }
}
