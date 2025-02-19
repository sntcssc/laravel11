<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSeries\PreparationDetail;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;


class PreparationDetailController extends Controller
{
    public function index()
    {
        try {
            $preparationDetails = PreparationDetail::with('student')->get();
            return view('admin.testseries.preparation_details.index', compact('preparationDetails'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while fetching the preparation details.');
        }
    }

    public function create()
    {
        try {
            $students = Student::all();
            return view('admin.testseries.preparation_details.create', compact('students'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to fetch students. Please try again later.');
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'student_id' => 'required|exists:students,id',
                'unique_id' => 'required|string|unique:preparation_details,unique_id',
                'highest_education_qualification' => 'required|string',
                'graduation_subject' => 'required|string',
                'optional_subject' => 'required|string',
                'start_year' => 'required|integer|min:2000|max:'.(date('Y')),
                'attempt_count' => 'required|integer|min:1',
                'marks_in_attempts' => 'required|string',
                'strong_subjects' => 'required|string',
                'challenging_subjects' => 'required|string',
                'comfortable_prelims_subjects' => 'required|string',
                'struggle_prelims_subjects' => 'required|string',
                'primary_current_affairs_source' => 'required|string',
                'current_affairs_study_hours' => 'required|integer|min:1',
                'full_prelims_reading_completed' => 'required|boolean',
                'revision_before_prelims' => 'required|boolean',
                'revision_time_per_day' => 'required|integer|min:1',
                'revision_method' => 'required|string',
                'avoid_past_mistakes' => 'required|string',
                'review_pyq_frequency' => 'required|string',
                'solved_practice_questions_after_each_chapter' => 'required|boolean',
                'note_preparation_for_pyqs' => 'required|boolean',
            ]);

            // Store the validated data
            PreparationDetail::create($validated);

            return redirect()->route('preparation_details.index')->with('success', 'Preparation Detail created successfully.');

        } catch (Exception $e) {
            // Catch any exception that occurs during the store process
            return redirect()->back()->with('error', 'Something went wrong while creating the preparation detail. Please try again.');
        }
    }

    public function edit(PreparationDetail $preparationDetail)
    {
        try {
            $students = Student::all();
            return view('admin.testseries.preparation_details.edit', compact('preparationDetail', 'students'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to fetch the preparation details for editing. Please try again.');
        }
    }

    public function update(Request $request, PreparationDetail $preparationDetail)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'student_id' => 'required|exists:students,id',
                'unique_id' => 'required|string|unique:preparation_details,unique_id,' . $preparationDetail->id,
                'highest_education_qualification' => 'required|string',
                'graduation_subject' => 'required|string',
                'optional_subject' => 'required|string',
                'start_year' => 'required|integer|min:2000|max:'.(date('Y')),
                'attempt_count' => 'required|integer|min:1',
                'marks_in_attempts' => 'required|string',
                'strong_subjects' => 'required|string',
                'challenging_subjects' => 'required|string',
                'comfortable_prelims_subjects' => 'required|string',
                'struggle_prelims_subjects' => 'required|string',
                'primary_current_affairs_source' => 'required|string',
                'current_affairs_study_hours' => 'required|integer|min:1',
                'full_prelims_reading_completed' => 'required|boolean',
                'revision_before_prelims' => 'required|boolean',
                'revision_time_per_day' => 'required|integer|min:1',
                'revision_method' => 'required|string',
                'avoid_past_mistakes' => 'required|string',
                'review_pyq_frequency' => 'required|string',
                'solved_practice_questions_after_each_chapter' => 'required|boolean',
                'note_preparation_for_pyqs' => 'required|boolean',
            ]);

            // Update the validated data
            $preparationDetail->update($validated);

            return redirect()->route('preparation_details.index')->with('success', 'Preparation Detail updated successfully.');

        } catch (Exception $e) {
            // Catch any exception that occurs during the update process
            return redirect()->back()->with('error', 'Something went wrong while updating the preparation detail. Please try again.');
        }
    }

    public function destroy(PreparationDetail $preparationDetail)
    {
        try {
            $preparationDetail->delete();

            return redirect()->route('preparation_details.index')->with('success', 'Preparation Detail deleted successfully.');
        } catch (Exception $e) {
            // Catch any exception that occurs during the delete process
            return redirect()->route('preparation_details.index')->with('error', 'Something went wrong while deleting the preparation detail. Please try again.');
        }
    }
}
