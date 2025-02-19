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

class StudentInfoController extends Controller
{
    // Show the enrollment form
    public function showForm()
    {
        return view('web.studentinfo.form');
    }

    // Store data for Step 1
    public function storeStep1(Request $request)
    {
        try {
            // Step 1: Validation rules for personal details
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dob' => 'required|date',
                'gender' => 'required|string',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
            ]);

            // Store the data in the session or save it to the database
            $student = new Student();
            $student->first_name = $validatedData['first_name'];
            $student->last_name = $validatedData['last_name'];
            $student->dob = $validatedData['dob'];
            $student->gender = $validatedData['gender'];
            $student->email = $validatedData['email'];
            $student->phone = $validatedData['phone'];
            $student->address = $validatedData['address'];
            $student->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Store data for Step 2 (or additional steps)
    public function storeStep2(Request $request)
    {
        try {
            // Step 2: Add fields and validation rules
            $validatedData = $request->validate([
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'emergency_contact' => 'required|string|max:20',
            ]);

            // You can either store this data in the session or update the database
            $student = Student::find($request->student_id); // Assuming the student ID is sent
            $student->father_name = $validatedData['father_name'];
            $student->mother_name = $validatedData['mother_name'];
            $student->emergency_contact = $validatedData['emergency_contact'];
            $student->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Store data for Step 3 (or additional steps)
    public function storeStep3(Request $request)
    {
        try {
            // Add validation rules for Step 3
            $validatedData = $request->validate([
                'course' => 'required|string|max:255',
                'enrollment_number' => 'required|string|max:255',
            ]);

            $student = Student::find($request->student_id);
            $student->course = $validatedData['course'];
            $student->enrollment_number = $validatedData['enrollment_number'];
            $student->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Generate the PDF for the final submission
    public function generatePdf(Request $request)
    {
        try {
            // Retrieve all data entered by the student
            $studentData = Student::find($request->student_id); // Fetch the data based on student ID

            // Generate PDF using dompdf or another library
            $pdf = PDF::loadView('web.studentinfo.pdf_preview', compact('studentData'));
            $pdfPath = storage_path('app/public/student_forms/' . time() . '_student_form.pdf');
            $pdf->save($pdfPath);

            return response()->json(['pdf_url' => asset('storage/student_forms/' . basename($pdfPath))]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'PDF generation failed.']);
        }
    }

    // Final form submission (after reviewing the data)
    public function finalSubmit(Request $request)
    {
        try {
            // Assuming you already have a student record, update or create it
            $student = Student::find($request->student_id);
            $student->status = 'submitted'; // Mark the form as submitted
            $student->save();

            // After submission, you can do further processing, like sending an email, etc.
            return response()->json(['success' => true, 'message' => 'Form successfully submitted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Final submission failed.']);
        }
    }

    // Final confirmation for submitting the form
    public function confirmSubmission(Request $request)
    {
        try {
            // Handle the confirmation before the final submission
            $student = Student::find($request->student_id);
            $student->confirmed = true;
            $student->save();

            return response()->json(['success' => true, 'message' => 'You have confirmed your submission.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Confirmation failed.']);
        }
    }
}
