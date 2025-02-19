Here is the `fieldMap` for the view `step2.blade.php` based on the form fields:

```php
$fieldMap = [
    'self_study_hours' => [
        'label' => 'How many hours do you currently spend on self-study?',
        'type' => 'number',
        'validation' => 'required|numeric|min:0|max:24',
        'extra' => 'step="0.5" min="0" max="24"'
    ],
    'has_separate_study_room' => [
        'label' => 'Do you have a separate study room at home?',
        'type' => 'select',
        'options' => [
            'yes' => 'Yes',
            'no' => 'No'
        ],
        'validation' => 'required|in:yes,no'
    ],
    'is_in_hostel' => [
        'label' => 'Are you staying in the SNTCSSC hostel?',
        'type' => 'select',
        'options' => [
            'yes' => 'Yes',
            'no' => 'No'
        ],
        'validation' => 'required|in:yes,no'
    ],
    'is_residing_in_kolkata' => [
        'label' => 'Are you residing in Kolkata?',
        'type' => 'select',
        'options' => [
            'yes' => 'Yes',
            'no' => 'No'
        ],
        'validation' => 'required|in:yes,no'
    ],
    'travel_time' => [
        'label' => 'What is your travel time from your current address/location to SNTCSSC? (in minutes)',
        'type' => 'number',
        'validation' => 'required|numeric|min:0',
        'extra' => 'step="1" min="0"'
    ],
    'prelims_mode' => [
        'label' => 'Preferred mode for the Prelims Test:',
        'type' => 'select',
        'options' => [
            'online' => 'Online',
            'offline' => 'Offline'
        ],
        'validation' => 'required|in:online,offline'
    ],
    'prelims_mode_reason' => [
        'label' => 'Reason for choosing the preferred mode of examination',
        'type' => 'textarea',
        'validation' => 'required|max:255'
    ],
    'mentoring_mode' => [
        'label' => 'Preferred mode for Personal Mentoring Sessions:',
        'type' => 'select',
        'options' => [
            'online' => 'Online',
            'offline' => 'Offline'
        ],
        'validation' => 'required|in:online,offline'
    ],
    'mentoring_mode_reason' => [
        'label' => 'Reason for choosing the preferred mode of Personal Mentoring Sessions',
        'type' => 'textarea',
        'validation' => 'required|max:255'
    ],
    'is_full_time_preparation' => [
        'label' => 'Are you preparing for UPSC full-time or along with a job?',
        'type' => 'select',
        'options' => [
            'yes' => 'Yes',
            'no' => 'No'
        ],
        'validation' => 'required|in:yes,no'
    ],
    'work_schedule' => [
        'label' => 'If employed, what is your current work schedule',
        'type' => 'select',
        'options' => [
            'part-time' => 'Part-Time',
            'full-time' => 'Full-Time',
            'flexible' => 'Flexible'
        ],
        'validation' => 'required|in:part-time,full-time,flexible'
    ],
    'daily_preparation_hours' => [
        'label' => 'If employed, how many hours do you dedicate to UPSC preparation daily?',
        'type' => 'number',
        'validation' => 'required|numeric|min:0|max:24',
        'extra' => 'step="0.5" min="0" max="24"'
    ]
];
```

This `fieldMap` array includes the form fields with their respective attributes such as `label`, `type`, `validation rules`, and `options` where applicable (for select fields). Let me know if you need further details or modifications!

=====

$fieldMap = [
    'self_study_hours' => 'How many hours do you currently spend on self-study?',
    'has_separate_study_room' => 'Do you have a separate study room at home?',
    'is_in_hostel' => 'Are you staying in the SNTCSSC hostel?',
    'is_residing_in_kolkata' => 'Are you residing in Kolkata?',
    'travel_time' => 'What is your travel time from your current address/location to SNTCSSC? (in minutes)',
    'prelims_mode' => 'Preferred mode for the Prelims Test:',
    'prelims_mode_reason' => 'Reason for choosing the preferred mode of examination',
    'mentoring_mode' => 'Preferred mode for Personal Mentoring Sessions:',
    'mentoring_mode_reason' => 'Reason for choosing the preferred mode of Personal Mentoring Sessions',
    'is_full_time_preparation' => 'Are you preparing for UPSC full-time or along with a job?',
    'work_schedule' => 'If employed, what is your current work schedule',
    'daily_preparation_hours' => 'If employed, how many hours do you dedicate to UPSC preparation daily?',
];
