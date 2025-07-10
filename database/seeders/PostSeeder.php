<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have users and categories
        $users = User::all();
        $categories = PostCategory::all();
        
        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Please run UserSeeder and PostCategorySeeder first');
            return;
        }
        
        $posts = [
            [
                'title' => 'Velkommen til det nye Erle CRM & Intranett systemet!',
                'slug' => 'velkommen-til-det-nye-erle-crm-intranett-systemet',
                'excerpt' => 'Vi er stolte av å introdusere vårt nye CRM & intranett system som vil revolusjonere hvordan vi jobber sammen.',
                'content' => '<p>Kjære team,</p><p>Det er med stor glede vi lanserer det nye Erle CRM & Intranett systemet! Dette er et stort skritt fremover for vår organisasjon.</p><h2>Hva er nytt?</h2><ul><li>Moderne dashboard med oversikt over oppgaver og leads</li><li>Integrert post-feed for interne nyheter</li><li>Bedre brukeropplevelse med mørk modus</li><li>Responsivt design for alle enheter</li></ul><p>Vi oppfordrer alle til å utforske systemet og gi tilbakemelding. Sammen kan vi gjøre dette til det beste verktøyet for vårt team!</p>',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'view_count' => 45,
                'like_count' => 12,
            ],
            [
                'title' => 'Månedens resultater overgår forventningene',
                'slug' => 'manedens-resultater-ovegar-forventningene',
                'excerpt' => 'Fantastiske nyheter! Våre salgstall for denne måneden har overgått alle forventninger.',
                'content' => '<p>Vi har grunn til å feire! Månedens salgstall viser en imponerende vekst på 25% sammenlignet med forrige måned.</p><h2>Høydepunkter:</h2><ul><li>Ny stor kunde: TechCorp - verdi 500.000 NOK</li><li>15 nye leads generert via LinkedIn</li><li>Høyeste konverteringsrate noensinne: 18%</li></ul><p>Takk til alle for den fantastiske innsatsen! 🎉</p>',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'view_count' => 67,
                'like_count' => 23,
            ],
            [
                'title' => 'Ny funksjonalitet: Dashboard-widgets',
                'slug' => 'ny-funksjonalitet-dashboard-widgets',
                'excerpt' => 'Utforsk de nye dashboard-widgets som gir deg et fugleperspektiv på dagens oppgaver.',
                'content' => '<p>Vi har lansert nye dashboard-widgets som gjør det enklere å få oversikt over din arbeidsdag!</p><h2>Nye funksjoner:</h2><ul><li>Dagens oppgaver med prioritering</li><li>Ferske leads med verdiestimat</li><li>Siste nyheter fra teamet</li><li>Personalisert velkomstmelding</li></ul><p>Widgets oppdateres automatisk og gir deg alltid den nyeste informasjonen.</p>',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'view_count' => 34,
                'like_count' => 8,
            ],
            [
                'title' => 'Tips: Slik får du mest ut av CRM-systemet',
                'slug' => 'tips-slik-far-du-mest-ut-av-crm-systemet',
                'excerpt' => 'Praktiske tips og triks for å optimalisere din bruk av det nye CRM-systemet.',
                'content' => '<p>Her er noen praktiske tips for å få mest mulig ut av vårt nye CRM-system:</p><h2>Produktivitetstips:</h2><ol><li><strong>Bruk dashbordet daglig</strong> - Start dagen med å sjekke dagens oppgaver</li><li><strong>Oppdater leads regelmessig</strong> - Hold informasjonen oppdatert for bedre oppfølging</li><li><strong>Legg til notater</strong> - Dokumenter alle kundeinteraksjoner</li><li><strong>Bruk kategorier</strong> - Organiser dine kontakter og oppgaver</li></ol><p>Trenger du hjelp? Ikke nøl med å ta kontakt med IT-teamet!</p>',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(4),
                'view_count' => 89,
                'like_count' => 15,
            ],
            [
                'title' => 'Teambuilding-dag: Resultater og refleksjoner',
                'slug' => 'teambuilding-dag-resultater-og-refleksjoner',
                'excerpt' => 'En oppsummering av vår fantastiske teambuilding-dag og hva vi lærte.',
                'content' => '<p>Vår årlige teambuilding-dag var en stor suksess! Her er noen høydepunkter:</p><h2>Aktiviteter:</h2><ul><li>Problemløsning i grupper</li><li>Kommunikasjonsøvelser</li><li>Kreative workshops</li><li>Felles middag</li></ul><h2>Lærdommer:</h2><blockquote>Sammen er vi sterkere enn hver for oss. Dagens aktiviteter viste hvor mye vi kan oppnå når vi jobber som et team.</blockquote><p>Takk til alle som deltok og bidro til en minneverdig dag!</p>',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'view_count' => 56,
                'like_count' => 19,
            ],
            [
                'title' => 'Sikkerhet først: Nye retningslinjer',
                'slug' => 'sikkerhet-forst-nye-retningslinjer',
                'excerpt' => 'Viktige oppdateringer om sikkerhet og nye retningslinjer for tilgang til systemet.',
                'content' => '<p>Vi har implementert nye sikkerhetsrutiner for å beskytte våre systemer og data:</p><h2>Nye krav:</h2><ul><li>Sterke passord med minimum 12 tegn</li><li>Tofaktor-autentisering påkrevd</li><li>Regelmessige sikkerhetskopier</li><li>Oppdaterte antivirusprogrammer</li></ul><p><strong>Viktig:</strong> Alle må oppdatere sine passord innen 7 dager.</p><p>Hvis du har spørsmål om sikkerhet, kontakt IT-avdelingen umiddelbart.</p>',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(6),
                'view_count' => 78,
                'like_count' => 6,
            ],
        ];
        
        foreach ($posts as $postData) {
            Post::create(array_merge($postData, [
                'author_id' => $users->random()->id,
                'post_category_id' => $categories->random()->id,
                'allow_comments' => true,
                'meta_tags' => ['crm', 'intranet', 'erle'],
            ]));
        }
        
        $this->command->info('Sample posts created successfully!');
    }
}
