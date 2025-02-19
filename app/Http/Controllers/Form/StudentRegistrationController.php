<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class StudentRegistrationController extends Controller
{
    public function showVerificationForm()
    {
        return view('form.student.verify');
    }

    public function verifyStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,unique_id',
            'dob' => 'required|date'
        ]);

        try {
            $student = Student::where('unique_id', $request->student_id)
                ->where('dob', $request->dob)
                ->first();

            if ($student) {
                // Store verified student session
                session(['verified_student' => $student->id]);

                // Store student ID in session for the next steps
                Session::put('student_id', $student->id);

                return response()->json([
                    'success' => true,
                    // 'redirect' => route('student.registration')
                    'redirect' => route('student.step1')
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid Student ID or Date of Birth.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Try again!']);
        }
    }

    public function showRegistrationForm()
    {
        return view('form.student.registration.step1');
    }

    // Step 1:
    // public function showPersonalDetails()
    // {
    //     return view('form.student.registration.step1');
    // }
    
    // public function storePersonalDetails(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'unique_id' => 'required',
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'dob' => 'required|date',
    //         'gender' => 'required',
    //         'mobile_number' => 'required',
    //     ]);
    
    //     session(['student_personal_details' => $validatedData]);
    
    //     return response()->json([
    //         'success' => true,
    //         'data' => $validatedData
    //     ]);
    // }
    
    // public function confirmPersonalDetails()
    // {
    //     $studentData = session('student_personal_details');
    //     dd($studentData);
    //     if ($studentData) {
    //         Student::create($studentData);
    //         session()->forget('student_personal_details');
    
    //         return response()->json([
    //             'success' => true,
    //             'redirect' => route('student.registration.step2')
    //         ]);
    //     }
    // }
    


    // Show Step 1 form: Personal Details
    public function showStep1Form()
    {
        return view('form.registration.step1');
    }

    // Handle confirmation of Step 1 data (save to session)
    public function confirmStep1(Request $request)
    {
        // Retrieve data from session
        $data = session('student_step1');

        // Handle file upload for photo if present
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student_photos', 'public');
            $data['photo'] = $photoPath;
        }

        // Check if the student exists by their email or student ID
        $student = Student::updateOrCreate(
            ['email' => $data['email']], // Or use student ID here
            $data
        );

        // Clear session data after saving to database
        session()->forget('student_step1');

        // Redirect to Step 2 or any appropriate page after saving
        return response()->json([
            'success' => true,
            'message' => 'Student details saved successfully!',
            'redirect_url' => route('student.step2') // Redirect to next step
        ]);
    }

    // Show the preview of Step 1 data
    public function previewStep1(Request $request)
    {
        // Validate incoming data for Step 1
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'category' => 'required|string',
            'mobile_number' => 'required|digits:10',
            'whatsapp_number' => 'nullable|digits:10',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'present_state' => 'required|string|max:255',
            'present_district' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'present_pin' => 'required|string|max:6',
            'permanent_state' => 'required|string|max:255',
            'permanent_district' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'permanent_pin' => 'required|string|max:6',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Store validated data in session
        session(['student_step1' => $validated]);

        // Return preview HTML for Step 1
        return response()->json([
            'success' => true,
            'preview_html' => view('student.preview_step1', ['data' => $validated])->render()
        ]);
    }

    // Finalize Step 1 and proceed to Step 2
    public function finalizeStep1(Request $request)
    {
        // Retrieve data from session
        $data = session('student_step1');

        // Check if student exists by ID and DOB (You can use a unique identifier here)
        $student = Student::where('dob', $data['dob'])
                          ->where('id', $data['student_id']) // Assuming you verify with student ID and DOB
                          ->first();

        if ($student) {
            // Update existing student record
            $student->update($data);
        } else {
            // Create new student record if not found
            $student = Student::create($data);
        }

        // Clear session data after saving to database
        session()->forget('student_step1');

        // Return a response or redirect to next step
        return redirect()->route('student.step2'); // Proceed to next step
    }

    // Show Step 2 form: Student Details (Implementation of Step 2 goes here)
    public function showStep2Form()
    {
        return view('form.registration.step2');
    }
    
    // ./End Step 1
}
