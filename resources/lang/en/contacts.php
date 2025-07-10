<?php

return [
    'resource' => [
        'navigation_label' => 'Contacts',
        'model_label' => 'Contact',
        'plural_model_label' => 'Contacts',
        'navigation_group' => 'CRM',
    ],

    'pages' => [
        'list' => 'All contacts',
        'create' => 'Create contact',
        'edit' => 'Edit contact',
        'view' => 'View contact',
    ],
    
    'tabs' => [
        'basic_information' => 'Basic Information',
        'contact_persons' => 'Contact Persons',
        'documents' => 'Documents',
    ],
    
    'sections' => [
        'crm_data' => [
            'title' => 'CRM Data',
            'description' => 'Sales and follow-up information',
        ],
    ],
    
    'fields' => [
        'organization' => 'Organization/Company',
        'address' => 'Address',
        'postal_code' => 'Postal Code',
        'city' => 'City',
        'organization_number' => 'Org. Number',
        'email' => 'Email',
        'phone' => 'Phone',
        'website' => 'Website',
        'country' => 'Country',
        'notes' => 'Notes',
        'name' => 'Name',
        'title' => 'Title/Role',
        'linkedin' => 'LinkedIn',
        'twitter' => 'Twitter/X',
        'personal_notes' => 'Personal Notes',
        'documents' => 'Documents',
        'type' => 'Type',
        'assigned_to' => 'Assigned To',
        'source' => 'Source',
        'value' => 'Value (NOK)',
        'status' => 'Status',
        'last_contact_date' => 'Last Contact',
        'next_followup_date' => 'Next Follow-up',
        'tags' => 'Tags',
        'contact_person' => 'Contact Person',
    ],
    
    'placeholders' => [
        'organization_number' => '123 456 789',
        'website' => 'https://',
        'notes' => 'Write notes about the contact, meetings, agreements etc.',
        'linkedin' => 'https://linkedin.com/in/',
        'twitter' => 'https://twitter.com/',
        'personal_notes' => 'Notes about this person...',
        'value' => '0.00',
        'tags' => 'Add tags...',
        'source' => 'Select where the contact came from',
    ],
    
    'sources' => [
        'website' => 'Website',
        'referral' => 'Referral',
        'linkedin' => 'LinkedIn',
        'facebook' => 'Facebook',
        'google' => 'Google/Search',
        'advertisement' => 'Advertisement',
        'email_campaign' => 'Email Campaign',
        'trade_show' => 'Trade Show/Exhibition',
        'networking' => 'Networking Event',
        'cold_call' => 'Cold Call',
        'existing_customer' => 'Existing Customer',
        'partner' => 'Partner',
        'media' => 'Media/Press',
        'other' => 'Other',
    ],
    
    'types' => [
        'company' => 'Company',
        'person' => 'Person',
        'organization' => 'Organization',
        'government' => 'Government',
    ],

    'statuses' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'archived' => 'Archived',
    ],
    
    'tag_suggestions' => [
        'VIP',
        'Large Customer',
        'Lead',
        'Reference',
        'Existing Customer',
        'Potential Customer',
    ],
    
    'actions' => [
        'add_contact_person' => 'Add Contact Person',
        'new_contact_person' => 'New Contact Person',
        'uploading_message' => 'Uploading documents...',
    ],
    
    'table' => [
        'columns' => [
            'type' => 'Type',
            'contact_person' => 'Contact Person',
            'organization' => 'Organization',
            'email' => 'Email',
            'phone' => 'Phone',
            'city' => 'City',
            'assigned_to' => 'Assigned To',
            'source' => 'Source',
            'value' => 'Value',
            'status' => 'Status',
            'last_contact_date' => 'Last Contact',
            'next_followup_date' => 'Next Follow-up',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ],
        'filters' => [
            'type' => 'Type',
            'status' => 'Status',
            'assigned_to' => 'Assigned To',
            'source' => 'Source',
        ],
        'actions' => [
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
    ],

    'messages' => [
        'created' => 'Contact created successfully',
        'updated' => 'Contact updated successfully',
        'deleted' => 'Contact deleted successfully',
        'duplicate_email' => 'A contact with this email address already exists',
        'required_fields' => 'Please fill in all required fields',
    ],
];
