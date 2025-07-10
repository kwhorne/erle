<?php

return [
    'resource' => [
        'navigation_label' => 'Arbeidsordrer',
        'model_label' => 'Arbeidsordre',
        'plural_model_label' => 'Arbeidsordrer',
        'navigation_group' => 'CRM',
    ],

    'pages' => [
        'list' => 'Alle arbeidsordrer',
        'create' => 'Opprett arbeidsordre',
        'edit' => 'Rediger arbeidsordre',
        'view' => 'Se arbeidsordre',
    ],
    
    'sections' => [
        'basic_info' => [
            'title' => 'Grunnleggende informasjon',
            'description' => 'Hoveddetaljer for arbeidsordren',
        ],
        'assignment' => [
            'title' => 'Tildeling',
            'description' => 'Hvem er ansvarlig for denne arbeidsordren',
        ],
        'timeline' => [
            'title' => 'Tidslinje',
            'description' => 'Viktige datoer og frister',
        ],
        'details' => [
            'title' => 'Detaljer',
            'description' => 'Utfyllende informasjon om arbeidsordren',
        ],
    ],
    
    'fields' => [
        'title' => 'Tittel',
        'description' => 'Beskrivelse',
        'project' => 'Prosjekt',
        'contact' => 'Kontakt',
        'assigned_to' => 'Tildelt til',
        'priority' => 'Prioritet',
        'status' => 'Status',
        'due_date' => 'Forfallsdato',
        'start_date' => 'Startdato',
        'completed_date' => 'Fullført dato',
        'estimated_hours' => 'Estimerte timer',
        'actual_hours' => 'Faktiske timer',
        'notes' => 'Notater',
        'tags' => 'Tagger',
        'type' => 'Type',
        'category' => 'Kategori',
        'attachments' => 'Vedlegg',
        'created_at' => 'Opprettet',
        'updated_at' => 'Oppdatert',
    ],
    
    'placeholders' => [
        'title' => 'Skriv inn tittel på arbeidsordren...',
        'description' => 'Beskriv hva som skal gjøres...',
        'notes' => 'Skriv notater om arbeidsordren...',
        'estimated_hours' => '0',
        'actual_hours' => '0',
        'tags' => 'Legg til tagger...',
    ],
    
    'priorities' => [
        'low' => 'Lav',
        'medium' => 'Middels',
        'high' => 'Høy',
        'urgent' => 'Haster',
    ],
    
    'statuses' => [
        'draft' => 'Utkast',
        'open' => 'Åpen',
        'in_progress' => 'Pågår',
        'review' => 'Gjennomgang',
        'completed' => 'Fullført',
        'cancelled' => 'Avbrutt',
        'on_hold' => 'På vent',
    ],
    
    'types' => [
        'bug_fix' => 'Feilretting',
        'feature' => 'Ny funksjon',
        'maintenance' => 'Vedlikehold',
        'support' => 'Support',
        'documentation' => 'Dokumentasjon',
        'research' => 'Forskning',
        'other' => 'Annet',
    ],
    
    'table' => [
        'columns' => [
            'title' => 'Tittel',
            'project' => 'Prosjekt',
            'contact' => 'Kontakt',
            'assigned_to' => 'Tildelt til',
            'priority' => 'Prioritet',
            'status' => 'Status',
            'due_date' => 'Forfallsdato',
            'estimated_hours' => 'Est. timer',
            'actual_hours' => 'Faktiske timer',
            'created_at' => 'Opprettet',
            'updated_at' => 'Oppdatert',
        ],
        'filters' => [
            'status' => 'Status',
            'priority' => 'Prioritet',
            'assigned_to' => 'Tildelt til',
            'project' => 'Prosjekt',
            'type' => 'Type',
        ],
        'actions' => [
            'view' => 'Vis',
            'edit' => 'Rediger',
            'delete' => 'Slett',
        ],
    ],
    
    'messages' => [
        'created' => 'Arbeidsordre opprettet vellykket',
        'updated' => 'Arbeidsordre oppdatert vellykket',
        'deleted' => 'Arbeidsordre slettet vellykket',
        'assigned' => 'Arbeidsordre tildelt vellykket',
        'status_changed' => 'Status endret vellykket',
        'required_fields' => 'Vennligst fyll ut alle obligatoriske felt',
        'invalid_date' => 'Ugyldig dato',
        'hours_exceeded' => 'Faktiske timer overstiger estimat',
    ],
];
