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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class StudentController extends Controller
{
    /**
     * Show the student verification form.
     *
     * @return \Illuminate\View\View
     */
    public function showVerifyForm()
    {
        return view('web.form.verify_student');
    }

    /**
     * Handle the verification of student ID and DOB.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyStudent(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'student_id' => 'required|exists:students,unique_id',
                'dob' => 'required|date|before_or_equal:today',
            ]);

            // Find the student by ID and DOB
            $student = Student::where('unique_id', $request->student_id)
                            ->where('dob', $request->dob)
                            ->first();

            // If student is found, redirect to the next step (Step 1)
            if ($student) {
                // Store student information in the session to pass to the next steps
                Session::put('student_id', $student->id);
                return redirect()->route('personal_details_form', ['student_id' => $student->id]);
            } else {
                // If student not found, return with an error
                return back()->withErrors(['student_id' => 'Invalid Student ID or Date of Birth.']);
            }

        } catch (ModelNotFoundException $e) {
            return back()->withErrors(['student_id' => 'Student record not found.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    // Step 2: Personal Details Form
    public function showPersonalDetailsForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.personal_details', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching personal details form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save Personal Details
    public function savePersonalDetails(Request $request, $student_id)
    {
        try {
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'gender' => 'required|string',
                'email' => 'required|email',
            ]);

            $student = Student::findOrFail($student_id);
            $student->update($request->all());

            return redirect()->route('student_details_form', ['student_id' => $student_id])->with('success', 'Personal details saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving personal details: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }

    // Step 3: Student Details Form
    public function showStudentDetailsForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.student_details', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching student details form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save Student Details
    public function saveStudentDetails(Request $request, $student_id)
    {
        try {
            $request->validate([
                'self_study_hours' => 'required|integer',
                'has_separate_study_room' => 'required|boolean',
                'is_in_hostel' => 'required|boolean',
                'is_residing_in_kolkata' => 'required|boolean',
                'travel_time' => 'required|integer',
                'prelims_mode' => 'required|string',
                'mentoring_mode' => 'required|string',
                'is_full_time_preparation' => 'required|boolean',
                'work_schedule' => 'required|string',
                'daily_preparation_hours' => 'required|integer',
            ]);

            $studentDetail = new StudentDetail($request->all());
            $studentDetail->student_id = $student_id;
            $studentDetail->save();

            return redirect()->route('preparation_details_form', ['student_id' => $student_id])->with('success', 'Student details saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving student details: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }

    // Step 4: Preparation Details Form
    public function showPreparationDetailsForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.preparation_details', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching preparation details form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save Preparation Details
    public function savePreparationDetails(Request $request, $student_id)
    {
        try {
            $request->validate([
                'highest_education_qualification' => 'required|string',
                'graduation_subject' => 'required|string',
                'optional_subject' => 'required|string',
                'start_year' => 'required|integer',
                'has_coaching' => 'required|boolean',
                'coaching_institute' => 'nullable|string',
                'coaching_year' => 'nullable|integer',
                'attempt_count' => 'required|integer',
                'marks_in_attempts' => 'nullable|string',
            ]);

            $preparationDetail = new PreparationDetail($request->all());
            $preparationDetail->student_id = $student_id;
            $preparationDetail->save();

            return redirect()->route('sources_used_form', ['student_id' => $student_id])->with('success', 'Preparation details saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving preparation details: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }

    // Step 5: Sources Used Form
    public function showSourcesUsedForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.sources_used', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching sources used form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save Sources Used
    public function saveSourcesUsed(Request $request, $student_id)
    {
        try {
            $request->validate([
                'subject' => 'required|string',
                'source_material' => 'required|string',
            ]);

            $sourcesUsed = new SourcesUsed($request->all());
            $sourcesUsed->student_id = $student_id;
            $sourcesUsed->save();

            return redirect()->route('csat_preparation_form', ['student_id' => $student_id])->with('success', 'Sources used saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving sources used: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }

    // Step 6: CSAT Preparation Form
    public function showCsatPreparationForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.csat_preparation', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching CSAT preparation form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save CSAT Preparation
    public function saveCsatPreparation(Request $request, $student_id)
    {
        try {
            $request->validate([
                'isever_failed_csat' => 'required|boolean',
                'failed_csat_count' => 'required|integer',
                'difficult_csat_section' => 'required|string',
                'took_csat_coaching' => 'required|boolean',
                'mock_test_for_csat' => 'required|boolean',
                'practicing_csat_every_day' => 'required|boolean',
            ]);

            $csatPreparation = new CsatPreparation($request->all());
            $csatPreparation->student_id = $student_id;
            $csatPreparation->save();

            return redirect()->route('additional_preparation_form', ['student_id' => $student_id])->with('success', 'CSAT preparation saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving CSAT preparation: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }

    // Step 7: Additional Preparation Form
    public function showAdditionalPreparationForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.additional_preparation', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching additional preparation form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save Additional Preparation
    public function saveAdditionalPreparation(Request $request, $student_id)
    {
        try {
            $request->validate([
                'youtube_channels_followed' => 'nullable|string',
                'other_coaching_programs' => 'nullable|string',
                'coaching_name' => 'nullable|string',
                'coaching_program_details' => 'nullable|string',
                'revision_before_prelims_count' => 'required|integer',
                'experience_stress_anxiety' => 'nullable|string',
                'positive_takeaways_from_mock_tests' => 'nullable|string',
                'mistakes_after_mock_tests' => 'nullable|string',
                'specific_strategy_for_tests' => 'nullable|string',
                'daily_study_hours' => 'required|integer',
                'study_schedule' => 'nullable|string',
            ]);

            $additionalPreparation = new AdditionalPreparation($request->all());
            $additionalPreparation->student_id = $student_id;
            $additionalPreparation->save();

            return redirect()->route('personality_details_form', ['student_id' => $student_id])->with('success', 'Additional preparation saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving additional preparation: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }

    // Step 8: Personality Details Form
    public function showPersonalityDetailsForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.personality_details', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching personality details form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save Personality Details
    public function savePersonalityDetails(Request $request, $student_id)
    {
        try {
            $request->validate([
                'reason_for_civil_services' => 'required|string',
                'essential_values_for_topping' => 'required|string',
                'motivation_for_daily_effort' => 'required|string',
                'strengths_in_clearing_exams' => 'required|string',
                'areas_for_improvement' => 'required|string',
                'obstacles_to_success' => 'required|string',
                'current_challenges' => 'required|string',
                'overcoming_challenges_plan' => 'required|string',
                'strategies_for_success' => 'required|string',
                'major_distractions' => 'required|string',
                'distraction_overcoming_plan' => 'required|string',
                'distraction_timeline' => 'required|string',
            ]);

            $personalityDetail = new PersonalityDetail($request->all());
            $personalityDetail->student_id = $student_id;
            $personalityDetail->save();

            return redirect()->route('sfg_program_knowledge_form', ['student_id' => $student_id])->with('success', 'Personality details saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving personality details: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }

    // Step 9: SFG Program Knowledge Form
    public function showSfgProgramKnowledgeForm($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);
            return view('web.form.sfg_program_knowledge', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error in fetching SFG program knowledge form: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred, please try again.']);
        }
    }

    // Save SFG Program Knowledge
    public function saveSfgProgramKnowledge(Request $request, $student_id)
    {
        try {
            $request->validate([
                'key_features_of_sfg_program' => 'required|string',
                'ways_sfg_will_help_in_exam' => 'required|string',
                'advantages_of_sfg_program' => 'required|string',
                'sfg_program_additional_benefits' => 'nullable|string',
            ]);

            $sfgProgramKnowledge = new SfgProgramKnowledge($request->all());
            $sfgProgramKnowledge->student_id = $student_id;
            $sfgProgramKnowledge->save();

            return redirect()->route('final_submission', ['student_id' => $student_id])->with('success', 'SFG Program Knowledge saved successfully.');

        } catch (\Exception $e) {
            Log::error('Error in saving SFG Program Knowledge: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving details.']);
        }
    }
}
