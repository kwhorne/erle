<?php

return [
    'resource' => [
        'navigation_label' => 'Ansattekatalog',
        'model_label' => 'Ansatt',
        'plural_model_label' => 'Ansatte',
        'navigation_group' => 'Team',
    ],

    'pages' => [
        'list' => 'Ansattekatalog',
        'view' => 'Se ansatt',
        'profile' => 'Profil',
    ],
    
    'sections' => [
        'personal_info' => [
            'title' => 'Personlig informasjon',
            'description' => 'Grunnleggende informasjon om den ansatte',
        ],
        'contact_info' => [
            'title' => 'Kontaktinformasjon',
            'description' => 'Telefon, e-post og adresse',
        ],
        'job_info' => [
            'title' => 'Jobbinformasjon',
            'description' => 'Stilling, avdeling og ansvarlige',
        ],
        'skills' => [
            'title' => 'Ferdigheter',
            'description' => 'Kompetanse og sertifiseringer',
        ],
        'emergency' => [
            'title' => 'Nødkontakt',
            'description' => 'Kontaktinformasjon for nødsituasjoner',
        ],
    ],
    
    'fields' => [
        'name' => 'Navn',
        'first_name' => 'Fornavn',
        'last_name' => 'Etternavn',
        'email' => 'E-post',
        'phone' => 'Telefon',
        'mobile' => 'Mobil',
        'address' => 'Adresse',
        'postal_code' => 'Postnummer',
        'city' => 'By',
        'country' => 'Land',
        'date_of_birth' => 'Fødselsdato',
        'employee_id' => 'Ansatt-ID',
        'job_title' => 'Stillingstittel',
        'department' => 'Avdeling',
        'manager' => 'Leder',
        'start_date' => 'Startdato',
        'end_date' => 'Sluttdato',
        'salary' => 'Lønn',
        'employment_type' => 'Ansettelsestype',
        'status' => 'Status',
        'skills' => 'Ferdigheter',
        'certifications' => 'Sertifiseringer',
        'languages' => 'Språk',
        'bio' => 'Biografi',
        'notes' => 'Notater',
        'avatar' => 'Profilbilde',
        'social_security_number' => 'Personnummer',
        'emergency_contact_name' => 'Nødkontakt navn',
        'emergency_contact_phone' => 'Nødkontakt telefon',
        'emergency_contact_relation' => 'Nødkontakt relasjon',
        'is_active' => 'Aktiv',
        'is_employee' => 'Ansatt',
        'linkedin_url' => 'LinkedIn',
        'twitter_url' => 'Twitter',
        'github_url' => 'GitHub',
        'created_at' => 'Opprettet',
        'updated_at' => 'Oppdatert',
    ],
    
    'placeholders' => [
        'name' => 'Fullt navn...',
        'email' => 'person@example.com',
        'phone' => '+47 123 45 678',
        'job_title' => 'Stillingstittel...',
        'department' => 'Avdeling...',
        'bio' => 'Kort beskrivelse av den ansatte...',
        'skills' => 'React, Laravel, PHP, etc.',
        'certifications' => 'AWS, Azure, etc.',
        'languages' => 'Norsk, Engelsk, etc.',
        'notes' => 'Interne notater...',
        'search' => 'Søk etter ansatte...',
    ],
    
    'departments' => [
        'development' => 'Utvikling',
        'design' => 'Design',
        'marketing' => 'Markedsføring',
        'sales' => 'Salg',
        'support' => 'Support',
        'hr' => 'HR',
        'finance' => 'Økonomi',
        'management' => 'Ledelse',
        'operations' => 'Drift',
        'other' => 'Annet',
    ],
    
    'employment_types' => [
        'full_time' => 'Heltid',
        'part_time' => 'Deltid',
        'contract' => 'Kontrakt',
        'intern' => 'Intern',
        'consultant' => 'Konsulent',
        'freelancer' => 'Frilanser',
        'temporary' => 'Vikar',
    ],
    
    'statuses' => [
        'active' => 'Aktiv',
        'inactive' => 'Inaktiv',
        'on_leave' => 'Permisjon',
        'terminated' => 'Sluttet',
    ],
    
    'relations' => [
        'spouse' => 'Ektefelle',
        'parent' => 'Forelder',
        'sibling' => 'Søsken',
        'child' => 'Barn',
        'friend' => 'Venn',
        'other' => 'Annet',
    ],
    
    'table' => [
        'columns' => [
            'name' => 'Navn',
            'email' => 'E-post',
            'phone' => 'Telefon',
            'job_title' => 'Stilling',
            'department' => 'Avdeling',
            'manager' => 'Leder',
            'start_date' => 'Startdato',
            'status' => 'Status',
            'employment_type' => 'Ansettelsestype',
            'created_at' => 'Opprettet',
            'updated_at' => 'Oppdatert',
        ],
        'filters' => [
            'department' => 'Avdeling',
            'employment_type' => 'Ansettelsestype',
            'status' => 'Status',
            'manager' => 'Leder',
            'start_date' => 'Startdato',
        ],
        'actions' => [
            'view' => 'Vis',
            'edit' => 'Rediger',
            'contact' => 'Kontakt',
        ],
    ],
    
    'messages' => [
        'profile_updated' => 'Profil oppdatert vellykket',
        'employee_created' => 'Ansatt opprettet vellykket',
        'employee_updated' => 'Ansatt oppdatert vellykket',
        'employee_deactivated' => 'Ansatt deaktivert vellykket',
        'invalid_email' => 'Ugyldig e-postadresse',
        'duplicate_email' => 'En ansatt med denne e-posten eksisterer allerede',
        'required_fields' => 'Vennligst fyll ut alle obligatoriske felt',
        'access_denied' => 'Ingen tilgang til denne informasjonen',
        'not_found' => 'Ansatt ikke funnet',
    ],
    
    'cards' => [
        'total_employees' => 'Totalt ansatte',
        'active_employees' => 'Aktive ansatte',
        'new_this_month' => 'Nye denne måneden',
        'departments' => 'Avdelinger',
    ],
];
