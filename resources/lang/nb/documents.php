<?php

return [
    'resource' => [
        'navigation_label' => 'Dokumenter',
        'model_label' => 'Dokument',
        'plural_model_label' => 'Dokumenter',
        'navigation_group' => 'Dokumenter',
    ],

    'pages' => [
        'list' => 'Alle dokumenter',
        'create' => 'Last opp dokument',
        'edit' => 'Rediger dokument',
        'view' => 'Se dokument',
    ],
    
    'sections' => [
        'basic_info' => [
            'title' => 'Grunnleggende informasjon',
            'description' => 'Hoveddetaljer om dokumentet',
        ],
        'categorization' => [
            'title' => 'Kategorisering',
            'description' => 'Organisering og tagger',
        ],
        'metadata' => [
            'title' => 'Metadata',
            'description' => 'Teknisk informasjon om filen',
        ],
        'access' => [
            'title' => 'Tilgang',
            'description' => 'Hvem kan se og redigere dokumentet',
        ],
    ],
    
    'fields' => [
        'title' => 'Tittel',
        'description' => 'Beskrivelse',
        'file' => 'Fil',
        'file_name' => 'Filnavn',
        'file_size' => 'Filstørrelse',
        'file_type' => 'Filtype',
        'category' => 'Kategori',
        'tags' => 'Tagger',
        'visibility' => 'Synlighet',
        'uploaded_by' => 'Lastet opp av',
        'version' => 'Versjon',
        'notes' => 'Notater',
        'project' => 'Prosjekt',
        'contact' => 'Kontakt',
        'expires_at' => 'Utløper',
        'is_confidential' => 'Konfidensiell',
        'download_count' => 'Nedlastninger',
        'created_at' => 'Opprettet',
        'updated_at' => 'Oppdatert',
    ],
    
    'placeholders' => [
        'title' => 'Skriv inn dokumenttittel...',
        'description' => 'Beskriv dokumentet...',
        'notes' => 'Skriv notater om dokumentet...',
        'tags' => 'Legg til tagger...',
        'search' => 'Søk etter dokumenter...',
    ],
    
    'categories' => [
        'contract' => 'Kontrakt',
        'invoice' => 'Faktura',
        'proposal' => 'Tilbud',
        'report' => 'Rapport',
        'presentation' => 'Presentasjon',
        'manual' => 'Manual',
        'specification' => 'Spesifikasjon',
        'legal' => 'Juridisk',
        'marketing' => 'Markedsføring',
        'hr' => 'HR',
        'finance' => 'Økonomi',
        'technical' => 'Teknisk',
        'other' => 'Annet',
    ],
    
    'visibility' => [
        'public' => 'Offentlig',
        'private' => 'Privat',
        'team' => 'Team',
        'project' => 'Prosjekt',
        'client' => 'Klient',
    ],
    
    'file_types' => [
        'pdf' => 'PDF-dokument',
        'doc' => 'Word-dokument',
        'docx' => 'Word-dokument',
        'xls' => 'Excel-ark',
        'xlsx' => 'Excel-ark',
        'ppt' => 'PowerPoint-presentasjon',
        'pptx' => 'PowerPoint-presentasjon',
        'txt' => 'Tekstfil',
        'jpg' => 'Bilde',
        'jpeg' => 'Bilde',
        'png' => 'Bilde',
        'gif' => 'Bilde',
        'zip' => 'Zip-arkiv',
        'rar' => 'RAR-arkiv',
    ],
    
    'table' => [
        'columns' => [
            'title' => 'Tittel',
            'file_name' => 'Filnavn',
            'file_size' => 'Størrelse',
            'file_type' => 'Type',
            'category' => 'Kategori',
            'uploaded_by' => 'Lastet opp av',
            'visibility' => 'Synlighet',
            'download_count' => 'Nedlastninger',
            'created_at' => 'Opprettet',
            'updated_at' => 'Oppdatert',
        ],
        'filters' => [
            'category' => 'Kategori',
            'file_type' => 'Filtype',
            'visibility' => 'Synlighet',
            'uploaded_by' => 'Lastet opp av',
            'project' => 'Prosjekt',
        ],
        'actions' => [
            'view' => 'Vis',
            'download' => 'Last ned',
            'edit' => 'Rediger',
            'delete' => 'Slett',
        ],
    ],
    
    'messages' => [
        'uploaded' => 'Dokument lastet opp vellykket',
        'updated' => 'Dokument oppdatert vellykket',
        'deleted' => 'Dokument slettet vellykket',
        'downloaded' => 'Dokument lastet ned',
        'file_too_large' => 'Filen er for stor',
        'invalid_file_type' => 'Ugyldig filtype',
        'upload_failed' => 'Opplasting feilet',
        'access_denied' => 'Ingen tilgang til dette dokumentet',
        'not_found' => 'Dokument ikke funnet',
        'required_fields' => 'Vennligst fyll ut alle obligatoriske felt',
    ],
];
