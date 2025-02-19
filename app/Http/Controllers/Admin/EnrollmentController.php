<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentProgramEnrollment;
use App\Models\Program;
use App\Models\Batch;
use App\Models\Section;

class EnrollmentController extends Controller
{
    // Show all enrollments (history) of a student
    public function showEnrollments(Student $student)
    {
        $enrollments = $student->enrollments()->with(['program', 'batch', 'section'])->get();
        return view('admin.enrollments.index', compact('enrollments', 'student'));
    }

    // Show only current (active) enrollments for a student
    public function showCurrentEnrollments(Student $student)
    {
        $currentEnrollments = $student->enrollments()
            ->where('status', 'active')
            ->with(['program', 'batch', 'section'])
            ->get();
        return view('admin.enrollments.current', compact('currentEnrollments', 'student'));
    }

    // Enroll a student into a program
    public function enroll(Request $request, Student $student)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'batch_id' => 'nullable|exists:batches,id',
            'section_id' => 'nullable|exists:sections,id',
        ]);

        // Create new enrollment record
        StudentProgramEnrollment::create([
            'student_id' => $student->id,
            'program_id' => $request->program_id,
            'batch_id' => $request->batch_id,
            'section_id' => $request->section_id,
            'status' => 'active',
            'enrolled_at' => now(),
        ]);

        return redirect()->route('students.enrollments', $student->id);
    }

    // Withdraw a student from a program (delete enrollment)
    public function withdraw(Student $student, StudentProgramEnrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('students.enrollments', $student->id);
    }
}
