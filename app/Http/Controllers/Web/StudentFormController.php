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

class StudentFormController extends Controller
{
    // Step 1: Show form to enter student ID and DOB
    public function showStudentForm()
    {
        return view('web.form');
    }

    // Step 1: Verify the student's details
    public function verifyStudent(Request $request)
    {
        try {
            $student = Student::where('unique_id', $request->unique_id)
                              ->where('dob', $request->dob)
                              ->first();

            if ($student) {
                return redirect()->route('form.step', ['step' => 1, 'student_id' => $student->id]);
            } else {
                return redirect()->back()->with('error', 'Student details not found or invalid');
            }
        } catch (\Exception $e) {
            Log::error("Error verifying student details: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while verifying student details. Please try again.');
        }
    }

    // Show form steps
    public function showStep($step, $student_id)
    {
        try {
            $student = Student::findOrFail($student_id);

            switch ($step) {
                case 1:
                    return view('web.student.step1', compact('student'));
                case 2:
                    return view('web.student.step2', compact('student'));
                case 3:
                    return view('web.student.step3', compact('student'));
                case 4:
                    return view('web.student.step4', compact('student'));
                case 5:
                    return view('web.student.step5', compact('student'));
                case 6:
                    return view('web.student.step6', compact('student'));
                case 7:
                    return view('web.student.step7', compact('student'));
                case 8:
                    return view('web.student.step8', compact('student'));
                default:
                    return redirect()->route('student.form');
            }
        } catch (\Exception $e) {
            Log::error("Error showing step {$step} for student {$student_id}: " . $e->getMessage());
            return redirect()->route('student.form')->with('error', 'An error occurred while loading the form step. Please try again.');
        }
    }

    // Save form data for each step
    public function saveStep(Request $request, $step, $student_id)
    {
        try {
            $student = Student::findOrFail($student_id);

            switch ($step) {
                case 1:
                    $student->update($request->only('first_name', 'last_name', 'father_name', 'mother_name'));
                    break;
                case 2:
                    $student->studentDetails()->create($request->all());
                    break;
                case 3:
                    $student->preparationDetails()->create($request->all());
                    break;
                case 4:
                    $student->sourcesUseds()->create($request->all());
                    break;
                case 5:
                    $student->csatPreparations()->create($request->all());
                    break;
                case 6:
                    $student->additionalPreparations()->create($request->all());
                    break;
                case 7:
                    $student->personalityDetails()->create($request->all());
                    break;
                case 8:
                    $student->sfgProgramKnowledges()->create($request->all());
                    break;
                default:
                    return redirect()->route('student.form');
            }

            $nextStep = $step + 1;
            if ($nextStep <= 8) {
                return redirect()->route('form.step', ['step' => $nextStep, 'student_id' => $student_id])
                                 ->with('success', 'Step completed successfully!');
            }

            return redirect()->route('student.form')->with('success', 'Form completed successfully!');
        } catch (\Exception $e) {
            Log::error("Error saving step {$step} for student {$student_id}: " . $e->getMessage());
            return back()->with('error', 'An error occurred while saving the form data. Please try again.');
        }
    }
}
