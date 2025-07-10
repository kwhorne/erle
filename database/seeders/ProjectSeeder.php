<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Project;
use App\Models\User;
use App\ProjectPriority;
use App\ProjectStatus;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some contacts and users for relationships
        $contacts = Contact::all();
        $employees = User::where('is_employee', true)->get();
        
        if ($contacts->isEmpty() || $employees->isEmpty()) {
            $this->command->warn('No contacts or employees found. Please run ContactSeeder and ensure users have is_employee=true.');
            return;
        }

        $projects = [
            [
                'name' => 'Ny nettside for Acme Corp',
                'description' => 'Komplett redesign og utvikling av bedriftens nettside med moderne teknologi og responsivt design.',
                'status' => 'active',
                'priority' => 'high',
                'contact_id' => $contacts->random()->id,
                'project_manager_id' => $employees->random()->id,
                'assigned_team_lead_id' => $employees->random()->id,
                'location' => 'Oslo, Norge',
                'scope_of_work' => 'Fullstendig nettside med CMS',
                'requirements' => 'Responsivt design, SEO-optimalisert, integrert med eksisterende systemer',
                'deliverables' => 'Nettside, CMS, dokumentasjon, opplæring',
                'start_date' => now()->subDays(30),
                'end_date' => now()->addDays(60),
                'actual_start_date' => now()->subDays(25),
                'estimated_hours' => 320,
                'actual_hours' => 180,
                'budget' => 400000,
                'actual_cost' => 225000,
                'hourly_rate' => 1250,
                'billable' => true,
                'progress_percentage' => 65,
                'internal_notes' => '<p>Prosjektet går bra, noen mindre forsinkelser på design-fasen.</p>',
                'client_notes' => '<p>Kunden er fornøyd med fremdriften så langt.</p>',
                'milestones' => json_encode([
                    ['name' => 'Design godkjent', 'date' => '2025-01-15', 'completed' => true],
                    ['name' => 'Utvikling startet', 'date' => '2025-01-20', 'completed' => true],
                    ['name' => 'Beta-testing', 'date' => '2025-02-15', 'completed' => false],
                    ['name' => 'Lansering', 'date' => '2025-03-01', 'completed' => false]
                ]),
                'risks' => json_encode([
                    ['risk' => 'Forsinkelse i tredjepartsintegrasjon', 'probability' => 'medium', 'impact' => 'high'],
                    ['risk' => 'Scope creep fra kunde', 'probability' => 'high', 'impact' => 'medium']
                ]),

            ],
            [
                'name' => 'ERP-system implementering',
                'description' => 'Implementering av nytt ERP-system for bedre forretningsstyring og automatisering av prosesser.',
                'status' => 'planning',
                'priority' => 'critical',
                'contact_id' => $contacts->random()->id,
                'project_manager_id' => $employees->random()->id,
                'assigned_team_lead_id' => $employees->random()->id,
                'location' => 'Bergen, Norge',
                'scope_of_work' => 'ERP-implementering med integrasjoner',
                'requirements' => 'Integrasjon med eksisterende systemer, data-migrering, opplæring',
                'deliverables' => 'Konfigurert ERP-system, migrerte data, opplæringsprogram',
                'start_date' => now()->addDays(15),
                'end_date' => now()->addDays(180),
                'estimated_hours' => 800,
                'budget' => 1200000,
                'hourly_rate' => 1500,
                'billable' => true,
                'progress_percentage' => 10,
                'internal_notes' => '<p>Prosjekt i oppstartsfase, gjennomgår krav og teknisk arkitektur.</p>',
                'client_notes' => '<p>Viktig å få på plass grundig planlegging før oppstart.</p>',
                'milestones' => json_encode([
                    ['name' => 'Kravspesifikasjon ferdig', 'date' => '2025-02-01', 'completed' => false],
                    ['name' => 'Teknisk arkitektur', 'date' => '2025-02-15', 'completed' => false],
                    ['name' => 'Utviklingsstart', 'date' => '2025-03-01', 'completed' => false]
                ]),
                'risks' => json_encode([
                    ['risk' => 'Kompleks data-migrering', 'probability' => 'high', 'impact' => 'high'],
                    ['risk' => 'Motstand mot endring', 'probability' => 'medium', 'impact' => 'medium']
                ]),

            ],
            [
                'name' => 'Mobil app for kundeservice',
                'description' => 'Utvikling av mobilapp for forbedret kundeservice og selvbetjening.',
                'status' => 'completed',
                'priority' => 'normal',
                'contact_id' => $contacts->random()->id,
                'project_manager_id' => $employees->random()->id,
                'assigned_team_lead_id' => $employees->random()->id,
                'location' => 'Trondheim, Norge',
                'scope_of_work' => 'iOS og Android app med backend',
                'requirements' => 'Native apps, push-notifikasjoner, offline-modus',
                'deliverables' => 'iOS app, Android app, backend API, dokumentasjon',
                'start_date' => now()->subDays(120),
                'end_date' => now()->addDays(60),
                'actual_start_date' => now()->subDays(115),
                'actual_end_date' => now()->subDays(25),
                'estimated_hours' => 480,
                'actual_hours' => 520,
                'budget' => 600000,
                'actual_cost' => 650000,
                'hourly_rate' => 1200,
                'billable' => true,
                'progress_percentage' => 100,
                'internal_notes' => '<p>Prosjekt fullført med stor suksess. Appen er lansert i App Store og Google Play.</p>',
                'client_notes' => '<p>Meget fornøyd med resultatet, appen har fått gode tilbakemeldinger fra brukere.</p>',
                'milestones' => json_encode([
                    ['name' => 'Prototype klar', 'date' => '2024-09-15', 'completed' => true],
                    ['name' => 'Beta-testing', 'date' => '2024-10-15', 'completed' => true],
                    ['name' => 'Lansering', 'date' => '2024-11-15', 'completed' => true]
                ]),

            ],
            [
                'name' => 'Skymigrering av IT-infrastruktur',
                'description' => 'Migrering av on-premise servere til skybasert løsning for bedre skalerbarhet og sikkerhet.',
                'status' => 'on_hold',
                'priority' => 'high',
                'contact_id' => $contacts->random()->id,
                'project_manager_id' => $employees->random()->id,
                'location' => 'Stavanger, Norge',
                'scope_of_work' => 'Komplett skymigrering',
                'requirements' => 'Zero-downtime migrering, sikkerhet, backup-løsninger',
                'deliverables' => 'Skybasert infrastruktur, migrerte systemer, dokumentasjon',
                'start_date' => now()->subDays(60),
                'end_date' => now()->addDays(90),
                'actual_start_date' => now()->subDays(55),
                'estimated_hours' => 400,
                'actual_hours' => 120,
                'budget' => 800000,
                'actual_cost' => 150000,
                'hourly_rate' => 1400,
                'billable' => true,
                'progress_percentage' => 25,
                'internal_notes' => '<p>Prosjekt satt på vent på grunn av endringer i kundens prioriteringer.</p>',
                'client_notes' => '<p>Venter på godkjenning av revidert budsjett.</p>',
                'risks' => json_encode([
                    ['risk' => 'Data-tap under migrering', 'probability' => 'low', 'impact' => 'high'],
                    ['risk' => 'Uforutsette kostnadsutvikler', 'probability' => 'medium', 'impact' => 'medium']
                ]),

            ],
            [
                'name' => 'E-handelsplattform modernisering',
                'description' => 'Oppgrader og moderniser eksisterende e-handelsplattform for bedre ytelse og brukeropplevelse.',
                'status' => 'active',
                'priority' => 'high',
                'contact_id' => $contacts->random()->id,
                'project_manager_id' => $employees->random()->id,
                'assigned_team_lead_id' => $employees->random()->id,
                'location' => 'Oslo, Norge',
                'scope_of_work' => 'Frontend og backend modernisering',
                'requirements' => 'Raskere lasting, bedre søk, mobile-first design',
                'deliverables' => 'Modernisert plattform, ny design, forbedret ytelse',
                'start_date' => now()->subDays(45),
                'end_date' => now()->addDays(75),
                'actual_start_date' => now()->subDays(40),
                'estimated_hours' => 360,
                'actual_hours' => 200,
                'budget' => 450000,
                'actual_cost' => 250000,
                'hourly_rate' => 1250,
                'billable' => true,
                'progress_percentage' => 55,
                'internal_notes' => '<p>God fremdrift, backend API-er er ferdigstilt og frontend-utvikling pågår.</p>',
                'client_notes' => '<p>Fornøyd med den nye designen og ytelsen så langt.</p>',
                'milestones' => json_encode([
                    ['name' => 'Backend API ferdig', 'date' => '2025-01-10', 'completed' => true],
                    ['name' => 'Ny design implementert', 'date' => '2025-02-01', 'completed' => false],
                    ['name' => 'Testing og lansering', 'date' => '2025-03-15', 'completed' => false]
                ]),

            ],
            [
                'name' => 'Kundesupport chatbot',
                'description' => 'Utvikle AI-drevet chatbot for automatisert kundesupport og redusert supportlast.',
                'status' => 'planning',
                'priority' => 'normal',
                'contact_id' => $contacts->random()->id,
                'project_manager_id' => $employees->random()->id,
                'location' => 'Remote',
                'scope_of_work' => 'AI-chatbot med treningsdata',
                'requirements' => 'Naturlig språkforståelse, integrasjon med eksisterende systemer',
                'deliverables' => 'Chatbot, treningsdata, integrasjon, dokumentasjon',
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(120),
                'estimated_hours' => 280,
                'budget' => 350000,
                'hourly_rate' => 1300,
                'billable' => true,
                'progress_percentage' => 5,
                'internal_notes' => '<p>Innledende analyse av krav og teknologivurdering pågår.</p>',
                'client_notes' => '<p>Ser frem til en intelligent løsning som kan hjelpe våre kunder 24/7.</p>',
                'milestones' => json_encode([
                    ['name' => 'Kravspesifikasjon', 'date' => '2025-02-15', 'completed' => false],
                    ['name' => 'Prototype klar', 'date' => '2025-03-15', 'completed' => false],
                    ['name' => 'Trening og testing', 'date' => '2025-04-15', 'completed' => false]
                ]),

            ],
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }

        $this->command->info('Created ' . count($projects) . ' projects with realistic data.');
    }
}
