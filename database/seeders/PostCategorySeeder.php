<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

final class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kunngjøringer',
                'description' => 'Viktige kunngjøringer og oppdateringer fra ledelsen',
                'color' => '#DC2626', // red-600
                'icon' => 'heroicon-o-megaphone',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'Nyheter',
                'description' => 'Generelle nyheter og oppdateringer fra selskapet',
                'color' => '#2563EB', // blue-600
                'icon' => 'heroicon-o-newspaper',
                'is_active' => true,
                'sort_order' => 20,
            ],
            [
                'name' => 'HR og Personal',
                'description' => 'Personalnyheter, nye ansatte, og HR-relaterte oppdateringer',
                'color' => '#059669', // emerald-600
                'icon' => 'heroicon-o-users',
                'is_active' => true,
                'sort_order' => 30,
            ],
            [
                'name' => 'Prosjekter',
                'description' => 'Oppdateringer fra pågående og fullførte prosjekter',
                'color' => '#7C3AED', // violet-600
                'icon' => 'heroicon-o-briefcase',
                'is_active' => true,
                'sort_order' => 40,
            ],
            [
                'name' => 'Teknologi',
                'description' => 'Tekniske oppdateringer, verktøy og IT-relaterte nyheter',
                'color' => '#EA580C', // orange-600
                'icon' => 'heroicon-o-wrench-screwdriver',
                'is_active' => true,
                'sort_order' => 50,
            ],
            [
                'name' => 'Kunnskap',
                'description' => 'Læring, utvikling og kompetanseheving',
                'color' => '#0891B2', // cyan-600
                'icon' => 'heroicon-o-academic-cap',
                'is_active' => true,
                'sort_order' => 60,
            ],
            [
                'name' => 'Events',
                'description' => 'Kommende arrangementer, møter og sosiale aktiviteter',
                'color' => '#DB2777', // pink-600
                'icon' => 'heroicon-o-calendar',
                'is_active' => true,
                'sort_order' => 70,
            ],
            [
                'name' => 'Prestasjon',
                'description' => 'Anerkjennelse av medarbeidere og team-prestasjoner',
                'color' => '#D97706', // amber-600
                'icon' => 'heroicon-o-trophy',
                'is_active' => true,
                'sort_order' => 80,
            ],
            [
                'name' => 'Sikkerhet',
                'description' => 'Sikkerhetsinformasjon og retningslinjer',
                'color' => '#DC2626', // red-600
                'icon' => 'heroicon-o-shield-check',
                'is_active' => true,
                'sort_order' => 90,
            ],
            [
                'name' => 'Sosialt',
                'description' => 'Sosiale aktiviteter og fellesskap på arbeidsplassen',
                'color' => '#16A34A', // green-600
                'icon' => 'heroicon-o-heart',
                'is_active' => true,
                'sort_order' => 100,
            ],
            [
                'name' => 'Tips og Triks',
                'description' => 'Nyttige tips og triks for arbeidslivet',
                'color' => '#CA8A04', // yellow-600
                'icon' => 'heroicon-o-light-bulb',
                'is_active' => true,
                'sort_order' => 110,
            ],
            [
                'name' => 'Generelt',
                'description' => 'Generell informasjon som ikke passer inn i andre kategorier',
                'color' => '#6B7280', // gray-500
                'icon' => 'heroicon-o-tag',
                'is_active' => true,
                'sort_order' => 120,
            ],
        ];

        foreach ($categories as $categoryData) {
            PostCategory::firstOrCreate(
                ['name' => $categoryData['name']],
                $categoryData
            );
        }
    }
}
