<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\TestSeries\StudentDetail;
use App\Models\TestSeries\PreparationDetail;
use App\Models\TestSeries\SourcesUsed;
use App\Models\TestSeries\CsatPreparation;
use App\Models\TestSeries\AdditionalPreparation;
use App\Models\TestSeries\PersonalityDetail;
use App\Models\TestSeries\SfgProgramKnowledge;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;


class DeepseekFormController extends Controller
{
    protected $stepsConfig = [
        
        1 => [
            'model' => Student::class,
            'fields' => ['first_name', 'last_name', 'father_name', 'father_occupation', 
            'mother_name', 'mother_occupation', 'dob', 'gender', 'category', 'mobile_number', 
            'whatsapp_number', 'email', 'present_state', 'present_district', 'present_address', 
            'present_pin', 'permanent_state', 'permanent_district', 'permanent_address', 'permanent_pin', 'photo'],

            'validation' => [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'father_occupation' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'mother_occupation' => 'required|string|max:255',
                'dob' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'category' => 'required|string|max:255',
                'mobile_number' => 'required|digits:10',
                'whatsapp_number' => 'required|digits:10',
                'email' => 'required|email|max:255',
                'present_state' => 'required|string|max:255',
                'present_district' => 'required|string|max:255',
                'present_address' => 'required|string|max:500',
                'present_pin' => 'required|digits:6',
                'permanent_state' => 'required|string|max:255',
                'permanent_district' => 'required|string|max:255',
                'permanent_address' => 'required|string|max:500',
                'permanent_pin' => 'required|digits:6',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            'view' => 'deepseek.steps.step1'
        ],
        2 => [
            'model' => StudentDetail::class,
            'fields' => ['self_study_hours', 'has_separate_study_room', 'is_in_hostel', 
                       'is_residing_in_kolkata', 'travel_time', 'prelims_mode', 'prelims_mode_reason', 
                       'mentoring_mode', 'mentoring_mode_reason', 'is_full_time_preparation', 'work_schedule', 'daily_preparation_hours'],
                       
            'validation' => [
                'self_study_hours' => 'required|numeric|min:0|max:24',
                'has_separate_study_room' => 'required|string',
                'is_in_hostel' => 'required|string',
                'is_residing_in_kolkata' => 'required|string|max:255',
                'travel_time' => 'required|numeric|min:0',
                'prelims_mode' => 'required|string|max:255',
                'prelims_mode_reason' => 'required|string|max:255',
                'mentoring_mode' => 'required|string|max:255',
                'mentoring_mode_reason' => 'required|string|max:255',
                'is_full_time_preparation' => 'required|string|max:255',
                'work_schedule' => 'required|string|max:255',
                'daily_preparation_hours' => 'required|numeric|min:0|max:24'
            ],
            'view' => 'deepseek.steps.step2'
        ],
        3 => [
            'model' => PreparationDetail::class,
            'fields' => [
                        'highest_education_qualification', 'graduation_subject', 'optional_subject', 'start_year', 'has_coaching', 'coaching_institute', 'coaching_year', 'attempt_count', 'cleared_prelims', 'cleared_prelims_year', 'cleared_mains', 'cleared_mains_year', 'marks_in_attempts', 'revision_count', 'strong_subjects', 'challenging_subjects', 'comfortable_prelims_subjects', 'struggle_prelims_subjects', 'primary_current_affairs_source', 'current_affairs_study_hours', 'full_prelims_reading_completed', 'revision_before_prelims', 'revision_time_per_day', 'revision_method', 'avoid_past_mistakes', 'review_pyq_frequency', 'solved_practice_questions_after_each_chapter', 'note_preparation_for_pyqs'
                        ],
            'validation' => [
                'highest_education_qualification' => 'required|string|max:255',
                'graduation_subject' => 'required|string|max:255',
                'optional_subject' => 'nullable|string|max:255',
                'start_year' => 'required|integer|min:1900',
                'has_coaching' => 'required|string',
                'coaching_institute' => 'nullable|string|max:255',
                'coaching_year' => 'nullable|integer|min:1900',
                'attempt_count' => 'required|integer|min:0',
                'cleared_prelims' => 'required|string',
                'cleared_prelims_year' => 'nullable|integer|min:1900',
                'cleared_mains' => 'required|string',
                'cleared_mains_year' => 'nullable|integer|min:1900',
                'marks_in_attempts' => 'nullable|string|max:255',
                'revision_count' => 'required|integer|min:0',
                'strong_subjects' => 'nullable|string|max:255',
                'challenging_subjects' => 'nullable|string|max:255',
                'comfortable_prelims_subjects' => 'nullable|string|max:255',
                'struggle_prelims_subjects' => 'nullable|string|max:255',
                'primary_current_affairs_source' => 'nullable|string|max:255',
                'current_affairs_study_hours' => 'nullable|numeric|min:0',
                'full_prelims_reading_completed' => 'nullable|string',
                'revision_before_prelims' => 'nullable|string|min:0',
                'revision_time_per_day' => 'nullable|numeric|min:0',
                'revision_method' => 'nullable|string|max:255',
                'avoid_past_mistakes' => 'nullable|string',
                'review_pyq_frequency' => 'required|string|max:255',
                'solved_practice_questions_after_each_chapter' => 'nullable|string',
                'note_preparation_for_pyqs' => 'nullable|string|max:255'
            ],
            'view' => 'deepseek.steps.step3'
        ],
        4 => [
            'model' => SourcesUsed::class,
            'fields' => ['sources'],
            'validation' => [
                'sources.*.subject' => 'required|string|max:255',
                'sources.*.source_material' => 'required|string|max:255'
            ],
            'view' => 'deepseek.steps.step4',
            'type' => 'multiple'
        ],
        5 => [
            'model' => CsatPreparation::class,
            'fields' => ['isever_failed_csat', 'failed_csat_count', 'difficult_csat_section', 'took_csat_coaching', 
                       'mock_test_for_csat', 'practicing_csat_every_day'],
            'validation' => [
                'isever_failed_csat' => 'required|string',
                'failed_csat_count' => 'nullable|integer|min:0',
                'difficult_csat_section' => 'required|string|max:255',
                'took_csat_coaching' => 'required|string',
                'mock_test_for_csat' => 'required|string',
                'practicing_csat_every_day' => 'required|string'
            ],
            'view' => 'deepseek.steps.step5'
        ],
        6 => [
            'model' => AdditionalPreparation::class,
            'fields' => ['youtube_channels_followed', 'other_coaching_programs', 'coaching_name', 'coaching_program_details', 'revision_before_prelims_count', 'experience_stress_anxiety', 'positive_takeaways_from_mock_tests', 'mistakes_after_mock_tests', 'specific_strategy_for_tests', 'daily_study_hours', 'study_schedule'],
            'validation' => [
                'youtube_channels_followed' => 'nullable|string|max:500',
                'other_coaching_programs' => 'nullable|string|max:10',
                'coaching_name' => 'nullable|string',
                'coaching_program_details' => 'nullable|string',
                'revision_before_prelims_count' => 'required|integer',
                'experience_stress_anxiety' => 'nullable|string',
                'positive_takeaways_from_mock_tests' => 'nullable|string',
                'mistakes_after_mock_tests' => 'nullable|string',
                'specific_strategy_for_tests' => 'nullable|string',
                'daily_study_hours' => 'required|numeric|min:0|max:24',
                'study_schedule' => 'required|string|max:1000'
            ],
            'view' => 'deepseek.steps.step6'
        ],
        7 => [
            'model' => PersonalityDetail::class,
            'fields' => ['reason_for_civil_services', 'essential_values_for_topping', 'motivation_for_daily_effort', 'strengths_in_clearing_exams', 'areas_for_improvement', 'obstacles_to_success', 'current_challenges', 'overcoming_challenges_plan', 'strategies_for_success', 'major_distractions', 'distraction_overcoming_plan', 'distraction_timeline'],
            'validation' => [
                'reason_for_civil_services' => 'required|string|max:1000',
                'essential_values_for_topping' => 'nullable|string|max:1000',
                'motivation_for_daily_effort' => 'nullable|string|max:1000',
                'strengths_in_clearing_exams' => 'required|string|max:1000',
                'areas_for_improvement' => 'nullable|string|max:1000',
                'obstacles_to_success' => 'nullable|string|max:1000',
                'current_challenges' => 'nullable|string|max:1000',
                'overcoming_challenges_plan' => 'nullable|string|max:1000',
                'strategies_for_success' => 'nullable|string|max:1000',
                'major_distractions' => 'required|string|max:1000',
                'distraction_overcoming_plan' => 'required|string|max:1000',
                'distraction_timeline' => 'nullable|string|max:1000',
            ],
            'view' => 'deepseek.steps.step7'
        ],
        8 => [
            'model' => SfgProgramKnowledge::class,
            'fields' => ['key_features_of_sfg_program', 'ways_sfg_will_help_in_exam', 'regular_analysis_of_prelims_performance', 'benefits_from_prelims_analysis', 'identifying_weak_areas_after_tests', 'working_to_eliminate_weak_areas', 'reading_test_explanations', 'taking_notes_from_explanations', 'regular_test_participation', 'test_participation_challenges', 'overcoming_test_challenges', 'highest_test_score', 'lowest_test_score', 'average_test_score', 'belief_in_clearing_prelims_this_year'],
            'validation' => [
                'key_features_of_sfg_program' => 'required|string|max:1000',
                'ways_sfg_will_help_in_exam' => 'required|string|max:1000',
                'regular_analysis_of_prelims_performance' => 'nullable|string|max:1000',
                'benefits_from_prelims_analysis' => 'nullable|string|max:1000',
                'identifying_weak_areas_after_tests' => 'nullable|string|max:1000',
                'working_to_eliminate_weak_areas' => 'nullable|string|max:1000',
                'reading_test_explanations' => 'nullable|string|max:1000',
                'taking_notes_from_explanations' => 'nullable|string|max:1000',
                'regular_test_participation' => 'nullable|string|max:1000',
                'test_participation_challenges' => 'nullable|string|max:1000',
                'overcoming_test_challenges' => 'nullable|string|max:1000',
                'highest_test_score' => 'required|numeric|min:0',
                'lowest_test_score' => 'nullable|numeric|min:0',
                'average_test_score' => 'nullable|numeric|min:0',
                'belief_in_clearing_prelims_this_year' => 'required|string',
            ],
            'view' => 'deepseek.steps.step8'
        ]
    ];

    public function showVerification(Request $request)
    {
        // Clear all session data
        // $request->session()->flush();

        return view('deepseek.verification');
    }

    public function verifyStudent(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|string',
            'email' => 'required|email',
            // 'dob' => 'required|date'
        ]);

