<?php

return [
    'resource' => [
        'navigation_label' => 'Kontakter',
        'model_label' => 'Kontakt',
        'plural_model_label' => 'Kontakter',
        'navigation_group' => 'CRM',
    ],

    'pages' => [
        'list' => 'Alle kontakter',
        'create' => 'Opprett kontakt',
        'edit' => 'Rediger kontakt',
        'view' => 'Se kontakt',
    ],
    
    'tabs' => [
        'basic_information' => 'Grunnleggende informasjon',
        'contact_persons' => 'Kontaktpersoner',
        'documents' => 'Dokumenter',
    ],
    
    'sections' => [
        'crm_data' => [
            'title' => 'CRM Data',
            'description' => 'Salgs- og oppfølgingsinformasjon',
        ],
    ],
    
    'fields' => [
        'organization' => 'Organisasjon/Bedrift',
        'address' => 'Adresse',
        'postal_code' => 'Postnr.',
        'city' => 'Sted',
        'organization_number' => 'Org.Nr.',
        'email' => 'E-post',
        'phone' => 'Telefon',
        'website' => 'Nettside',
        'country' => 'Land',
        'notes' => 'Notater',
        'name' => 'Navn',
        'title' => 'Stilling/Rolle',
        'linkedin' => 'LinkedIn',
        'twitter' => 'Twitter/X',
        'personal_notes' => 'Personlige notater',
        'documents' => 'Dokumenter',
        'type' => 'Type',
        'assigned_to' => 'Ansvarlig',
        'source' => 'Kilde',
        'value' => 'Verdi (NOK)',
        'status' => 'Status',
        'last_contact_date' => 'Siste kontakt',
        'next_followup_date' => 'Neste oppfølging',
        'tags' => 'Tagger',
        'contact_person' => 'Kontaktperson',
    ],
    
    'placeholders' => [
        'organization_number' => '123 456 789',
        'website' => 'https://',
        'notes' => 'Skriv notater om kontakten, møter, avtaler etc.',
        'linkedin' => 'https://linkedin.com/in/',
        'twitter' => 'https://twitter.com/',
        'personal_notes' => 'Notater om denne personen...',
        'value' => '0,00',
        'tags' => 'Legg til tagger...',
        'source' => 'Velg hvor kontakten kom fra',
    ],
    
    'sources' => [
        'website' => 'Nettside',
        'referral' => 'Anbefaling',
        'linkedin' => 'LinkedIn',
        'facebook' => 'Facebook',
        'google' => 'Google/Søk',
        'advertisement' => 'Annonse',
        'email_campaign' => 'E-postkampanje',
        'trade_show' => 'Messe/Utstilling',
        'networking' => 'Nettverksarrangement',
        'cold_call' => 'Kald oppringning',
        'existing_customer' => 'Eksisterende kunde',
        'partner' => 'Partner',
        'media' => 'Media/Presse',
        'other' => 'Annet',
    ],
    
    'types' => [
        'company' => 'Bedrift',
        'person' => 'Person',
        'organization' => 'Organisasjon',
        'government' => 'Offentlig',
    ],

    'statuses' => [
        'active' => 'Aktiv',
        'inactive' => 'Inaktiv',
        'archived' => 'Arkivert',
    ],
    
    'tag_suggestions' => [
        'VIP',
        'Stor kunde',
        'Lead',
        'Referanse',
        'Eksisterende kunde',
        'Potensiell kunde',
    ],
    
    'actions' => [
        'add_contact_person' => 'Legg til kontaktperson',
        'new_contact_person' => 'Ny kontaktperson',
        'uploading_message' => 'Laster opp dokumenter...',
    ],
    
    'table' => [
        'columns' => [
            'type' => 'Type',
            'contact_person' => 'Kontaktperson',
            'organization' => 'Organisasjon',
            'email' => 'E-post',
            'phone' => 'Telefon',
            'city' => 'Sted',
            'assigned_to' => 'Ansvarlig',
            'source' => 'Kilde',
            'value' => 'Verdi',
            'status' => 'Status',
            'last_contact_date' => 'Siste kontakt',
            'next_followup_date' => 'Neste oppfølging',
            'created_at' => 'Opprettet',
            'updated_at' => 'Oppdatert',
        ],
        'filters' => [
            'type' => 'Type',
            'status' => 'Status',
            'assigned_to' => 'Ansvarlig',
            'source' => 'Kilde',
        ],
        'actions' => [
            'view' => 'Vis',
            'edit' => 'Rediger',
            'delete' => 'Slett',
        ],
    ],

    'messages' => [
        'created' => 'Kontakt opprettet vellykket',
        'updated' => 'Kontakt oppdatert vellykket',
        'deleted' => 'Kontakt slettet vellykket',
        'duplicate_email' => 'En kontakt med denne e-postadressen eksisterer allerede',
        'required_fields' => 'Vennligst fyll ut alle obligatoriske felt',
    ],
];
