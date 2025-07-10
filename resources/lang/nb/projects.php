<?php

return [
    'resource' => [
        'navigation_label' => 'Prosjekter',
        'model_label' => 'Prosjekt',
        'plural_model_label' => 'Prosjekter',
        'navigation_group' => 'CRM',
    ],

    'pages' => [
        'list' => 'Alle prosjekter',
        'create' => 'Opprett prosjekt',
        'edit' => 'Rediger prosjekt',
        'view' => 'Se prosjekt',
    ],
    
    'tabs' => [
        'basic_information' => 'Grunnleggende informasjon',
        'details' => 'Detaljer',
        'timeline' => 'Tidslinje',
        'budget' => 'Budsjett',
        'documents' => 'Dokumenter',
        'work_orders' => 'Arbeidsordre',
    ],
    
    'sections' => [
        'project_details' => [
            'title' => 'Prosjektdetaljer',
            'description' => 'Grunnleggende informasjon om prosjektet',
        ],
        'timeline' => [
            'title' => 'Tidslinje',
            'description' => 'Viktige datoer og milepæler',
        ],
        'budget' => [
            'title' => 'Budsjett',
            'description' => 'Økonomisk informasjon',
        ],
        'scope' => [
            'title' => 'Omfang',
            'description' => 'Prosjektets omfang og beskrivelse',
        ],
    ],
    
    'fields' => [
        'name' => 'Prosjektnavn',
        'description' => 'Beskrivelse',
        'client' => 'Klient',
        'manager' => 'Prosjektleder',
        'start_date' => 'Startdato',
        'end_date' => 'Sluttdato',
        'deadline' => 'Frist',
        'budget' => 'Budsjett',
        'actual_cost' => 'Faktisk kostnad',
        'status' => 'Status',
        'priority' => 'Prioritet',
        'progress' => 'Fremdrift',
        'notes' => 'Notater',
        'tags' => 'Tagger',
        'scope' => 'Omfang',
        'deliverables' => 'Leveranser',
        'risks' => 'Risikoer',
        'team_members' => 'Teammedlemmer',
        'category' => 'Kategori',
        'type' => 'Type',
        'created_at' => 'Opprettet',
        'updated_at' => 'Oppdatert',
    ],
    
    'placeholders' => [
        'name' => 'Skriv inn prosjektnavn...',
        'description' => 'Beskriv prosjektet kort...',
        'budget' => '0,00',
        'notes' => 'Skriv notater om prosjektet...',
        'scope' => 'Beskriv hva som inngår i prosjektet...',
        'deliverables' => 'List opp forventede leveranser...',
        'risks' => 'Identifiser potensielle risikoer...',
        'tags' => 'Legg til tagger...',
    ],
    
    'statuses' => [
        'draft' => 'Utkast',
        'planning' => 'Planlegging',
        'in_progress' => 'Pågår',
        'review' => 'Gjennomgang',
        'completed' => 'Fullført',
        'cancelled' => 'Avbrutt',
        'on_hold' => 'På vent',
    ],
    
    'priorities' => [
        'low' => 'Lav',
        'medium' => 'Middels',
        'high' => 'Høy',
        'critical' => 'Kritisk',
    ],
    
    'types' => [
        'web_development' => 'Webutvikling',
        'mobile_app' => 'Mobilapp',
        'design' => 'Design',
        'consulting' => 'Konsultering',
        'maintenance' => 'Vedlikehold',
        'marketing' => 'Markedsføring',
        'other' => 'Annet',
    ],
    
    'table' => [
        'columns' => [
            'name' => 'Prosjektnavn',
            'client' => 'Klient',
            'manager' => 'Prosjektleder',
            'status' => 'Status',
            'priority' => 'Prioritet',
            'progress' => 'Fremdrift',
            'budget' => 'Budsjett',
            'start_date' => 'Startdato',
            'end_date' => 'Sluttdato',
            'deadline' => 'Frist',
            'created_at' => 'Opprettet',
            'updated_at' => 'Oppdatert',
        ],
        'filters' => [
            'status' => 'Status',
            'priority' => 'Prioritet',
            'manager' => 'Prosjektleder',
            'client' => 'Klient',
            'type' => 'Type',
        ],
        'actions' => [
            'view' => 'Vis',
            'edit' => 'Rediger',
            'delete' => 'Slett',
        ],
    ],
    
    'messages' => [
        'created' => 'Prosjekt opprettet vellykket',
        'updated' => 'Prosjekt oppdatert vellykket',
        'deleted' => 'Prosjekt slettet vellykket',
        'duplicate_name' => 'Et prosjekt med dette navnet eksisterer allerede',
        'required_fields' => 'Vennligst fyll ut alle obligatoriske felt',
        'invalid_date_range' => 'Sluttdato må være etter startdato',
        'budget_exceeded' => 'Faktisk kostnad overstiger budsjett',
    ],
];
