<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

final class DocumentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kontrakter',
                'description' => 'Juridiske kontrakter og avtaler',
                'color' => '#EF4444',
                'icon' => 'heroicon-o-document-text',
                'sort_order' => 1,
            ],
            [
                'name' => 'Policyer',
                'description' => 'Bedriftspolicyer og retningslinjer',
                'color' => '#3B82F6',
                'icon' => 'heroicon-o-shield-check',
                'sort_order' => 2,
            ],
            [
                'name' => 'Prosjektdokumenter',
                'description' => 'Dokumenter knyttet til spesifikke prosjekter',
                'color' => '#10B981',
                'icon' => 'heroicon-o-briefcase',
                'sort_order' => 3,
            ],
            [
                'name' => 'Presentasjoner',
                'description' => 'PowerPoint og andre presentasjoner',
                'color' => '#F59E0B',
                'icon' => 'heroicon-o-presentation-chart-line',
                'sort_order' => 4,
            ],
            [
                'name' => 'Regnskapsføring',
                'description' => 'Regnskap, budsjetter og finansielle dokumenter',
                'color' => '#8B5CF6',
                'icon' => 'heroicon-o-calculator',
                'sort_order' => 5,
            ],
            [
                'name' => 'HR-dokumenter',
                'description' => 'Personaldokumenter og HR-relatert materiale',
                'color' => '#EC4899',
                'icon' => 'heroicon-o-users',
                'sort_order' => 6,
            ],
            [
                'name' => 'Markedsføring',
                'description' => 'Markedsføringsmateriell og kampanjer',
                'color' => '#06B6D4',
                'icon' => 'heroicon-o-megaphone',
                'sort_order' => 7,
            ],
            [
                'name' => 'Teknisk dokumentasjon',
                'description' => 'Tekniske manualer og spesifikasjoner',
                'color' => '#64748B',
                'icon' => 'heroicon-o-cog-6-tooth',
                'sort_order' => 8,
            ],
            [
                'name' => 'Annet',
                'description' => 'Diverse dokumenter som ikke passer i andre kategorier',
                'color' => '#6B7280',
                'icon' => 'heroicon-o-folder',
                'sort_order' => 99,
            ],
        ];

        foreach ($categories as $category) {
            DocumentCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
