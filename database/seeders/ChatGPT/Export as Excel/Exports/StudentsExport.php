<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Student::with([
                'studentDetails',
                'preparationDetails',
                'sourcesUseds',
                'csatPreparations',
                'additionalPreparations',
                'personalityDetails',
                'sfgProgramKnowledges',
            ])
            ->get();
    }

    public function headings(): array
    {
        return [
            // Student Model
            'Sl', 'ID', 'First Name', 'Last Name', 'Father Name', 'Father Occupation',
            'Mother Name', 'Mother Occupation', 'DOB', 'Gender', 'Category',
            'Mobile', 'WhatsApp', 'Email', 'Present State', 'Present District',
            'Present Address', 'Present PIN', 'Permanent State', 'Permanent District',
            'Permanent Address', 'Permanent PIN', 'Photo URL', 'Image', 'Current Step',

            // StudentDetail
            'Self Study Hours', 'Separate Study Room', 'In Hostel', 'Residing in Kolkata',
            'Travel Time (min)', 'Prelims Mode', 'Prelims Reason', 'Mentoring Mode', 'Mentoring Reason',
            'Full Time Prep', 'Work Schedule', 'Daily Prep Hours',

            // PreparationDetail
            'Highest Education', 'Graduation Subject', 'Optional Subject', 'Start Year',
            'Has Coaching', 'Coaching Institute', 'Coaching Year', 'Attempt Count',
            'Cleared Prelims', 'Cleared Prelims Year', 'Cleared Mains', 'Cleared Mains Year',
            'Marks in Attempts', 'Revision Count', 'Strong Subjects', 'Challenging Subjects',
            'Comfortable Prelims Subjects', 'Struggle Prelims Subjects', 'Current Affairs Source',
            'CA Study Hours', 'Prelims Reading Completed', 'Revision Before Prelims',
            'Revision Time/Day', 'Revision Method', 'Avoid Past Mistakes', 'PYQ Review Frequency',
            'UPSC PYQ Analysis Done', 'Solved Practice Questions', 'PYQ Notes Prepared',

            // SourcesUsed (Aggregated)
            'Study Sources',

            // CsatPreparation
            'CSAT Failed', 'CSAT Fail Count', 'Difficult CSAT Section', 'CSAT Coaching',
            'CSAT Mock Tests', 'Daily CSAT Practice',

            // AdditionalPreparation
            'YouTube Channels', 'Other Coaching', 'Coaching Name', 'Coaching Details',
            'Revisions Before Prelims', 'Stress Experience', 'Mock Test Takeaways',
            'Mock Test Mistakes', 'Test Strategy', 'Daily Study Hours', 'Study Schedule',

            // PersonalityDetail
            'Civil Services Reason', 'Essential Values', 'Daily Motivation', 'Strengths',
            'Improvement Areas', 'Obstacles', 'Current Challenges', 'Challenge Plan',
            'Success Strategies', 'Distractions', 'Distraction Plan', 'Distraction Timeline',

            // SfgProgramKnowledge
            'SFG Features', 'SFG Help', 'Prelims Analysis', 'Analysis Benefits',
            'Weak Area Identification', 'Weak Area Elimination', 'Read Test Explanations',
            'Take Notes', 'Regular Tests', 'Test Challenges', 'Overcome Test Challenges',
            'Highest Score', 'Lowest Score', 'Average Score', 'Prelims Confidence',
        ];
    }

    public function map($student): array
    {
        $details = $student->studentDetails->first();
        $prepDetails = $student->preparationDetails->first();
        $csat = $student->csatPreparations->first();
        $additional = $student->additionalPreparations->first();
        $personality = $student->personalityDetails->first();
        $sfg = $student->sfgProgramKnowledges->first();

        $sources = $student->sourcesUseds->map(function($source) {
            return "{$source->subject}: {$source->source_material}";
        })->implode("; ");

        return [
            // Student Data
            $student->id,
            $student->unique_id,
            $student->first_name,
            $student->last_name,
            $student->father_name,
            $student->father_occupation,
            $student->mother_name,
            $student->mother_occupation,
            $student->dob?->format('Y-m-d'),
            $student->gender,
            $student->category,
            $student->mobile_number,
            $student->whatsapp_number,
            $student->email,
            $student->present_state,
            $student->present_district,
            $student->present_address,
            $student->present_pin,
            $student->permanent_state,
            $student->permanent_district,
            $student->permanent_address,
            $student->permanent_pin,
            $student->photo_url,
            $student->image,
            $student->current_step,

            // Student Details
            $details->self_study_hours ?? '',
            $this->formatBoolean($details->has_separate_study_room ?? null),
            $this->formatBoolean($details->is_in_hostel ?? null),
            $this->formatBoolean($details->is_residing_in_kolkata ?? null),
            $details->travel_time ?? '',
            $details->prelims_mode ?? '',
            $details->prelims_mode_reason ?? '',
            $details->mentoring_mode ?? '',
            $details->mentoring_mode_reason ?? '',
            $this->formatBoolean($details->is_full_time_preparation ?? null),
            $details->work_schedule ?? '',
            $details->daily_preparation_hours ?? '',

            // Preparation Details
            $prepDetails->highest_education_qualification ?? '',
            $prepDetails->graduation_subject ?? '',
            $prepDetails->optional_subject ?? '',
            $prepDetails->start_year ?? '',
            $this->formatBoolean($prepDetails->has_coaching ?? null),
            $prepDetails->coaching_institute ?? '',
            $prepDetails->coaching_year ?? '',
            $prepDetails->attempt_count ?? '',
            $this->formatBoolean($prepDetails->cleared_prelims ?? null),
            $prepDetails->cleared_prelims_year ?? '',
            $this->formatBoolean($prepDetails->cleared_mains ?? null),
            $prepDetails->cleared_mains_year ?? '',
            $prepDetails->marks_in_attempts ?? '',
            $prepDetails->revision_count ?? '',
            $prepDetails->strong_subjects ?? '',
            $prepDetails->challenging_subjects ?? '',
            $prepDetails->comfortable_prelims_subjects ?? '',
            $prepDetails->struggle_prelims_subjects ?? '',
            $prepDetails->primary_current_affairs_source ?? '',
            $prepDetails->current_affairs_study_hours ?? '',
            $this->formatBoolean($prepDetails->full_prelims_reading_completed ?? null),
            $this->formatBoolean($prepDetails->revision_before_prelims ?? null),
            $prepDetails->revision_time_per_day ?? '',
            $prepDetails->revision_method ?? '',
            $prepDetails->avoid_past_mistakes ?? '',
            $prepDetails->review_pyq_frequency ?? '',
            $this->formatBoolean($prepDetails->upsc_pyq_analysis_completed ?? null),
            $this->formatBoolean($prepDetails->solved_practice_questions_after_each_chapter ?? null),
            $this->formatBoolean($prepDetails->note_preparation_for_pyqs ?? null),

            // Sources Used
            $sources,

            // CSAT Preparation
            $this->formatBoolean($csat->isever_failed_csat ?? null),
            $csat->failed_csat_count ?? '',
            $csat->difficult_csat_section ?? '',
            $this->formatBoolean($csat->took_csat_coaching ?? null),
            $this->formatBoolean($csat->mock_test_for_csat ?? null),
            $this->formatBoolean($csat->practicing_csat_every_day ?? null),

            // Additional Preparation
            $additional->youtube_channels_followed ?? '',
            $this->formatBoolean($additional->other_coaching_programs ?? null),
            $additional->coaching_name ?? '',
            $additional->coaching_program_details ?? '',
            $additional->revision_before_prelims_count ?? '',
            $this->formatBoolean($additional->experience_stress_anxiety ?? null),
            $additional->positive_takeaways_from_mock_tests ?? '',
            $additional->mistakes_after_mock_tests ?? '',
            $additional->specific_strategy_for_tests ?? '',
            $additional->daily_study_hours ?? '',
            $additional->study_schedule ?? '',

            // Personality Details
            $personality->reason_for_civil_services ?? '',
            $personality->essential_values_for_topping ?? '',
            $personality->motivation_for_daily_effort ?? '',
            $personality->strengths_in_clearing_exams ?? '',
            $personality->areas_for_improvement ?? '',
            $personality->obstacles_to_success ?? '',
            $personality->current_challenges ?? '',
            $personality->overcoming_challenges_plan ?? '',
            $personality->strategies_for_success ?? '',
            $personality->major_distractions ?? '',
            $personality->distraction_overcoming_plan ?? '',
            $personality->distraction_timeline ?? '',

            // SFG Program
            $sfg->key_features_of_sfg_program ?? '',
            $sfg->ways_sfg_will_help_in_exam ?? '',
            $this->formatBoolean($sfg->regular_analysis_of_prelims_performance ?? null),
            $sfg->benefits_from_prelims_analysis ?? '',
            $this->formatBoolean($sfg->identifying_weak_areas_after_tests ?? null),
            $this->formatBoolean($sfg->working_to_eliminate_weak_areas ?? null),
            $this->formatBoolean($sfg->reading_test_explanations ?? null),
            $this->formatBoolean($sfg->taking_notes_from_explanations ?? null),
            $this->formatBoolean($sfg->regular_test_participation ?? null),
            $sfg->test_participation_challenges ?? '',
            $sfg->overcoming_test_challenges ?? '',
            $sfg->highest_test_score ?? '',
            $sfg->lowest_test_score ?? '',
            $sfg->average_test_score ?? '',
            $sfg->belief_in_clearing_prelims_this_year ?? '',
        ];
    }

    private function formatBoolean($value): string
    {
        if ($value === null) return '';
        // return $value ? 'Yes' : 'No';
        return $value ;
    }
}