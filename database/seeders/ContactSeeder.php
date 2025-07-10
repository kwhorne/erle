<?php

namespace Database\Seeders;

use App\ContactType;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('is_admin', true)->first();
        
        $contacts = [
            [
                'type' => ContactType::CUSTOMER,
                'name' => 'Hansen Consulting AS', // Hovedkontakt
                'organization' => 'Hansen Consulting AS',
                'organization_number' => '987654321',
                'email' => 'post@hansenconsulting.no',
                'phone' => '+47 123 45 678',
                'mobile' => '+47 987 65 432',
                'website' => 'https://hansenconsulting.no',
                'address' => 'Hovedgata 123',
                'postal_code' => '0101',
                'city' => 'Oslo',
                'country' => 'Norge',
                'source' => 'referral',
                'value' => 500000.00,
                'last_contact_date' => now()->subDays(7),
                'next_followup_date' => now()->addDays(14),
                'status' => 'active',
                'notes' => 'Viktig kunde med stort potensial. Interessert i ny nettsideløsning.',
                'tags' => ['VIP', 'Stor kunde', 'Nettside'],
                'assigned_to' => $adminUser?->id,
                'contact_persons' => [
                    [
                        'name' => 'Ole Hansen',
                        'title' => 'Daglig leder',
                        'email' => 'ole@hansenconsulting.no',
                        'phone' => '+47 901 23 456',
                        'linkedin' => 'https://linkedin.com/in/ole-hansen',
                        'twitter' => 'https://twitter.com/ole_hansen',
                        'notes' => 'Beslutningstageren. Fokusert på ROI og effektivitet. Golf-interessert.',
                    ],
                    [
                        'name' => 'Astrid Hansen',
                        'title' => 'Prosjektleder',
                        'email' => 'astrid@hansenconsulting.no',
                        'phone' => '+47 902 34 567',
                        'linkedin' => 'https://linkedin.com/in/astrid-hansen',
                        'twitter' => '',
                        'notes' => 'Ansvarlig for implementering. Teknisk bakgrunn, strukturert arbeidsmetode.',
                    ],
                ],
            ],
            [
                'type' => ContactType::POTENTIAL_CUSTOMER,
                'name' => 'Nordahl Design', // Hovedkontakt
                'organization' => 'Nordahl Design',
                'organization_number' => '123456789',
                'email' => 'post@nordahldesign.no',
                'phone' => '+47 234 56 789',
                'address' => 'Designveien 45',
                'postal_code' => '0456',
                'city' => 'Oslo',
                'country' => 'Norge',
                'source' => 'linkedin',
                'value' => 250000.00,
                'next_followup_date' => now()->addDays(3),
                'status' => 'active',
                'notes' => 'Potensiell kunde for designtjenester. Første møte booket.',
                'tags' => ['Lead', 'Design', 'Potensiell kunde'],
                'assigned_to' => $adminUser?->id,
                'contact_persons' => [
                    [
                        'name' => 'Kari Nordahl',
                        'title' => 'Kreativ direktør',
                        'email' => 'kari@nordahldesign.no',
                        'phone' => '+47 903 45 678',
                        'linkedin' => 'https://linkedin.com/in/kari-nordahl',
                        'twitter' => 'https://twitter.com/kari_design',
                        'notes' => 'Kreativ leder, interessert i innovativ design. Fokusert på brukervennlighet.',
                    ],
                ],
            ],
            [
                'type' => ContactType::SUPPLIER,
                'name' => 'Berg IT Solutions', // Hovedkontakt
                'organization' => 'Berg IT Solutions',
                'organization_number' => '456789123',
                'email' => 'post@bergit.no',
                'phone' => '+47 345 67 890',
                'mobile' => '+47 876 54 321',
                'website' => 'https://bergit.no',
                'address' => 'Teknologigata 67',
                'postal_code' => '0789',
                'city' => 'Bergen',
                'country' => 'Norge',
                'source' => 'existing_customer',
                'last_contact_date' => now()->subDays(14),
                'status' => 'active',
                'notes' => 'Pålitelig leverandør av hosting og tekniske tjenester.',
                'tags' => ['Leverandør', 'Hosting', 'Teknisk'],
                'assigned_to' => $adminUser?->id,
                'contact_persons' => [
                    [
                        'name' => 'Thomas Berg',
                        'title' => 'Teknisk leder',
                        'email' => 'thomas@bergit.no',
                        'phone' => '+47 904 56 789',
                        'linkedin' => 'https://linkedin.com/in/thomas-berg',
                        'twitter' => '',
                        'notes' => 'Teknisk ekspert. Tilgjengelig 24/7 for support. Liker å diskutere nye teknologier.',
                    ],
                    [
                        'name' => 'Marte Berg',
                        'title' => 'Kundeansvarlig',
                        'email' => 'marte@bergit.no',
                        'phone' => '+47 905 67 890',
                        'linkedin' => 'https://linkedin.com/in/marte-berg',
                        'twitter' => 'https://twitter.com/marte_berg',
                        'notes' => 'Hovedkontakt for fakturering og avtaler. Veldig serviceinnstilt.',
                    ],
                ],
            ],
            [
                'type' => ContactType::PARTNER,
                'name' => 'Andersen Marketing', // Hovedkontakt
                'organization' => 'Andersen Marketing',
                'organization_number' => '789123456',
                'email' => 'post@andersenmarketing.no',
                'phone' => '+47 456 78 901',
                'address' => 'Markedsplassen 89',
                'postal_code' => '1234',
                'city' => 'Trondheim',
                'country' => 'Norge',
                'source' => 'networking',
                'value' => 150000.00,
                'last_contact_date' => now()->subDays(21),
                'next_followup_date' => now()->addDays(7),
                'status' => 'active',
                'notes' => 'Strategisk partner for markedsføring og kampanjer.',
                'tags' => ['Partner', 'Markedsføring', 'Kampanjer'],
                'assigned_to' => $adminUser?->id,
                'contact_persons' => [
                    [
                        'name' => 'Lisa Andersen',
                        'title' => 'Markedssjef',
                        'email' => 'lisa@andersenmarketing.no',
                        'phone' => '+47 906 78 901',
                        'linkedin' => 'https://linkedin.com/in/lisa-andersen',
                        'twitter' => 'https://twitter.com/lisaandersen',
                        'notes' => 'Strategisk tenker. Ekspert på digitale kampanjer. Liker å jobbe med data-drevne løsninger.',
                    ],
                ],
            ],
            [
                'type' => ContactType::CONSULTANT,
                'name' => 'Solberg Rådgivning', // Hovedkontakt
                'organization' => 'Solberg Rådgivning',
                'organization_number' => '321654987',
                'email' => 'post@solbergraadgivning.no',
                'phone' => '+47 567 89 012',
                'mobile' => '+47 765 43 210',
                'address' => 'Rådgivergata 12',
                'postal_code' => '5678',
                'city' => 'Stavanger',
                'country' => 'Norge',
                'source' => 'existing_customer',
                'value' => 100000.00,
                'last_contact_date' => now()->subDays(35),
                'next_followup_date' => now()->subDays(1), // Trenger oppfølging!
                'status' => 'active',
                'notes' => 'Erfaren rådgiver. Kan hjelpe med forretningsutvikling.',
                'tags' => ['Konsulent', 'Forretningsutvikling', 'Erfaren'],
                'assigned_to' => $adminUser?->id,
                'contact_persons' => [
                    [
                        'name' => 'Erik Solberg',
                        'title' => 'Forretningsrådgiver',
                        'email' => 'erik@solbergraadgivning.no',
                        'phone' => '+47 907 89 012',
                        'linkedin' => 'https://linkedin.com/in/erik-solberg',
                        'twitter' => '',
                        'notes' => 'Erfaren rådgiver med 20+ års erfaring. Spesialisert på vekststrategi og organisasjonsutvikling.',
                    ],
                ],
            ],
        ];
        
        foreach ($contacts as $contactData) {
            Contact::create($contactData);
        }
    }
}
