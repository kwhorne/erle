<?php

return [
    'title' => 'Min Profil',
    'heading' => 'Min Profil',
    'subheading' => 'Oppdater din personlige informasjon og kontaktdetaljer.',
    'navigation_label' => 'Min Profil',
    
    'sections' => [
        'personal_information' => [
            'title' => 'Personlig informasjon',
            'description' => 'Oppdater din personlige informasjon og kontaktdetaljer.',
        ],
        'work_information' => [
            'title' => 'Arbeidsinformasjon',
            'description' => 'Din rolle og ansettelsesdetaljer.',
        ],
        'address' => [
            'title' => 'Adresse',
            'description' => 'Din adresse og stedinformasjon.',
        ],
        'preferences' => [
            'title' => 'Innstillinger',
            'description' => 'Personaliser din opplevelse.',
        ],
        'change_password' => [
            'title' => 'Endre passord',
            'description' => 'Sørg for at du bruker et godt, tilfeldig og sikkert passord.',
        ],
        'social_media' => [
            'title' => 'Sosiale medier',
            'description' => 'Dine profiler på sosiale medier.',
        ],
    ],
    
    'fields' => [
        'avatar' => 'Profilbilde',
        'name' => 'Fullt navn',
        'email' => 'E-postadresse',
        'phone' => 'Telefonnummer',
        'birth_date' => 'Fødselsdato',
        'bio' => 'Om meg',
        'job_title' => 'Stillingstittel',
        'department' => 'Avdeling',
        'location' => 'Arbeidssted',
        'address' => 'Adresse',
        'city' => 'By',
        'postal_code' => 'Postnummer',
        'country' => 'Land',
        'linkedin_url' => 'LinkedIn-profil',
        'twitter_url' => 'Twitter-profil',
        'emergency_contact' => 'Nødkontakt',
        'locale' => 'Språk',
        'current_password' => 'Nåværende passord',
        'new_password' => 'Nytt passord',
        'confirm_password' => 'Bekreft passord',
    ],
    
    'languages' => [
        'nb' => 'Norsk',
        'en' => 'Engelsk',
    ],
    
    'actions' => [
        'save' => 'Lagre endringer',
        'cancel' => 'Avbryt',
        'update_profile' => 'Oppdater profil',
        'update_password' => 'Oppdater passord',
    ],
    
    'messages' => [
        'profile_updated' => 'Profilen din er oppdatert.',
        'password_updated' => 'Passordet ditt er oppdatert.',
        'password_match_error' => 'Passordene stemmer ikke overens.',
        'current_password_error' => 'Det nåværende passordet er ikke korrekt.',
    ],
];