        $student = Student::where('unique_id', $request->unique_id)
            // ->where('dob', $request->dob)
            ->where('email', $request->email)
            ->first();

        if (!$student) {
            return back()->withErrors(['error' => 'Invalid Student ID or Email ID'])->withInput();
        }

        // Check if already completed
        if ($student->current_step > 8) {
            session(['verified_student' => $student->id]);
            return redirect()->route('form.complete')->with([
                'message' => 'Your Information has already been submitted.',
                'student' => $student
            ]);
        }

        session(['verified_student' => $student->id]);
        return redirect()->route('form.step', ['step' => 1]);
    }

    public function showStep($step)
    {
        $student = $this->getStudent();
    
        // Redirect if already completed
        if ($student->current_step > 8) {
            return redirect()->route('form.complete')->with([
                'message' => 'You have already submitted your application.',
                'student' => $student
            ]);
        }
        
        if ($student->current_step != $step) {
            return redirect()->route('form.step', ['step' => $student->current_step]);
        }

        return view($this->stepsConfig[$step]['view'], [
            'step' => $step,
            'progress' => $this->calculateProgress($step),
            'student' => $student
        ]);
    }

    public function submitStep(Request $request, $step)
    {
        $student = $this->getStudent();
        $config = $this->stepsConfig[$step];
        
        // dd($request->validate($config['validation']));

        try {
            DB::beginTransaction();

            $validated = $request->validate($config['validation']);
            // dd(gettype($step));

        // Handle file upload

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($student->photo) {
                Storage::delete('public/'.$student->photo);
            }

            // Generate custom filename
            $extension = $request->file('photo')->extension();
            $filename = sprintf('%s_%s_%s.%s',
                $student->unique_id,
                Str::slug($student->first_name),
                now()->format('YmdHis'),
                $extension
            );

            // Store with custom name
            $path = $request->file('photo')->storeAs(
                '', //photos
                Str::lower($filename),
                'public'
            );

            // $validated['photo'] = $path;
            $validated['image'] = $path;

            // $response = $this->updatePhoto($student->id, $path);
        }

            if ($step === "1") {

                $student->update($validated);

                // $student->update([
                //     ...$validated, // other validated fields
                //     'photo' => $path, // Ensure photo field is updated
                // ]);

            } else {
                // $model = new $config['model'];
                // $model->fill(array_merge(
                //     $validated,
                //     ['student_id' => $student->id, 'unique_id' => $student->unique_id]
                // ));
                // $model->save();

                if (isset($config['type']) && $config['type'] === 'multiple') {
                    foreach ($validated['sources'] as $sourceData) {
                        $model = new $config['model'];
                        $model->fill(array_merge(
                            $sourceData,
                            ['student_id' => $student->id, 'unique_id' => $student->unique_id]
                        ));
                        $model->save();
                    }
                } else {
                    $model = new $config['model'];
                    $model->fill(array_merge(
                        $validated,
                        ['student_id' => $student->id, 'unique_id' => $student->unique_id]
                    ));
                    $model->save();
                }
            }

            $student->current_step = $step + 1;
            $student->save();

            DB::commit();

            return $step < 8 
                ? redirect()->route('form.step', ['step' => $step + 1])
                // : redirect()->route('form.preview');
                : redirect()->route('form.submit');

        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->errors());
            return back()->withErrors(['error' => 'Submission failed: ' . $e->getMessage()])
            ->withInput();
        }
    }

    public function showPreview()
    {
        // dd($this->getStudent());
        // dd($this->getStudent()->studentDetails);
        $student = $this->getStudent()->load([
            'studentDetails', 
            'PreparationDetails',
            'SourcesUseds',
            'CsatPreparations',
            'AdditionalPreparations',
            'PersonalityDetails',
            'SfgProgramKnowledges'
        ]);

        // dd($student);

        return view('deepseek.preview', [
            'student' => $student,
            'progress' => 100
        ]);
    }

    public function finalSubmit()
    {
        $student = $this->getStudent();
        $student->update(['is_complete' => true]);
        
        // Generate PDF
        $pdfUrl = route('form.download-pdf');
        
        return redirect()->route('form.complete')
            ->with([
                'success' => 'Your submission has been completed successfully!',
                'pdf_url' => $pdfUrl
            ]);
    }

    public function downloadPdf()
    {
        // $student = $this->getStudent()->load([
        //     'studentDetails',
        //     'preparationDetails',
        //     'SourcesUseds',
        //     'CsatPreparations',
        //     'AdditionalPreparations',
        //     'PersonalityDetails',
        //     'SfgProgramKnowledges'
        // ]);

        // $pdf = PDF::loadView('deepseek.pdf.student-data', compact('student'));
        // return $pdf->download('student-application.pdf');
    $student = $this->getStudent()->load([
        'studentDetails', 
        'preparationDetails',
        'SourcesUseds',
        'CsatPreparations',
        'AdditionalPreparations',
        'PersonalityDetails',
        'SfgProgramKnowledges'
    ]);

    // Get photo data
    $photoData = null;
    if ($student->photo) {
        $path = storage_path('app/public/' . $student->photo);
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $photoData = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
    }

    $pdf = PDF::loadView('deepseek.pdf.student-data', [
        'student' => $student,
        'photoData' => $photoData
    ]);

    $filename = strtolower($student->first_name . '-' . $student->last_name . '-' . $student->unique_id) . '.pdf';

    return $pdf->download($filename);

    // return $pdf->download('student-application.pdf');
    }

    public function completion()
    {
        $student = $this->getStudent();


        if ($student->current_step < 8) {
            return redirect()->route('student.verification')->withErrors(['error' => 'You Have not submitted your form yet!!']);
        }
        
        return view('deepseek.completion', [
            'student' => $student,
            'message' => session('message', 'Your Information has already been submitted.')
        ]);
        // return view('deepseek.completion');
    }

    private function getStudent()
    {
        return Student::findOrFail(session('verified_student'));
    }

    private function calculateProgress($step)
    {
        return round(($step / 8) * 100);
    }

    public function updatePhoto($student_id, $photoPath)
    {
        // Find the student by the provided student_id
        $student = Student::findOrFail($student_id);
    
        // Check if the photo column already has a value
        if ($student->photo) {
            // Optionally, delete the old photo from storage if needed
            $oldPhotoPath = public_path('storage/' . $student->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath); // Delete the old photo
            }
        }
    
        // Update the student's photo column with the new path
        $student->image = $photoPath;
        // $student->status = $photoPath;
    
        // Save the changes
        $student->save();
    
        return response()->json(['message' => 'Photo updated successfully!'], 200);
    }
    

}
