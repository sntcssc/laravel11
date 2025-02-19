<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSeries\StudentDetail;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class StudentDetailController extends Controller
{
    /**
     * Display a listing of the student details.
     */
    public function index()
    {
        try {
            $studentDetails = StudentDetail::all();
            return view('admin.testseries.student_details.index', compact('studentDetails'));
        } catch (\Exception $e) {
            Log::error("Error fetching student details: ".$e->getMessage());
            dd($e->getMessage());
            // return redirect()->route('student_details.index')->with('error', 'Failed to load student details. Please try again later.');
        }
    }

    /**
     * Show the form for creating a new student detail.
     */
    public function create()
    {
        $students = Student::all();
        // dd($students);
        return view('admin.testseries.student_details.create', compact('students'));
    }

    /**
     * Store a newly created student detail.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validate request data
        $validated = $request->validate([
            'unique_id' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id',
            'self_study_hours' => 'required|integer',
            'has_separate_study_room' => 'required|boolean',
            'is_in_hostel' => 'required|boolean',
            'is_residing_in_kolkata' => 'required|boolean',
            'travel_time' => 'required|string|max:255',
            'prelims_mode' => 'required|string|max:255',
            'prelims_mode_reason' => 'required|string',
            'mentoring_mode' => 'required|string|max:255',
            'mentoring_mode_reason' => 'required|string',
            'is_full_time_preparation' => 'required|boolean',
            'work_schedule' => 'required|string|max:255',
            'daily_preparation_hours' => 'required|integer',
        ]);

        try {
            StudentDetail::create($validated);
            return redirect()->route('student_details.index')->with('success', 'Student Detail created successfully');
        } catch (QueryException $e) {
            Log::error("Database error while creating student detail: ".$e->getMessage());
            return redirect()->route('student_details.index')->with('error', 'Failed to create student detail. Please try again.');
        } catch (\Exception $e) {
            Log::error("Error creating student detail: ".$e->getMessage());
            return redirect()->route('student_details.index')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for editing the student detail.
     */
    public function edit(StudentDetail $studentDetail)
    {
        $students = Student::all();
        return view('admin.testseries.student_details.edit', compact('studentDetail', 'students'));
    }

    /**
     * Update the specified student detail.
     */
    public function update(Request $request, StudentDetail $studentDetail)
    {
        // Validate request data
        $validated = $request->validate([
            'unique_id' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id',
            'self_study_hours' => 'required|integer',
            'has_separate_study_room' => 'required|boolean',
            'is_in_hostel' => 'required|boolean',
            'is_residing_in_kolkata' => 'required|boolean',
            'travel_time' => 'required|string|max:255',
            'prelims_mode' => 'required|string|max:255',
            'prelims_mode_reason' => 'required|string',
            'mentoring_mode' => 'required|string|max:255',
            'mentoring_mode_reason' => 'required|string',
            'is_full_time_preparation' => 'required|boolean',
            'work_schedule' => 'required|string|max:255',
            'daily_preparation_hours' => 'required|integer',
        ]);

        try {
            $studentDetail->update($validated);
            return redirect()->route('student_details.index')->with('success', 'Student Detail updated successfully');
        } catch (QueryException $e) {
            Log::error("Database error while updating student detail: ".$e->getMessage());
            return redirect()->route('student_details.index')->with('error', 'Failed to update student detail. Please try again.');
        } catch (\Exception $e) {
            Log::error("Error updating student detail: ".$e->getMessage());
            return redirect()->route('student_details.index')->with('error', 'An unexpected error occurred.');
        }
    }

    // Display the specified student detail.
    public function show($id)
    {
        try {
            $studentDetail = StudentDetail::with('student')->findOrFail($id); // Optimized query with relationship
            return view('student_details.show', compact('studentDetail'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.testseries.student_details.index')->with('error', 'Student Detail not found.');
        }
    }

    /**
     * Remove the specified student detail.
     */
    public function destroy(StudentDetail $studentDetail)
    {
        try {
            $studentDetail->delete();
            return redirect()->route('student_details.index')->with('success', 'Student Detail deleted successfully');
        } catch (QueryException $e) {
            Log::error("Database error while deleting student detail: ".$e->getMessage());
            return redirect()->route('student_details.index')->with('error', 'Failed to delete student detail. Please try again.');
        } catch (\Exception $e) {
            Log::error("Error deleting student detail: ".$e->getMessage());
            return redirect()->route('student_details.index')->with('error', 'An unexpected error occurred.');
        }
    }

    // public function destroy($id)
    // {
    // Route: Route::delete('/student_details/{student}', [StudentDetailController::class, 'destroy'])->name('student_details.destroy');
    //     $studentDetail = StudentDetail::findOrFail($id);
    //     $studentDetail->delete();
    
    //     return redirect()->route('student_details.index')->with('success', 'Student detail deleted successfully.');
    // }

    
}
