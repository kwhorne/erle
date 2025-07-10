<?php

return [
    'title' => 'My Profile',
    'heading' => 'My Profile',
    'subheading' => 'Update your personal information and contact details.',
    'navigation_label' => 'My Profile',
    
    'sections' => [
        'personal_information' => [
            'title' => 'Personal Information',
            'description' => 'Update your personal information and contact details.',
        ],
        'work_information' => [
            'title' => 'Work Information',
            'description' => 'Your role and employment details.',
        ],
        'address' => [
            'title' => 'Address',
            'description' => 'Your address and location information.',
        ],
        'preferences' => [
            'title' => 'Preferences',
            'description' => 'Personalize your experience.',
        ],
        'change_password' => [
            'title' => 'Change Password',
            'description' => 'Make sure you use a good, random and secure password.',
        ],
        'social_media' => [
            'title' => 'Social Media',
            'description' => 'Your social media profiles.',
        ],
    ],
    
    'fields' => [
        'avatar' => 'Profile Picture',
        'name' => 'Full Name',
        'email' => 'Email Address',
        'phone' => 'Phone Number',
        'birth_date' => 'Date of Birth',
        'bio' => 'About Me',
        'job_title' => 'Job Title',
        'department' => 'Department',
        'location' => 'Work Location',
        'address' => 'Address',
        'city' => 'City',
        'postal_code' => 'Postal Code',
        'country' => 'Country',
        'linkedin_url' => 'LinkedIn Profile',
        'twitter_url' => 'Twitter Profile',
        'emergency_contact' => 'Emergency Contact',
        'locale' => 'Language',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'confirm_password' => 'Confirm Password',
    ],
    
    'languages' => [
        'nb' => 'Norwegian',
        'en' => 'English',
    ],
    
    'actions' => [
        'save' => 'Save Changes',
        'cancel' => 'Cancel',
        'update_profile' => 'Update Profile',
        'update_password' => 'Update Password',
    ],
    
    'messages' => [
        'profile_updated' => 'Your profile has been updated.',
        'password_updated' => 'Your password has been updated.',
        'password_match_error' => 'The passwords do not match.',
        'current_password_error' => 'The current password is incorrect.',
    ],
];
