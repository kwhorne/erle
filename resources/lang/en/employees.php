<?php

return [
    'resource' => [
        'navigation_label' => 'Employee Directory',
        'model_label' => 'Employee',
        'plural_model_label' => 'Employees',
        'navigation_group' => 'Team',
    ],

    'pages' => [
        'list' => 'Employee Directory',
        'view' => 'View Employee',
        'profile' => 'Profile',
    ],
    
    'sections' => [
        'personal_info' => [
            'title' => 'Personal Information',
            'description' => 'Basic information about the employee',
        ],
        'contact_info' => [
            'title' => 'Contact Information',
            'description' => 'Phone, email and address',
        ],
        'job_info' => [
            'title' => 'Job Information',
            'description' => 'Position, department and managers',
        ],
        'skills' => [
            'title' => 'Skills',
            'description' => 'Competencies and certifications',
        ],
        'emergency' => [
            'title' => 'Emergency Contact',
            'description' => 'Contact information for emergencies',
        ],
    ],
    
    'fields' => [
        'name' => 'Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'mobile' => 'Mobile',
        'address' => 'Address',
        'postal_code' => 'Postal Code',
        'city' => 'City',
        'country' => 'Country',
        'date_of_birth' => 'Date of Birth',
        'employee_id' => 'Employee ID',
        'job_title' => 'Job Title',
        'department' => 'Department',
        'manager' => 'Manager',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'salary' => 'Salary',
        'employment_type' => 'Employment Type',
        'status' => 'Status',
        'skills' => 'Skills',
        'certifications' => 'Certifications',
        'languages' => 'Languages',
        'bio' => 'Biography',
        'notes' => 'Notes',
        'avatar' => 'Profile Picture',
        'social_security_number' => 'Social Security Number',
        'emergency_contact_name' => 'Emergency Contact Name',
        'emergency_contact_phone' => 'Emergency Contact Phone',
        'emergency_contact_relation' => 'Emergency Contact Relation',
        'is_active' => 'Active',
        'is_employee' => 'Employee',
        'linkedin_url' => 'LinkedIn',
        'twitter_url' => 'Twitter',
        'github_url' => 'GitHub',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
    ],
    
    'placeholders' => [
        'name' => 'Full name...',
        'email' => 'person@example.com',
        'phone' => '+1 234 567 8900',
        'job_title' => 'Job title...',
        'department' => 'Department...',
        'bio' => 'Brief description of the employee...',
        'skills' => 'React, Laravel, PHP, etc.',
        'certifications' => 'AWS, Azure, etc.',
        'languages' => 'Norwegian, English, etc.',
        'notes' => 'Internal notes...',
        'search' => 'Search employees...',
    ],
    
    'departments' => [
        'development' => 'Development',
        'design' => 'Design',
        'marketing' => 'Marketing',
        'sales' => 'Sales',
        'support' => 'Support',
        'hr' => 'HR',
        'finance' => 'Finance',
        'management' => 'Management',
        'operations' => 'Operations',
        'other' => 'Other',
    ],
    
    'employment_types' => [
        'full_time' => 'Full Time',
        'part_time' => 'Part Time',
        'contract' => 'Contract',
        'intern' => 'Intern',
        'consultant' => 'Consultant',
        'freelancer' => 'Freelancer',
        'temporary' => 'Temporary',
    ],
    
    'statuses' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'on_leave' => 'On Leave',
        'terminated' => 'Terminated',
    ],
    
    'relations' => [
        'spouse' => 'Spouse',
        'parent' => 'Parent',
        'sibling' => 'Sibling',
        'child' => 'Child',
        'friend' => 'Friend',
        'other' => 'Other',
    ],
    
    'table' => [
        'columns' => [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'job_title' => 'Job Title',
            'department' => 'Department',
            'manager' => 'Manager',
            'start_date' => 'Start Date',
            'status' => 'Status',
            'employment_type' => 'Employment Type',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ],
        'filters' => [
            'department' => 'Department',
            'employment_type' => 'Employment Type',
            'status' => 'Status',
            'manager' => 'Manager',
            'start_date' => 'Start Date',
        ],
        'actions' => [
            'view' => 'View',
            'edit' => 'Edit',
            'contact' => 'Contact',
        ],
    ],
    
    'messages' => [
        'profile_updated' => 'Profile updated successfully',
        'employee_created' => 'Employee created successfully',
        'employee_updated' => 'Employee updated successfully',
        'employee_deactivated' => 'Employee deactivated successfully',
        'invalid_email' => 'Invalid email address',
        'duplicate_email' => 'An employee with this email already exists',
        'required_fields' => 'Please fill in all required fields',
        'access_denied' => 'Access denied to this information',
        'not_found' => 'Employee not found',
    ],
    
    'cards' => [
        'total_employees' => 'Total Employees',
        'active_employees' => 'Active Employees',
        'new_this_month' => 'New This Month',
        'departments' => 'Departments',
    ],
];
