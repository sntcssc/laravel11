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

use Illuminate\Support\Facades\Auth;

class WebStudentFormController extends Controller
{
    // Step 1: Show the form for Student Personal Details
    public function showStep1()
    {
        return view('student.form.step1');
    }

    // Step 1: Handle Student Personal Details submission
    public function submitStep1(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email|max:255',
            // Add other validations as needed
        ]);

        $student = Auth::user()->student;
        $student->update($request->only(['first_name', 'last_name', 'dob', 'email']));

        // Redirect to Step 2
        return redirect()->route('student.form.step2');
    }

    // Step 2: Show the form for Student Details
    public function showStep2()
    {
        return view('student.form.step2');
    }

    // Step 2: Handle Student Details submission
    public function submitStep2(Request $request)
    {
        $request->validate([
            'self_study_hours' => 'required|numeric',
            'has_separate_study_room' => 'required|boolean',
            // Add other validations as needed
        ]);

        $studentDetail = Auth::user()->student->studentDetails()->firstOrNew([]);
        $studentDetail->update($request->only(['self_study_hours', 'has_separate_study_room']));
        
        // Redirect to Step 3
        return redirect()->route('student.form.step3');
    }

    // Step 3: Show the form for Preparation Details
    public function showStep3()
    {
        return view('student.form.step3');
    }

    // Step 3: Handle Preparation Details submission
    public function submitStep3(Request $request)
    {
        $request->validate([
            'highest_education_qualification' => 'required|string|max:255',
            'graduation_subject' => 'required|string|max:255',
            // Add other validations as needed
        ]);

        $preparationDetail = Auth::user()->student->PreparationDetails()->firstOrNew([]);
        $preparationDetail->update($request->only([
            'highest_education_qualification', 'graduation_subject'
        ]));
        
        // Redirect to Step 4
        return redirect()->route('student.form.step4');
    }

    // Step 4: Show the form for Sources Used
    public function showStep4()
    {
        return view('student.form.step4');
    }

    // Step 4: Handle Sources Used submission
    public function submitStep4(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'source_material' => 'required|string|max:255',
        ]);

        $sourceUsed = new SourcesUsed([
            'subject' => $request->subject,
            'source_material' => $request->source_material
        ]);
        Auth::user()->student->SourcesUseds()->save($sourceUsed);

        // Redirect to Step 5
        return redirect()->route('student.form.step5');
    }

    // Step 5: Show the form for CSAT Preparation Details
    public function showStep5()
    {
        return view('student.form.step5');
    }

    // Step 5: Handle CSAT Preparation Details submission
    public function submitStep5(Request $request)
    {
        $request->validate([
            'isever_failed_csat' => 'required|boolean',
            'failed_csat_count' => 'nullable|numeric',
            // Add other validations as needed
        ]);

        $csatPreparation = Auth::user()->student->CsatPreparations()->firstOrNew([]);
        $csatPreparation->update($request->only(['isever_failed_csat', 'failed_csat_count']));

        // Redirect to Step 6
        return redirect()->route('student.form.step6');
    }

    // Step 6: Show the form for Additional Preparation Details
    public function showStep6()
    {
        return view('student.form.step6');
    }

    // Step 6: Handle Additional Preparation Details submission
    public function submitStep6(Request $request)
    {
        $request->validate([
            'youtube_channels_followed' => 'nullable|string|max:255',
            'other_coaching_programs' => 'nullable|string|max:255',
            // Add other validations as needed
        ]);

        $additionalPreparation = new AdditionalPreparation([
            'youtube_channels_followed' => $request->youtube_channels_followed,
            'other_coaching_programs' => $request->other_coaching_programs
        ]);
        Auth::user()->student->AdditionalPreparations()->save($additionalPreparation);

        // Redirect to Step 7
        return redirect()->route('student.form.step7');
    }

    // Step 7: Show the form for Personality Detail
    public function showStep7()
    {
        return view('student.form.step7');
    }

    // Step 7: Handle Personality Detail submission
    public function submitStep7(Request $request)
    {
        $request->validate([
            'reason_for_civil_services' => 'required|string|max:500',
            'strengths_in_clearing_exams' => 'required|string|max:500',
            // Add other validations as needed
        ]);

        $personalityDetail = Auth::user()->student->PersonalityDetails()->firstOrNew([]);
        $personalityDetail->update($request->only([
            'reason_for_civil_services', 'strengths_in_clearing_exams'
        ]));
        
        // Redirect to Step 8
        return redirect()->route('student.form.step8');
    }

    // Step 8: Show the form for SFG Program Knowledge Details
    public function showStep8()
    {
        return view('student.form.step8');
    }

    // Step 8: Handle SFG Program Knowledge Details submission
    public function submitStep8(Request $request)
    {
        $request->validate([
            'key_features_of_sfg_program' => 'required|string|max:500',
            'benefits_from_prelims_analysis' => 'required|string|max:500',
            // Add other validations as needed
        ]);

        $sfgProgramKnowledge = new SfgProgramKnowledge([
            'key_features_of_sfg_program' => $request->key_features_of_sfg_program,
            'benefits_from_prelims_analysis' => $request->benefits_from_prelims_analysis
        ]);
        Auth::user()->student->SfgProgramKnowledges()->save($sfgProgramKnowledge);

        // Redirect to Preview
        return redirect()->route('student.preview');
    }

    // Preview - Show all details entered by the student
    public function preview()
    {
        $student = Auth::user()->student; // Get the authenticated student's model

        return view('student.preview', compact('student'));
    }

    // Final submission of the form
    public function submitFinal(Request $request)
    {
        // Mark the student form as submitted
        $student = Auth::user()->student;
        $student->update(['status' => 'submitted']);

        // Optionally, send confirmation email or notification

        // Redirect to a confirmation page or show success message
        return redirect()->route('student.form.step1')->with('status', 'Your form has been successfully submitted!');
    }
}
