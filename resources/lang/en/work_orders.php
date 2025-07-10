<?php

return [
    'resource' => [
        'navigation_label' => 'Work Orders',
        'model_label' => 'Work Order',
        'plural_model_label' => 'Work Orders',
        'navigation_group' => 'CRM',
    ],

    'pages' => [
        'list' => 'All work orders',
        'create' => 'Create work order',
        'edit' => 'Edit work order',
        'view' => 'View work order',
    ],
    
    'sections' => [
        'basic_info' => [
            'title' => 'Basic Information',
            'description' => 'Main details for the work order',
        ],
        'assignment' => [
            'title' => 'Assignment',
            'description' => 'Who is responsible for this work order',
        ],
        'timeline' => [
            'title' => 'Timeline',
            'description' => 'Important dates and deadlines',
        ],
        'details' => [
            'title' => 'Details',
            'description' => 'Additional information about the work order',
        ],
    ],
    
    'fields' => [
        'title' => 'Title',
        'description' => 'Description',
        'project' => 'Project',
        'contact' => 'Contact',
        'assigned_to' => 'Assigned To',
        'priority' => 'Priority',
        'status' => 'Status',
        'due_date' => 'Due Date',
        'start_date' => 'Start Date',
        'completed_date' => 'Completed Date',
        'estimated_hours' => 'Estimated Hours',
        'actual_hours' => 'Actual Hours',
        'notes' => 'Notes',
        'tags' => 'Tags',
        'type' => 'Type',
        'category' => 'Category',
        'attachments' => 'Attachments',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
    ],
    
    'placeholders' => [
        'title' => 'Enter work order title...',
        'description' => 'Describe what needs to be done...',
        'notes' => 'Write notes about the work order...',
        'estimated_hours' => '0',
        'actual_hours' => '0',
        'tags' => 'Add tags...',
    ],
    
    'priorities' => [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'urgent' => 'Urgent',
    ],
    
    'statuses' => [
        'draft' => 'Draft',
        'open' => 'Open',
        'in_progress' => 'In Progress',
        'review' => 'Review',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'on_hold' => 'On Hold',
    ],
    
    'types' => [
        'bug_fix' => 'Bug Fix',
        'feature' => 'Feature',
        'maintenance' => 'Maintenance',
        'support' => 'Support',
        'documentation' => 'Documentation',
        'research' => 'Research',
        'other' => 'Other',
    ],
    
    'table' => [
        'columns' => [
            'title' => 'Title',
            'project' => 'Project',
            'contact' => 'Contact',
            'assigned_to' => 'Assigned To',
            'priority' => 'Priority',
            'status' => 'Status',
            'due_date' => 'Due Date',
            'estimated_hours' => 'Est. Hours',
            'actual_hours' => 'Actual Hours',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ],
        'filters' => [
            'status' => 'Status',
            'priority' => 'Priority',
            'assigned_to' => 'Assigned To',
            'project' => 'Project',
            'type' => 'Type',
        ],
        'actions' => [
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
    ],
    
    'messages' => [
        'created' => 'Work order created successfully',
        'updated' => 'Work order updated successfully',
        'deleted' => 'Work order deleted successfully',
        'assigned' => 'Work order assigned successfully',
        'status_changed' => 'Status changed successfully',
        'required_fields' => 'Please fill in all required fields',
        'invalid_date' => 'Invalid date',
        'hours_exceeded' => 'Actual hours exceed estimate',
    ],
];
