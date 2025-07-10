<?php

return [
    'resource' => [
        'navigation_label' => 'Projects',
        'model_label' => 'Project',
        'plural_model_label' => 'Projects',
        'navigation_group' => 'CRM',
    ],

    'pages' => [
        'list' => 'All projects',
        'create' => 'Create project',
        'edit' => 'Edit project',
        'view' => 'View project',
    ],
    
    'tabs' => [
        'basic_information' => 'Basic Information',
        'details' => 'Details',
        'timeline' => 'Timeline',
        'budget' => 'Budget',
        'documents' => 'Documents',
        'work_orders' => 'Work Orders',
    ],
    
    'sections' => [
        'project_details' => [
            'title' => 'Project Details',
            'description' => 'Basic information about the project',
        ],
        'timeline' => [
            'title' => 'Timeline',
            'description' => 'Important dates and milestones',
        ],
        'budget' => [
            'title' => 'Budget',
            'description' => 'Financial information',
        ],
        'scope' => [
            'title' => 'Scope',
            'description' => 'Project scope and description',
        ],
    ],
    
    'fields' => [
        'name' => 'Project Name',
        'description' => 'Description',
        'client' => 'Client',
        'manager' => 'Project Manager',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'deadline' => 'Deadline',
        'budget' => 'Budget',
        'actual_cost' => 'Actual Cost',
        'status' => 'Status',
        'priority' => 'Priority',
        'progress' => 'Progress',
        'notes' => 'Notes',
        'tags' => 'Tags',
        'scope' => 'Scope',
        'deliverables' => 'Deliverables',
        'risks' => 'Risks',
        'team_members' => 'Team Members',
        'category' => 'Category',
        'type' => 'Type',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
    ],
    
    'placeholders' => [
        'name' => 'Enter project name...',
        'description' => 'Describe the project briefly...',
        'budget' => '0.00',
        'notes' => 'Write notes about the project...',
        'scope' => 'Describe what is included in the project...',
        'deliverables' => 'List expected deliverables...',
        'risks' => 'Identify potential risks...',
        'tags' => 'Add tags...',
    ],
    
    'statuses' => [
        'draft' => 'Draft',
        'planning' => 'Planning',
        'in_progress' => 'In Progress',
        'review' => 'Review',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'on_hold' => 'On Hold',
    ],
    
    'priorities' => [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'critical' => 'Critical',
    ],
    
    'types' => [
        'web_development' => 'Web Development',
        'mobile_app' => 'Mobile App',
        'design' => 'Design',
        'consulting' => 'Consulting',
        'maintenance' => 'Maintenance',
        'marketing' => 'Marketing',
        'other' => 'Other',
    ],
    
    'table' => [
        'columns' => [
            'name' => 'Project Name',
            'client' => 'Client',
            'manager' => 'Project Manager',
            'status' => 'Status',
            'priority' => 'Priority',
            'progress' => 'Progress',
            'budget' => 'Budget',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'deadline' => 'Deadline',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ],
        'filters' => [
            'status' => 'Status',
            'priority' => 'Priority',
            'manager' => 'Project Manager',
            'client' => 'Client',
            'type' => 'Type',
        ],
        'actions' => [
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
    ],
    
    'messages' => [
        'created' => 'Project created successfully',
        'updated' => 'Project updated successfully',
        'deleted' => 'Project deleted successfully',
        'duplicate_name' => 'A project with this name already exists',
        'required_fields' => 'Please fill in all required fields',
        'invalid_date_range' => 'End date must be after start date',
        'budget_exceeded' => 'Actual cost exceeds budget',
    ],
];
