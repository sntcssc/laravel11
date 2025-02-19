<?php

// if (!function_exists('formatPreviewValue')) {
//     function formatPreviewValue($value) {
//         if (is_bool($value)) {
//             return $value ? 'Yes' : 'No';
//         }
        
//         if ($value instanceof \DateTime) {
//             return $value->format('d/m/Y');
//         }
        
//         if (is_array($value)) {
//             return implode(', ', $value);
//         }
        
//         return $value ?? 'N/A';
//     }
// }


if (!function_exists('formatPreviewValue')) {
    function formatPreviewValue($value) {
        if (is_bool($value)) {
            return $value ? 'Yes' : 'No';
        }
        
        if ($value instanceof \DateTime) {
            return $value->format('d/m/Y');
        }
        
        if (is_array($value)) {
            return implode(', ', array_filter($value));
        }
        
        if (is_null($value) || $value === '') {
            return 'Not Provided';
        }
        
        return $value;
    }
}

if (!function_exists('formatFieldName')) {
    function formatFieldName($fieldName) {
        return Str::title(str_replace(['_', '-'], ' ', $fieldName));
    }
}

if (!function_exists('getStepTitle')) {
    function getStepTitle($stepNumber) {
        $titles = [
            1 => 'Personal Information',
            2 => 'Study Environment Details',
            3 => 'Preparation Background',
            4 => 'Study Resources Used',
            5 => 'CSAT Preparation History',
            6 => 'Additional Preparation Details',
            7 => 'Personality Assessment',
            8 => 'SFG Program Knowledge'
        ];
        return $titles[$stepNumber] ?? "Step $stepNumber Details";
    }
}


