<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use App\Models\TestSeries\StudentDetail;
use App\Models\TestSeries\PreparationDetail;
use App\Models\TestSeries\SourcesUsed;
use App\Models\TestSeries\CsatPreparation;
use App\Models\TestSeries\AdditionalPreparation;
use App\Models\TestSeries\PersonalityDetail;
use App\Models\TestSeries\SfgProgramKnowledge;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StudentRegistrationController extends Controller
{
    public function showLoginForm()
    {
        return view('web.registration.student.login');
    }

    public function verifyStudent(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|string|exists:students,unique_id',
            'dob' => 'required|date',
        ]);

        try {
            $student = Student::where('unique_id', $request->unique_id)
                ->where('dob', $request->dob)
                ->first();

            if (!$student) {
                return back()->withErrors(['error' => 'Invalid credentials']);
            }

            Session::put('student_id', $student->id);
            return redirect()->route('student.form', ['step' => 1]);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Something went wrong. Try again.']);
        }
    }

    public function showForm($step)
    {
        if ($step < 1 || $step > 8) {
            return redirect()->route('student.form', ['step' => 1]);
        }

        return view('web.registration.student.form', compact('step'));
    }

    /**
     * Store step-wise student details with validation and transaction handling
     */
    public function storeStep(Request $request, $step)
    {
        DB::beginTransaction();  // Begin transaction for step-wise data saving

        try {
            $validatedData = $this->validateStep($request, $step);
            $student = Student::where('unique_id', $request->unique_id)->firstOrFail();

            switch ($step) {
                case 1:
                    $student->update($validatedData);
                    break;
                case 2:
                    StudentDetail::updateOrCreate(
                        ['student_id' => $student->id],
                        $validatedData
                    );
                    break;
                case 3:
                    PreparationDetail::updateOrCreate(
                        ['student_id' => $student->id],
                        $validatedData
                    );
                    break;
                case 4:
                    SourcesUsed::updateOrCreate(
                        ['student_id' => $student->id],
                        $validatedData
                    );
                    break;
                case 5:
                    CsatPreparation::updateOrCreate(
                        ['student_id' => $student->id],
                        $validatedData
                    );
                    break;
                case 6:
                    AdditionalPreparation::updateOrCreate(
                        ['student_id' => $student->id],
                        $validatedData
                    );
                    break;
                case 7:
                    PersonalityDetail::updateOrCreate(
                        ['student_id' => $student->id],
                        $validatedData
                    );
                    break;
                case 8:
                    SfgProgramKnowledge::updateOrCreate(
                        ['student_id' => $student->id],
                        $validatedData
                    );
                    break;
                default:
                    return response()->json(['message' => 'Invalid step'], 400);
            }

            DB::commit();  // Commit the transaction if everything is successful

            return response()->json([
                'message' => 'Step ' . $step . ' saved successfully',
                'progress' => $this->calculateProgress($student->id)
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();  // Rollback if validation fails
            return response()->json(['message' => 'Validation Error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback in case of any other error
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Validate each step's input fields
     */
    private function validateStep(Request $request, $step)
    {
        $rules = [
            1 => [
                'unique_id' => 'required|string|max:255',
                'batch_id' => 'nullable|integer',
                'program_id' => 'nullable|integer',
                'admission_date' => 'nullable|date',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'father_name' => 'nullable|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'dob' => 'required|date',
                'gender' => 'nullable|string|max:50',
                'category' => 'nullable|string|max:100',
                'mobile_number' => 'nullable|string|max:20',
                'whatsapp_number' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'password' => 'nullable|string|max:255',
                'present_state' => 'nullable|string|max:255',
                'present_district' => 'nullable|string|max:255',
                'present_address' => 'nullable|string|max:255',
                'present_pin' => 'nullable|string|max:20',
                'permanent_state' => 'nullable|string|max:255',
                'permanent_district' => 'nullable|string|max:255',
                'permanent_address' => 'nullable|string|max:255',
                'permanent_pin' => 'nullable|string|max:20',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'status' => 'nullable|string|max:50',
                'is_update' => 'nullable|boolean',
                'login' => 'nullable|boolean',
            ],
            2 => [
                'self_study_hours' => 'nullable|integer',
                'has_separate_study_room' => 'nullable|boolean',
                'is_in_hostel' => 'nullable|boolean',
                'is_residing_in_kolkata' => 'nullable|boolean',
                'travel_time' => 'nullable|string|max:255',
                'prelims_mode' => 'nullable|string|max:100',
                'prelims_mode_reason' => 'nullable|string|max:255',
                'mentoring_mode' => 'nullable|string|max:100',
                'mentoring_mode_reason' => 'nullable|string|max:255',
                'is_full_time_preparation' => 'nullable|boolean',
                'work_schedule' => 'nullable|string|max:255',
                'daily_preparation_hours' => 'nullable|integer',
            ],
            3 => [
                'highest_education_qualification' => 'nullable|string|max:255',
                'graduation_subject' => 'nullable|string|max:255',
                'optional_subject' => 'nullable|string|max:255',
                'start_year' => 'nullable|date',
                'has_coaching' => 'nullable|boolean',
                'coaching_institute' => 'nullable|string|max:255',
                'coaching_year' => 'nullable|date',
                'attempt_count' => 'nullable|integer',
                'cleared_prelims' => 'nullable|boolean',
                'cleared_prelims_year' => 'nullable|date',
                'cleared_mains' => 'nullable|boolean',
                'cleared_mains_year' => 'nullable|date',
                'marks_in_attempts' => 'nullable|string|max:255',
                'revision_count' => 'nullable|integer',
                'strong_subjects' => 'nullable|string|max:255',
                'challenging_subjects' => 'nullable|string|max:255',
                'comfortable_prelims_subjects' => 'nullable|string|max:255',
                'struggle_prelims_subjects' => 'nullable|string|max:255',
                'primary_current_affairs_source' => 'nullable|string|max:255',
                'current_affairs_study_hours' => 'nullable|integer',
                'full_prelims_reading_completed' => 'nullable|boolean',
                'revision_before_prelims' => 'nullable|boolean',
                'revision_time_per_day' => 'nullable|integer',
                'revision_method' => 'nullable|string|max:255',
                'avoid_past_mistakes' => 'nullable|string|max:255',
                'review_pyq_frequency' => 'nullable|string|max:255',
                'solved_practice_questions_after_each_chapter' => 'nullable|string|max:255',
                'note_preparation_for_pyqs' => 'nullable|string|max:255',
            ],
            4 => [
                'subject' => 'nullable|string|max:255',
                'source_material' => 'nullable|string|max:255',
            ],
            5 => [
                'isever_failed_csat' => 'nullable|boolean',
                'failed_csat_count' => 'nullable|integer',
                'difficult_csat_section' => 'nullable|string|max:255',
                'took_csat_coaching' => 'nullable|boolean',
                'mock_test_for_csat' => 'nullable|boolean',
                'practicing_csat_every_day' => 'nullable|boolean',
            ],
            6 => [
                'youtube_channels_followed' => 'nullable|string|max:255',
                'other_coaching_programs' => 'nullable|string|max:255',
                'coaching_name' => 'nullable|string|max:255',
                'coaching_program_details' => 'nullable|string|max:255',
                'revision_before_prelims_count' => 'nullable|integer',
                'experience_stress_anxiety' => 'nullable|string|max:255',
                'positive_takeaways_from_mock_tests' => 'nullable|string|max:255',
                'mistakes_after_mock_tests' => 'nullable|string|max:255',
                'specific_strategy_for_tests' => 'nullable|string|max:255',
                'daily_study_hours' => 'nullable|integer',
                'study_schedule' => 'nullable|string|max:255',
            ],
            7 => [
                'reason_for_civil_services' => 'nullable|string|max:255',
                'essential_values_for_topping' => 'nullable|string|max:255',
                'motivation_for_daily_effort' => 'nullable|string|max:255',
                'strengths_in_clearing_exams' => 'nullable|string|max:255',
                'areas_for_improvement' => 'nullable|string|max:255',
                'obstacles_to_success' => 'nullable|string|max:255',
                'current_challenges' => 'nullable|string|max:255',
                'overcoming_challenges_plan' => 'nullable|string|max:255',
                'strategies_for_success' => 'nullable|string|max:255',
                'major_distractions' => 'nullable|string|max:255',
                'distraction_overcoming_plan' => 'nullable|string|max:255',
                'distraction_timeline' => 'nullable|string|max:255',
            ],
            8 => [
                'key_features_of_sfg_program' => 'nullable|string|max:255',
                'ways_sfg_will_help_in_exam' => 'nullable|string|max:255',
                'regular_analysis_of_prelims_performance' => 'nullable|string|max:255',
                'benefits_from_prelims_analysis' => 'nullable|string|max:255',
                'identifying_weak_areas_after_tests' => 'nullable|string|max:255',
                'working_to_eliminate_weak_areas' => 'nullable|string|max:255',
                'reading_test_explanations' => 'nullable|string|max:255',
                'taking_notes_from_explanations' => 'nullable|string|max:255',
                'regular_test_participation' => 'nullable|boolean',
                'test_participation_challenges' => 'nullable|string|max:255',
                'overcoming_test_challenges' => 'nullable|string|max:255',
                'highest_test_score' => 'nullable|integer',
                'lowest_test_score' => 'nullable|integer',
                'average_test_score' => 'nullable|integer',
                'belief_in_clearing_prelims_this_year' => 'nullable|boolean',
            ],
        ];

        return $request->validate($rules[$step] ?? []);
    }

    /**
     * Calculate Progress Percentage
     */
    private function calculateProgress($student_id)
    {
        $totalSteps = 8;
        $completedSteps = 0;

        if (Student::where('id', $student_id)->exists()) $completedSteps++;
        if (StudentDetail::where('student_id', $student_id)->exists()) $completedSteps++;
        if (PreparationDetail::where('student_id', $student_id)->exists()) $completedSteps++;
        if (SourcesUsed::where('student_id', $student_id)->exists()) $completedSteps++;
        if (CsatPreparation::where('student_id', $student_id)->exists()) $completedSteps++;
        if (AdditionalPreparation::where('student_id', $student_id)->exists()) $completedSteps++;
        if (PersonalityDetail::where('student_id', $student_id)->exists()) $completedSteps++;
        if (SfgProgramKnowledge::where('student_id', $student_id)->exists()) $completedSteps++;

        return round(($completedSteps / $totalSteps) * 100, 2);
    }

    public function showPreview($student_id)
    {
        try {
            // Fetch the student and all associated data for preview
            $student = Student::findOrFail($student_id);
            $studentDetail = StudentDetail::where('student_id', $student_id)->first();
            $preparationDetail = PreparationDetail::where('student_id', $student_id)->first();
            $sourcesUsed = SourcesUsed::where('student_id', $student_id)->first();
            $csatPreparation = CsatPreparation::where('student_id', $student_id)->first();
            $additionalPreparation = AdditionalPreparation::where('student_id', $student_id)->first();
            $personalityDetail = PersonalityDetail::where('student_id', $student_id)->first();
            $sfgProgramKnowledge = SfgProgramKnowledge::where('student_id', $student_id)->first();
    
            // Return the preview view with all the details
            return view('web.registration.student.preview', [
                'student' => $student,
                'studentDetail' => $studentDetail,
                'preparationDetail' => $preparationDetail,
                'sourcesUsed' => $sourcesUsed,
                'csatPreparation' => $csatPreparation,
                'additionalPreparation' => $additionalPreparation,
                'personalityDetail' => $personalityDetail,
                'sfgProgramKnowledge' => $sfgProgramKnowledge,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('student.form', ['step' => 1])->withErrors(['error' => 'Error fetching preview details. Please try again.']);
        }
    }
    

    /**
     * Final Submission after agreeing to Terms & Conditions
     */
    public function finalSubmit(Request $request)
    {
        try {
            $request->validate([
                'unique_id' => 'required|exists:students,unique_id',
                'agree_terms' => 'required|accepted',
            ]);

            $student = Student::where('unique_id', $request->unique_id)->firstOrFail();

            if ($student->status === 'submitted') {
                return response()->json(['message' => 'You have already submitted the form'], 400);
            }

            $student->update(['status' => 'submitted']);

            // Generate PDF
            $pdfPath = $this->generatePDF($student->id);

            // Send confirmation email
            Mail::send('emails.student_submission', ['student' => $student, 'pdfPath' => $pdfPath], function ($message) use ($student, $pdfPath) {
                $message->to($student->email)
                    ->subject('Submission Successful')
                    ->attach(storage_path('app/public/' . $pdfPath));
            });

            return response()->json(['message' => 'Final submission successful, confirmation email sent.']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred during final submission: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Generate PDF for confirmation
     */
    private function generatePDF($student_id)
    {
        $student = Student::find($student_id);
        $pdf = Pdf::loadView('pdf.student_submission', compact('student'));
        $filePath = 'student_submissions/' . $student_id . '_submission.pdf';
        Storage::put($filePath, $pdf->output());
        return $filePath;
    }
}
