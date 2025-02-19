<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentProgramEnrollment;
use App\Models\Student;
use App\Models\Program;
use App\Models\Batch;
use App\Models\Section;


class StudentProgramEnrollmentController extends Controller
{
    // Display a listing of the enrollments
    public function index()
    {
        $enrollments = StudentProgramEnrollment::with(['student', 'program', 'batch', 'section'])->get();
        // dd($enrollments);
        return view('admin.enrollments.index', compact('enrollments'));
    }

    // Show the form for creating a new enrollment
    public function create()
    {
        $students = Student::all();
        $programs = Program::all();
        $batches = Batch::all();
        $sections = Section::all();

        return view('admin.enrollments.create', compact('students', 'programs', 'batches', 'sections'));
    }

    // Store a newly created enrollment in the database
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'program_id' => 'required|exists:programs,id',
            'batch_id' => 'required|exists:batches,id',
            'section_id' => 'nullable|exists:sections,id',
            'status' => 'required|boolean',
        ]);

        StudentProgramEnrollment::create([
            'student_id' => $request->student_id,
            'program_id' => $request->program_id,
            'batch_id' => $request->batch_id,
            'section_id' => $request->section_id,
            'status' => $request->status,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully!');
    }

    // Display the specified enrollment
    public function show($id)
    {
        $enrollment = StudentProgramEnrollment::with(['student', 'program', 'batch', 'section'])->findOrFail($id);
        return view('admin.enrollments.show', compact('enrollment'));
    }

    // Show the form for editing the specified enrollment
    public function edit($id)
    {
        $enrollment = StudentProgramEnrollment::findOrFail($id);
        $students = Student::all();
        $programs = Program::all();
        $batches = Batch::all();
        $sections = Section::all();

        return view('admin.enrollments.edit', compact('enrollment', 'students', 'programs', 'batches', 'sections'));
    }

    // Update the specified enrollment in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'program_id' => 'required|exists:programs,id',
            'batch_id' => 'required|exists:batches,id',
            'section_id' => 'nullable|exists:sections,id',
            'status' => 'required|boolean',
        ]);

        $enrollment = StudentProgramEnrollment::findOrFail($id);
        $enrollment->update([
            'student_id' => $request->student_id,
            'program_id' => $request->program_id,
            'batch_id' => $request->batch_id,
            'section_id' => $request->section_id,
            'status' => $request->status,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully!');
    }

    // Remove the specified enrollment from the database
    public function destroy($id)
    {
        $enrollment = StudentProgramEnrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully!');
    }


    // // Show the program enrollment details for a specific student enrollment
    // public function show($id)
    // {
    //     // Find the program enrollment by ID
    //     $enrollment = StudentProgramEnrollment::with(['student', 'program', 'batch', 'section'])->findOrFail($id);

    //     // Return the view with the enrollment details
    //     return view('admin.enrollments.show', compact('enrollment'));
    // }
}
