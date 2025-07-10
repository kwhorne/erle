<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class DashboardOverviewWidget extends Widget
{
    protected string $view = 'filament.app.widgets.dashboard-overview-widget';

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            'currentUser' => Auth::user(),
            'todaysTasks' => $this->getTodaysTasks(),
            'freshLeads' => $this->getFreshLeads(),
            'latestNews' => $this->getLatestNews(),
        ];
    }

    private function getTodaysTasks(): array
    {
        // Placeholder data - integrer med faktiske oppgaver når systemet er utvidet
        return [
            ['title' => 'Følg opp Acme Corp', 'priority' => 'high', 'deadline' => '10:00'],
            ['title' => 'Kunde-møte med TechStart', 'priority' => 'medium', 'deadline' => '14:00'],
            ['title' => 'Fullføre månedlige rapporter', 'priority' => 'low', 'deadline' => '16:00'],
        ];
    }

    private function getFreshLeads(): array
    {
        // Placeholder data - integrer med faktiske leads når systemet er utvidet
        return [
            ['name' => 'Nordic Solutions AS', 'value' => '250.000', 'source' => 'Webside'],
            ['name' => 'Digital Consulting', 'value' => '180.000', 'source' => 'Henvisning'],
            ['name' => 'StartupTech', 'value' => '95.000', 'source' => 'LinkedIn'],
        ];
    }

    private function getLatestNews(): array
    {
        // Hent faktiske nylige posts, eller bruk placeholder data
        $recentPosts = \App\Models\Post::where('status', 'published')
            ->with(['author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
            
        if ($recentPosts->isEmpty()) {
            // Fallback til placeholder data
            return [
                ['title' => 'Velkommen til Erle CRM & Intranett', 'author' => 'System', 'time' => '1 dag siden'],
                ['title' => 'Ny funksjonalitet: Dashboard oversikt', 'author' => 'Admin', 'time' => '2 dager siden'],
                ['title' => 'Teamet ønsker alle velkommen', 'author' => 'HR', 'time' => '3 dager siden'],
            ];
        }
        
        return $recentPosts->map(function($post) {
            return [
                'title' => $post->title,
                'author' => $post->author->name,
                'time' => $post->published_at->diffForHumans(),
            ];
        })->toArray();
    }
}
