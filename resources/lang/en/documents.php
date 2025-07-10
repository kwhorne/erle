<?php

return [
    'resource' => [
        'navigation_label' => 'Documents',
        'model_label' => 'Document',
        'plural_model_label' => 'Documents',
        'navigation_group' => 'Documents',
    ],

    'pages' => [
        'list' => 'All documents',
        'create' => 'Upload document',
        'edit' => 'Edit document',
        'view' => 'View document',
    ],
    
    'sections' => [
        'basic_info' => [
            'title' => 'Basic Information',
            'description' => 'Main details about the document',
        ],
        'categorization' => [
            'title' => 'Categorization',
            'description' => 'Organization and tags',
        ],
        'metadata' => [
            'title' => 'Metadata',
            'description' => 'Technical information about the file',
        ],
        'access' => [
            'title' => 'Access',
            'description' => 'Who can view and edit the document',
        ],
    ],
    
    'fields' => [
        'title' => 'Title',
        'description' => 'Description',
        'file' => 'File',
        'file_name' => 'File Name',
        'file_size' => 'File Size',
        'file_type' => 'File Type',
        'category' => 'Category',
        'tags' => 'Tags',
        'visibility' => 'Visibility',
        'uploaded_by' => 'Uploaded By',
        'version' => 'Version',
        'notes' => 'Notes',
        'project' => 'Project',
        'contact' => 'Contact',
        'expires_at' => 'Expires At',
        'is_confidential' => 'Confidential',
        'download_count' => 'Downloads',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
    ],
    
    'placeholders' => [
        'title' => 'Enter document title...',
        'description' => 'Describe the document...',
        'notes' => 'Write notes about the document...',
        'tags' => 'Add tags...',
        'search' => 'Search documents...',
    ],
    
    'categories' => [
        'contract' => 'Contract',
        'invoice' => 'Invoice',
        'proposal' => 'Proposal',
        'report' => 'Report',
        'presentation' => 'Presentation',
        'manual' => 'Manual',
        'specification' => 'Specification',
        'legal' => 'Legal',
        'marketing' => 'Marketing',
        'hr' => 'HR',
        'finance' => 'Finance',
        'technical' => 'Technical',
        'other' => 'Other',
    ],
    
    'visibility' => [
        'public' => 'Public',
        'private' => 'Private',
        'team' => 'Team',
        'project' => 'Project',
        'client' => 'Client',
    ],
    
    'file_types' => [
        'pdf' => 'PDF Document',
        'doc' => 'Word Document',
        'docx' => 'Word Document',
        'xls' => 'Excel Spreadsheet',
        'xlsx' => 'Excel Spreadsheet',
        'ppt' => 'PowerPoint Presentation',
        'pptx' => 'PowerPoint Presentation',
        'txt' => 'Text File',
        'jpg' => 'Image',
        'jpeg' => 'Image',
        'png' => 'Image',
        'gif' => 'Image',
        'zip' => 'Zip Archive',
        'rar' => 'RAR Archive',
    ],
    
    'table' => [
        'columns' => [
            'title' => 'Title',
            'file_name' => 'File Name',
            'file_size' => 'Size',
            'file_type' => 'Type',
            'category' => 'Category',
            'uploaded_by' => 'Uploaded By',
            'visibility' => 'Visibility',
            'download_count' => 'Downloads',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ],
        'filters' => [
            'category' => 'Category',
            'file_type' => 'File Type',
            'visibility' => 'Visibility',
            'uploaded_by' => 'Uploaded By',
            'project' => 'Project',
        ],
        'actions' => [
            'view' => 'View',
            'download' => 'Download',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
    ],
    
    'messages' => [
        'uploaded' => 'Document uploaded successfully',
        'updated' => 'Document updated successfully',
        'deleted' => 'Document deleted successfully',
        'downloaded' => 'Document downloaded',
        'file_too_large' => 'File is too large',
        'invalid_file_type' => 'Invalid file type',
        'upload_failed' => 'Upload failed',
        'access_denied' => 'Access denied to this document',
        'not_found' => 'Document not found',
        'required_fields' => 'Please fill in all required fields',
    ],
];
