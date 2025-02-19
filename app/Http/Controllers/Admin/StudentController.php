<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Program;
use App\Models\Batch;
use App\Models\Section;
use App\Models\StudentProgramEnrollment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // Constructor to apply auth middleware if needed
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Display a listing of the students
    public function index()
    {
        $students = Student::with('programEnrollments.program', 'programEnrollments.batch', 'programEnrollments.section')
            ->orderBy('created_at', 'desc')
            // ->get()
            ->paginate(10);
        
        return view('admin.students.index', compact('students'));
    }
    

    // Show the form for creating a new student
    public function create()
    {
        $programs = Program::all();
        $batches = Batch::all();
        $sections = Section::all();

        return view('admin.students.create', compact('programs', 'batches', 'sections'));
    }

    // Store a newly created student in the database
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'unique_id' => 'required|unique:students,unique_id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:8|confirmed',
            'dob' => 'required|date',
            'gender' => 'required',
            'category' => 'required',
            'mobile_number' => 'required|numeric',
            'whatsapp_number' => 'nullable|numeric',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,inactive',
            'batch_id' => 'required|exists:batches,id',
            'program_ids' => 'required|array|exists:programs,id', // Allow multiple programs
            'program_ids.*' => 'distinct', // Ensure programs are distinct
        ]);

        // Handle file upload for photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student_photos', 'public');
        }

        // Store the student
        $student = Student::create([
            'unique_id' => $request->unique_id,
            'batch_id' => $request->batch_id,
            'program_id' => $request->program_ids[0], // Pick the first program for student
            'admission_date' => now(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'father_occupation' => $request->father_occupation,
            'mother_name' => $request->mother_name,
            'mother_occupation' => $request->mother_occupation,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'category' => $request->category,
            'mobile_number' => $request->mobile_number,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'present_state' => $request->present_state,
            'present_district' => $request->present_district,
            'present_address' => $request->present_address,
            'present_pin' => $request->present_pin,
            'permanent_state' => $request->permanent_state,
            'permanent_district' => $request->permanent_district,
            'permanent_address' => $request->permanent_address,
            'permanent_pin' => $request->permanent_pin,
            'photo' => $photoPath,
            'status' => $request->status,
            'is_update' => $request->is_update ?? 'no',
            'login' => $request->login ?? 0,
        ]);

        // Enroll the student in multiple programs
        foreach ($request->program_ids as $program_id) {
            StudentProgramEnrollment::create([
                'student_id' => $student->id,
                'program_id' => $program_id,
                'batch_id' => $request->batch_id,
                'section_id' => $request->section_id ?? null, // Section is optional
                'status' => $request->status,
                // 'created_by' => Auth::id(),
                // 'updated_by' => Auth::id(),
                'enrolled_at' => now(),
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student created and enrolled successfully');
    }

    // Show the form for editing the specified student
    public function edit(Student $student)
    {
        $programs = Program::all();
        $batches = Batch::all();
        $sections = Section::all();

        return view('admin.students.edit', compact('student', 'programs', 'batches', 'sections'));
    }

    // Update the specified student in the database
    public function update(Request $request, Student $student)
    {
        // Validation
        $request->validate([
            'unique_id' => 'required|unique:students,unique_id,' . $student->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'password' => 'nullable|min:8|confirmed',
            'dob' => 'required|date',
            'gender' => 'required',
            'category' => 'required',
            'mobile_number' => 'required|numeric',
            'whatsapp_number' => 'nullable|numeric',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,inactive',
            'batch_id' => 'required|exists:batches,id',
            'program_ids' => 'required|array|exists:programs,id', // Allow multiple programs
            'program_ids.*' => 'distinct', // Ensure programs are distinct
        ]);

        // Handle file upload for photo
        if ($request->hasFile('photo')) {
            // Delete the old photo if exists
            if ($student->photo && Storage::exists('public/' . $student->photo)) {
                Storage::delete('public/' . $student->photo);
            }

            $photoPath = $request->file('photo')->store('student_photos', 'public');
        } else {
            $photoPath = $student->photo; // Retain the current photo if not uploading new
        }

        // Update the student
        $student->update([
            'unique_id' => $request->unique_id,
            'batch_id' => $request->batch_id,
            'program_id' => $request->program_ids[0], // Pick the first program for student
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'father_occupation' => $request->father_occupation,
            'mother_name' => $request->mother_name,
            'mother_occupation' => $request->mother_occupation,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'category' => $request->category,
            'mobile_number' => $request->mobile_number,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
            'present_state' => $request->present_state,
            'present_district' => $request->present_district,
            'present_address' => $request->present_address,
            'present_pin' => $request->present_pin,
            'permanent_state' => $request->permanent_state,
            'permanent_district' => $request->permanent_district,
            'permanent_address' => $request->permanent_address,
            'permanent_pin' => $request->permanent_pin,
            'photo' => $photoPath,
            'status' => $request->status,
            'is_update' => $request->is_update ?? 'no',
            'login' => $request->login ?? 0,
        ]);

        // Update the student's enrollments
        $student->programEnrollments()->delete(); // Remove old enrollments

        // Re-enroll the student in the new programs
        foreach ($request->program_ids as $program_id) {
            StudentProgramEnrollment::create([
                'student_id' => $student->id,
                'program_id' => $program_id,
                'batch_id' => $request->batch_id,
                'section_id' => $request->section_id ?? null, // Section is optional
                'status' => $request->status,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
                'enrolled_at' => now(),
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student updated and enrollments managed successfully');
    }

    // Show the specified student
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    // Remove the specified student from storage (soft delete)
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

}

// {
//     // Display all students
//     public function index()
//     {
//         // Retrieving students along with their enrollment details
//         $students = Student::with(['program', 'batch', 'section'])->get();
//         return view('students.index', compact('students'));
//     }

//     // Show the form to create a new student
//     public function create()
//     {
//         $programs = Program::all();
//         $batches = Batch::all();
//         $sections = Section::all();
//         return view('students.create', compact('programs', 'batches', 'sections'));
//     }

//     // Store a new student
//     public function store(Request $request)
//     {
//         // Validation rules
//         $request->validate([
//             'unique_id' => 'required|unique:students,unique_id',
//             'first_name' => 'required',
//             'last_name' => 'required',
//             'email' => 'required|email|unique:students,email',
//             'password' => 'required|min:8|confirmed',
//             'dob' => 'required|date',
//             'gender' => 'required',
//             'category' => 'required',
//             'mobile_number' => 'required|numeric',
//             'whatsapp_number' => 'nullable|numeric',
//             'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//             'status' => 'required|in:active,inactive',
//             'batch_id' => 'required|exists:batches,id',
//             'program_id' => 'required|exists:programs,id',
//         ]);

//         // Handle file upload if there's a photo
//         $photoPath = null;
//         if ($request->hasFile('photo')) {
//             $photoPath = $request->file('photo')->store('student_photos', 'public');
//         }

//         // Store the student's details first
//         $student = Student::create([
//             'unique_id' => $request->unique_id,
//             'batch_id' => $request->batch_id,
//             'program_id' => $request->program_id,
//             'admission_date' => now(), // You can set any date or use a custom field
//             'first_name' => $request->first_name,
//             'last_name' => $request->last_name,
//             'father_name' => $request->father_name,
//             'father_occupation' => $request->father_occupation,
//             'dob' => $request->dob,
//             'gender' => $request->gender,
//             'category' => $request->category,
//             'mobile_number' => $request->mobile_number,
//             'whatsapp_number' => $request->whatsapp_number,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'present_state' => $request->present_state,
//             'present_district' => $request->present_district,
//             'present_address' => $request->present_address,
//             'present_pin' => $request->present_pin,
//             'permanent_state' => $request->permanent_state,
//             'permanent_district' => $request->permanent_district,
//             'permanent_address' => $request->permanent_address,
//             'permanent_pin' => $request->permanent_pin,
//             'photo' => $photoPath,
//             'status' => $request->status,
//             'is_update' => $request->is_update ?? 'no',
//             'login' => $request->login ?? 0,
//         ]);

//         // Store the student's enrollment
//         if ($request->program_id && $request->batch_id) {
//             StudentProgramEnrollment::create([
//                 'student_id' => $student->id,
//                 'program_id' => $request->program_id,
//                 'batch_id' => $request->batch_id,
//                 'section_id' => $request->section_id, // Section is optional
//                 'status' => $request->status,
//                 'created_by' => auth()->id(),
//                 'updated_by' => auth()->id(),
//                 'enrolled_at' => now(),
//             ]);
//         }

//         return redirect()->route('students.index')->with('success', 'Student created successfully');
//     }

//     // Show the form to edit an existing student
//     public function edit($id)
//     {
//         $student = Student::findOrFail($id);
//         $programs = Program::all();
//         $batches = Batch::all();
//         $sections = Section::all();
//         return view('students.edit', compact('student', 'programs', 'batches', 'sections'));
//     }

//     // Update student information and enrollment
//     public function update(Request $request, $id)
//     {
//         // Validation rules
//         $request->validate([
//             'unique_id' => ['required', Rule::unique('students')->ignore($id)],
//             'first_name' => 'required',
//             'last_name' => 'required',
//             'email' => ['required', 'email', Rule::unique('students')->ignore($id)],
//             'password' => 'nullable|min:8|confirmed',
//             'dob' => 'required|date',
//             'gender' => 'required',
//             'category' => 'required',
//             'mobile_number' => 'required|numeric',
//             'whatsapp_number' => 'nullable|numeric',
//             'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//             'status' => 'required|in:active,inactive',
//             'batch_id' => 'required|exists:batches,id',
//             'program_id' => 'required|exists:programs,id',
//         ]);

//         // Find the student and handle file upload
//         $student = Student::findOrFail($id);

//         $photoPath = $student->photo; // Default to current photo if no new file is uploaded
//         if ($request->hasFile('photo')) {
//             // Delete the old photo if it exists
//             if ($photoPath) {
//                 Storage::delete('public/' . $photoPath);
//             }
//             $photoPath = $request->file('photo')->store('student_photos', 'public');
//         }

//         // Update student details
//         $student->update([
//             'unique_id' => $request->unique_id,
//             'batch_id' => $request->batch_id,
//             'program_id' => $request->program_id,
//             'admission_date' => now(), // You can set any date or use a custom field
//             'first_name' => $request->first_name,
//             'last_name' => $request->last_name,
//             'father_name' => $request->father_name,
//             'father_occupation' => $request->father_occupation,
//             'dob' => $request->dob,
//             'gender' => $request->gender,
//             'category' => $request->category,
//             'mobile_number' => $request->mobile_number,
//             'whatsapp_number' => $request->whatsapp_number,
//             'email' => $request->email,
//             'password' => $request->password ? Hash::make($request->password) : $student->password,
//             'present_state' => $request->present_state,
//             'present_district' => $request->present_district,
//             'present_address' => $request->present_address,
//             'present_pin' => $request->present_pin,
//             'permanent_state' => $request->permanent_state,
//             'permanent_district' => $request->permanent_district,
//             'permanent_address' => $request->permanent_address,
//             'permanent_pin' => $request->permanent_pin,
//             'photo' => $photoPath,
//             'status' => $request->status,
//             'is_update' => $request->is_update ?? 'no',
//             'login' => $request->login ?? 0,
//         ]);

//         // Update the student's enrollment
//         $enrollment = StudentProgramEnrollment::where('student_id', $student->id)->first();
//         if ($enrollment) {
//             $enrollment->update([
//                 'program_id' => $request->program_id,
//                 'batch_id' => $request->batch_id,
//                 'section_id' => $request->section_id,
//                 'status' => $request->status,
//                 'updated_by' => auth()->id(),
//                 'enrolled_at' => now(),
//             ]);
//         } else {
//             StudentProgramEnrollment::create([
//                 'student_id' => $student->id,
//                 'program_id' => $request->program_id,
//                 'batch_id' => $request->batch_id,
//                 'section_id' => $request->section_id, // Section is optional
//                 'status' => $request->status,
//                 'created_by' => auth()->id(),
//                 'updated_by' => auth()->id(),
//                 'enrolled_at' => now(),
//             ]);
//         }

//         return redirect()->route('students.index')->with('success', 'Student updated successfully');
//     }

//     // Show a student's details
//     public function show($id)
//     {
//         $student = Student::findOrFail($id);
//         $enrollments = StudentProgramEnrollment::where('student_id', $id)->get();
//         return view('students.show', compact('student', 'enrollments'));
//     }

//     // Remove a student (soft delete)
//     public function destroy($id)
//     {
//         $student = Student::findOrFail($id);
//         $student->delete();
//         return redirect()->route('students.index')->with('success', 'Student deleted successfully');
//     }
// }
