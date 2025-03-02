@extends('deepseek.reports.layouts.app')
@push('styles')
<style>
    .modal-body table td {
        word-break: break-word;
    }

    .modal-body table th {
        background-color: #f8f9fa;
        vertical-align: middle;
    }

    .modal-body table tr:nth-child(even) {
        background-color: #fcfcfc;
    }
</style>
@endpush
@section('content')
<div class="container">
    <h2 class="my-4">Student Response Report</h2>
    
    <div class="row mb-4 g-3">
        <div class="col-md-5">
            <select class="form-select" id="modelSelect" aria-label="Select category">
                <option value="">Select Report Category</option>
                @foreach($models as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-5">
            <select class="form-select" id="questionSelect" disabled aria-label="Select question">
                <option value="">Select a question</option>
            </select>
        </div>
    </div>

    <div id="resultsContainer"></div>
</div>

<!-- In student-reports.blade.php -->
<div id="fieldLabels" data-labels="{{ json_encode($fieldLabels) }}" style="display: none;"></div>

@push('scripts')
<script>
// Initialize field labels from PHP
const fieldLabels = JSON.parse(document.getElementById('fieldLabels').dataset.labels);
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const elements = {
        modelSelect: document.getElementById('modelSelect'),
        questionSelect: document.getElementById('questionSelect'),
        resultsContainer: document.getElementById('resultsContainer'),
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.content
    };

    if (!elements.modelSelect || !elements.questionSelect || !elements.resultsContainer || !elements.csrfToken) {
        console.error('Essential elements missing');
        return;
    }

    const handleModelChange = async () => {
        elements.questionSelect.disabled = true;
        elements.resultsContainer.innerHTML = '';
        
        const model = elements.modelSelect.value;
        if (!model) {
            elements.questionSelect.innerHTML = '<option value="">Select a question</option>';
            return;
        }

        elements.questionSelect.innerHTML = '<option value="">Loading questions...</option>';

        try {
            const response = await fetch("{{ route('get-questions') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': elements.csrfToken
                },
                body: JSON.stringify({ model })
            });

            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            
            const data = await response.json();
            
            elements.questionSelect.innerHTML = '<option value="">Select a question</option>';
            Object.entries(data.questions).forEach(([value, text]) => {
                const option = new Option(text, value);
                elements.questionSelect.add(option);
            });
            elements.questionSelect.disabled = false;

        } catch (error) {
            console.error('Error:', error);
            elements.questionSelect.innerHTML = '<option value="">Error loading questions</option>';
            setTimeout(() => {
                elements.questionSelect.innerHTML = '<option value="">Select a question</option>';
                elements.questionSelect.disabled = true;
            }, 3000);
        }
    };

    const handleQuestionChange = async () => {
        const model = elements.modelSelect.value;
        const question = elements.questionSelect.value;
        
        if (!model || !question) {
            elements.resultsContainer.innerHTML = '';
            return;
        }

        elements.resultsContainer.innerHTML = `
            <div class="text-center my-4">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="mt-2">Loading responses...</div>
            </div>
        `;

        try {
            const response = await fetch("{{ route('get-answers') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': elements.csrfToken
                },
                body: JSON.stringify({ model, question })
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.error || 'Failed to load answers');
            }

            const html = await response.text();
            elements.resultsContainer.innerHTML = html;

        } catch (error) {
            console.error('Error:', error);
            elements.resultsContainer.innerHTML = `
                <div class="alert alert-danger mt-3">
                    ${error.message || 'Error loading responses'}
                </div>
            `;
        }
    };

    elements.modelSelect.addEventListener('change', handleModelChange);
    elements.questionSelect.addEventListener('change', handleQuestionChange);


    // Add this code inside the DOMContentLoaded event listener

    // Handle view details click
    document.addEventListener('click', async (e) => {
        if (e.target.closest('.view-details')) {
            const studentId = e.target.closest('.view-details').dataset.studentId;
            const modal = new bootstrap.Modal(document.getElementById('studentDetailsModal'));
            
            try {
                // Show loading state
                document.getElementById('modalContent').innerHTML = `
                    <div class="text-center p-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p>Loading student details...</p>
                    </div>
                `;
                modal.show();

                // const response = await fetch(`{{ route('students.details', '') }}/${studentId}`);
                const response = await fetch(`/students/${studentId}/details`);
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                
                const student = await response.json();
                
                // Format the response data
                let content = `<div class="container-fluid">`;
                
                // Student Basic Info
                content += `
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> ${student.first_name} ${student.last_name}</p>
                                    <p><strong>Email:</strong> ${student.email}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Mobile:</strong> ${student.mobile_number}</p>
                                    <p><strong>Batch:</strong> ${student.batch?.name || 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                    </div>`;

                // Model Sections
                // In student-reports.blade.php
                const sections = {
                    student_details: 'Student Details',
                    preparation_details: 'Preparation Details',
                    sources_useds: 'Sources Used',
                    csat_preparations: 'CSAT Preparation',
                    additional_preparations: 'Additional Preparation',
                    personality_details: 'Personality Details',
                    sfg_program_knowledges: 'SFG Program Knowledge'
                };

                Object.entries(sections).forEach(([key, title]) => {
                    if (student[key] && student[key].length > 0) {
                        content += `
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 border-bottom pb-2">${title}</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>`;
                        
                        // Get first record (assuming 1:1 relationship)
                        const record = student[key][0];
                        
                        Object.entries(record).forEach(([field, value]) => {
                            if (!['id', 'student_id', 'created_at', 'updated_at', 'deleted_at'].includes(field)) {
                                content += `
                                    <tr>
                                        <th style="width: 40%">${getQuestionByKey(field)}</th>
                                        <td>${formatValue(value)}</td>
                                    </tr>`;
                            }
                        });
                        
                        content += `</tbody></table></div></div></div>`;
                    }
                });


                content += `</div>`;
                document.getElementById('modalContent').innerHTML = content;

            } catch (error) {
                console.error('Error:', error);
                document.getElementById('modalContent').innerHTML = `
                    <div class="alert alert-danger">
                        Error loading student details: ${error.message}
                    </div>
                `;
            }
        }
    });

    function formatValue(value) {
        if (Array.isArray(value)) {
            return `<ul class="mb-0">${
                value.map(item => `<li>${item}</li>`).join('')
            }</ul>`;
        }
        if (value === null || value === undefined) return 'N/A';
        if (typeof value === 'object') return JSON.stringify(value, null, 2);
        return value;
    }

    // function formatFieldName(field) {
    //     return field
    //         .replace(/_/g, ' ')
    //         .replace(/(^|\s)\S/g, match => match.toUpperCase());
    // }

    function formatFieldName(model, field) {
        // Try model-specific label first
        console.log(model);
        if (fieldLabels[model]?.[field]) {
            return fieldLabels[model][field];
        }
        // Fallback to general field label
        return fieldLabels['global']?.[field] || field.replace(/_/g, ' ').replace(/(^|\s)\S/g, match => match.toUpperCase());
    }
    // Get formatted model name from student_details to studentDetails
    function formatModelName(input) {
        return input.split('_').map((word, index) => {
            // Capitalize the first letter of each word except the first one
            if (index === 0) {
                return word.toLowerCase();
            }
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        }).join('');
    }

    function getQuestionByKey(key) {
    const questions = {

        "unique_id": "Student ID",

        // StudentDetail
        "self_study_hours": "How many hours do you currently spend on self-study?",
        "has_separate_study_room": "Do you have a separate study room at home?",
        "is_in_hostel": "Are you staying in the SNTCSSC hostel?",
        "is_residing_in_kolkata": "Are you residing in Kolkata?",
        "travel_time": "What is your travel time from your current address/location to SNTCSSC? (in minutes)",
        "prelims_mode": "Preferred mode for the Prelims Test:",
        "prelims_mode_reason": "Reason for choosing the preferred mode of examination",
        "mentoring_mode": "Preferred mode for Personal Mentoring Sessions:",
        "mentoring_mode_reason": "Reason for choosing the preferred mode of Personal Mentoring Sessions",
        "is_full_time_preparation": "Are you preparing for UPSC full-time or along with a job?",
        "work_schedule": "If employed, what is your current work schedule",
        "daily_preparation_hours": "If employed, how many hours do you dedicate to UPSC preparation daily?",

        // PreparationDetail
        "highest_education_qualification": "What is your highest educational qualification?",
        "graduation_subject": "What was your graduation subject?",
        "optional_subject": "What is your chosen optional subject for the UPSC exam?",
        "start_year": "When did you start preparing for the UPSC exam? (Year)",
        "has_coaching": "Have you taken coaching for the UPSC exam?",
        "coaching_institute": "If yes, from which institute did you take coaching?",
        "coaching_year": "In which year did you attend coaching?",
        "attempt_count": "How many attempts have you made so far for the UPSC exam?",
        "cleared_prelims": "Have you cleared the Prelims?",
        "cleared_prelims_year": "If yes, in which year(s) did you clear the Prelims?",
        "cleared_mains": "Have you cleared the Mains?",
        "cleared_mains_year": "If yes, in which year(s) did you clear the Mains?",
        "marks_in_attempts": "Details of marks obtained in each UPSC attempt",
        "revision_count": "How many times have you revised the basic books?",
        "strong_subjects": "Which three subjects are your strongest?",
        "challenging_subjects": "Which three subjects do you find most challenging?",
        "comfortable_prelims_subjects": "Which subjects in the Prelims syllabus do you feel most comfortable with?",
        "struggle_prelims_subjects": "Which subjects in the Prelims syllabus do you struggle with?",
        "primary_current_affairs_source": "What are your primary sources for Current Affairs?",
        "current_affairs_study_hours": "How many hours per day do you dedicate to studying Current Affairs?",
        "full_prelims_reading_completed": "Have you completed at least one full reading of the Prelims syllabus?",
        "revision_before_prelims": "Were you able to revise all subjects before the Prelims in your previous attempt?",
        "revision_time_per_day": "Did you allocate specific time for revision in your daily schedule? If yes, mention the hours.",
        "revision_method": "How do you revise your syllabus?",
        "avoid_past_mistakes": "How do you plan to avoid repeating past mistakes in your next attempt?",
        "review_pyq_frequency": "How often do you review and analyze previous years’ UPSC questions?",
        "upsc_pyq_analysis_completed": "Upsc Pyq Analysis Completed",
        "solved_practice_questions_after_each_chapter": "Do you solve practice questions after studying each chapter?",
        "note_preparation_for_pyqs": "Have you prepared notes on Theme, Micro theme, Options from the UPSC PYQs from the years 2013 to the present?",

        // SourcesUsed
        "subject": "Subject",
        "source_material": "Source Material",

        // CsatPreparation
        "isever_failed_csat": "Have you ever failed to qualify for CSAT in Prelims?",
        "failed_csat_count": "If yes, how many times?",
        "difficult_csat_section": "Which section of the CSAT do you find most difficult?",
        "took_csat_coaching": "Did you take any coaching for CSAT?",
        "mock_test_for_csat": "Did you attempt mock tests for CSAT before the Prelims?",
        "practicing_csat_every_day": "Do you practice CSAT every day?",

        // AdditionalPreparation
        "youtube_channels_followed": "Which YouTube channels do you follow for your preparation?",
        "other_coaching_programs": "Presently other than SNTCSSC are you part of any other coaching programme?",
        "coaching_name": "If yes give the coaching name",
        "coaching_program_details": "Coaching Program Details",
        "revision_before_prelims_count": "How many revisions did you complete before attempting the Prelims last year?",
        "experience_stress_anxiety": "Did you experience stress, anxiety, or nervousness while taking mock tests or the UPSC Prelims? Briefly explain.",
        "positive_takeaways_from_mock_tests": "What positive takeaways have you gained from your mock tests or the UPSC Prelims?",
        "mistakes_after_mock_tests": "What mistakes have you identified after taking mock tests or the UPSC Prelims?",
        "specific_strategy_for_tests": "Did you follow any specific strategy for mock tests or the UPSC Prelims?",
        "daily_study_hours": "How many hours do you study daily?",
        "study_schedule": "Write down your daily study schedule.",

        //  PersonalityDetail
        "reason_for_civil_services": "Why did you choose to prepare for the Civil Services?",
        "essential_values_for_topping": "In your opinion, what values and habits are essential for topping the Civil Services Examination?",
        "motivation_for_daily_effort": "What motivates you to give your best every day while preparing for this examination?",
        "strengths_in_clearing_exams": "What are your biggest strengths in relation to clearing this examination?",
        "areas_for_improvement": "In which areas of your life or personality do you think you need improvement?",
        "obstacles_to_success": "What obstacles do you foresee that might hinder you from achieving your goals?",
        "current_challenges": "What challenges are you currently facing in this attempt?",
        "overcoming_challenges_plan": "How do you plan to overcome the challenges mentioned above?",
        "strategies_for_success": "What strategies have you developed to tackle challenges and achieve your goals?",
        "major_distractions": "List the five major distractions in your life.",
        "distraction_overcoming_plan": "How do you plan to overcome these distractions?",
        "distraction_timeline": "Identify your distractions and set a timeline for overcoming them.",

        // SfgProgramKnowledge
        "key_features_of_sfg_program": "Write down the key features of the Special Focus Group (SFG) program.",
        "ways_sfg_will_help_in_exam": "List five ways in which the SFG program will help you clear your exam this year.",
        "regular_analysis_of_prelims_performance": "Do you regularly analyze your Prelims performance after every test?",
        "benefits_from_prelims_analysis": "What benefits do you gain from conducting a Prelims performance analysis?",
        "identifying_weak_areas_after_tests": "Are you identifying your weak areas after each test?",
        "working_to_eliminate_weak_areas": "How are you working to eliminate your weak areas?",
        "reading_test_explanations": "Do you thoroughly read the test explanations?",
        "taking_notes_from_explanations": "Do you take notes from the test explanations?",
        "regular_test_participation": "Are you attempting all the tests regularly?",
        "test_participation_challenges": "What are the reasons preventing you from taking tests consistently?",
        "overcoming_test_challenges": "How will you overcome these challenges to ensure regular test participation?",
        "highest_test_score": "What is your highest score so far in the tests I have conducted?",
        "lowest_test_score": "What is your lowest score so far in the tests I have conducted?",
        "average_test_score": "What is your average score across all the tests I have conducted?",
        "belief_in_clearing_prelims_this_year": "Do you believe you will clear the Prelims this year."
    };

    if (questions[key]) {
        return questions[key];
    } else {
        return "Invalid key provided.";
    }
    }


});

</script>
@endpush
@endsection