if (!function_exists('getFieldLabel')) {
    function getFieldLabel($fieldName) {
        $fieldMap = [
            // Personal Information
            // 'first_name' => 'Student First Name',
            // 'last_name' => 'Student Last Name',
            // 'dob' => 'Date of Birth',
            // 'father_name' => "Father's Name",
            // 'father_occupation' => "Father's Occupation",
            // 'mother_name' => "Mother's Name",

            'unique_id' => 'Student ID',

            // Personal Information
            'first_name' => 'Student First Name',
            'last_name' => 'Student Last Name',
            'dob' => 'Date of Birth',
            'father_name' => "Father's Name",
            'father_occupation' => "Father's Occupation",
            'mother_name' => "Mother's Name",
            'mother_occupation' => "Mother's Occupation",
            'gender' => 'Gender',
            'category' => 'Category',
            'mobile_number' => 'Mobile Number',
            'whatsapp_number' => 'WhatsApp Number',
            'email' => 'Email ID',
            'password' => 'Password',
            'present_state' => 'Present State',
            'present_district' => 'Present District',
            'present_address' => 'Present Address',
            'present_pin' => 'Present Pin',
            'permanent_state' => 'Permanent State',
            'permanent_district' => 'Permanent District',
            'permanent_address' => 'Permanent Address',
            'permanent_pin' => 'Permanent Pin',
            'photo' => 'Student Photo',
            
            // Study Environment
            // 'self_study_hours' => 'Daily Self-Study Hours',
            // 'has_separate_study_room' => 'Dedicated Study Room',
            // 'travel_time' => 'Daily Commute Time (minutes)',
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
            
            // Preparation Details
            // 'highest_education_qualification' => 'Highest Educational Qualification',
            // 'attempt_count' => 'Total Exam Attempts',

            'highest_education_qualification' => 'What is your highest educational qualification?',
            'graduation_subject' => 'What was your graduation subject?',
            'optional_subject' => 'What is your chosen optional subject for the UPSC exam?',
            'start_year' => 'When did you start preparing for the UPSC exam? (Year)',
            'has_coaching' => 'Have you taken coaching for the UPSC exam?',
            'coaching_institute' => 'If yes, from which institute did you take coaching?',
            'coaching_year' => 'In which year did you attend coaching?',
            'attempt_count' => 'How many attempts have you made so far for the UPSC exam?',
            'cleared_prelims' => 'Have you cleared the Prelims?',
            'cleared_prelims_year' => 'If yes, in which year(s) did you clear the Prelims?',
            'cleared_mains' => 'Have you cleared the Mains?',
            'cleared_mains_year' => 'If yes, in which year(s) did you clear the Mains?',
            'marks_in_attempts' => 'Details of marks obtained in each UPSC attempt',
            'revision_count' => 'How many times have you revised the basic books?',
            'strong_subjects' => 'Which three subjects are your strongest?',
            'challenging_subjects' => 'Which three subjects do you find most challenging?',
            'comfortable_prelims_subjects' => 'Which subjects in the Prelims syllabus do you feel most comfortable with?',
            'struggle_prelims_subjects' => 'Which subjects in the Prelims syllabus do you struggle with?',
            'primary_current_affairs_source' => 'What are your primary sources for Current Affairs?',
            'current_affairs_study_hours' => 'How many hours per day do you dedicate to studying Current Affairs?',
            'full_prelims_reading_completed' => 'Have you completed at least one full reading of the Prelims syllabus?',
            'revision_before_prelims' => 'Were you able to revise all subjects before the Prelims in your previous attempt?',
            'revision_time_per_day' => 'Did you allocate specific time for revision in your daily schedule? If yes, mention the hours.',
            'revision_method' => 'How do you revise your syllabus?',
            'avoid_past_mistakes' => 'How do you plan to avoid repeating past mistakes in your next attempt?',
            'review_pyq_frequency' => 'How often do you review and analyze previous years’ UPSC questions?',
            'solved_practice_questions_after_each_chapter' => 'Do you solve practice questions after studying each chapter?',
            'note_preparation_for_pyqs' => 'Have you prepared notes on Theme, Micro theme, Options from the UPSC PYQs from the years 2013 to the present?',
        
            
            // Add more mappings as needed

            // CSAT Preparation
            'isever_failed_csat' => 'Have you ever failed to qualify for CSAT in Prelims?',
            'failed_csat_count' => 'If yes, how many times?',
            'difficult_csat_section' => 'Which section of the CSAT do you find most difficult?',
            'took_csat_coaching' => 'Did you take any coaching for CSAT?',
            'mock_test_for_csat' => 'Did you attempt mock tests for CSAT before the Prelims?',
            'practicing_csat_every_day' => 'Do you practice CSAT every day?',
            
            // Additional Preparation
            'youtube_channels_followed' => 'Which YouTube channels do you follow for your preparation?',
            'other_coaching_programs' => 'Presently other than SNTCSSC are you part of any other coaching programme?',
            'coaching_name' => 'If yes give the coaching name',
            'coaching_program_details' => 'Coaching Program Details',
            'revision_before_prelims_count' => 'How many revisions did you complete before attempting the Prelims last year?',
            'experience_stress_anxiety' => 'Did you experience stress, anxiety, or nervousness while taking mock tests or the UPSC Prelims? Briefly explain.',
            'positive_takeaways_from_mock_tests' => 'What positive takeaways have you gained from your mock tests or the UPSC Prelims?',
            'mistakes_after_mock_tests' => 'What mistakes have you identified after taking mock tests or the UPSC Prelims?',
            'specific_strategy_for_tests' => 'Did you follow any specific strategy for mock tests or the UPSC Prelims?',
            'daily_study_hours' => 'How many hours do you study daily?',
            'study_schedule' => 'Write down your daily study schedule.',
            
            // Personality Details
            'reason_for_civil_services' => 'Why did you choose to prepare for the Civil Services?',
            'essential_values_for_topping' => 'In your opinion, what values and habits are essential for topping the Civil Services Examination?',
            'motivation_for_daily_effort' => 'What motivates you to give your best every day while preparing for this examination?',
            'strengths_in_clearing_exams' => 'What are your biggest strengths in relation to clearing this examination?',
            'areas_for_improvement' => 'In which areas of your life or personality do you think you need improvement?',
            'obstacles_to_success' => 'What obstacles do you foresee that might hinder you from achieving your goals?',
            'current_challenges' => 'What challenges are you currently facing in this attempt?',
            'overcoming_challenges_plan' => 'How do you plan to overcome the challenges mentioned above?',
            'strategies_for_success' => 'What strategies have you developed to tackle challenges and achieve your goals?',
            'major_distractions' => 'List the five major distractions in your life.',
            'distraction_overcoming_plan' => 'How do you plan to overcome these distractions?',
            'distraction_timeline' => 'Identify your distractions and set a timeline for overcoming them.',
            
            // SFG Program

            'key_features_of_sfg_program' => 'Write down the key features of the Special Focus Group (SFG) program.',
            'ways_sfg_will_help_in_exam' => 'List five ways in which the SFG program will help you clear your exam this year.',
            'regular_analysis_of_prelims_performance' => 'Do you regularly analyze your Prelims performance after every test?',
            'benefits_from_prelims_analysis' => 'What benefits do you gain from conducting a Prelims performance analysis?',
            'identifying_weak_areas_after_tests' => 'Are you identifying your weak areas after each test?',
            'working_to_eliminate_weak_areas' => 'How are you working to eliminate your weak areas?',
            'reading_test_explanations' => 'Do you thoroughly read the test explanations?',
            'taking_notes_from_explanations' => 'Do you take notes from the test explanations?',
            'regular_test_participation' => 'Are you attempting all the tests regularly?',
            'test_participation_challenges' => 'What are the reasons preventing you from taking tests consistently?',
            'overcoming_test_challenges' => 'How will you overcome these challenges to ensure regular test participation?',
            'highest_test_score' => 'What is your highest score so far in the tests I have conducted?',
            'lowest_test_score' => 'What is your lowest score so far in the tests I have conducted?',
            'average_test_score' => 'What is your average score across all the tests I have conducted?',
            'belief_in_clearing_prelims_this_year' => 'Do you believe you will clear the Prelims this year.',
        ];

        return $fieldMap[$fieldName] ?? Str::title(str_replace('_', ' ', $fieldName));
    }
}