<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSeries\SourcesUsed;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SourcesUsedController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Authentication middleware
    // }

    // Display a list of all resources
    // public function index()
    // {
    //     try {
    //         $sourcesUsed = SourcesUsed::with('student')->get();
    //         return view('admin.testseries.sources-used.index', compact('sourcesUsed'));
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching sources: ' . $e->getMessage());
    //         dd($e->getMessage());
    //         // return redirect()->route('sources-used.index')->with('error', 'Failed to retrieve sources. Please try again later.');
    //     }
    // }

    // // Show the form to create a new resource
    // public function create()
    // {
    //     try {
    //         $students = Student::all();
    //         return view('admin.testseries.sources-used.create', compact('students'));
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching students: ' . $e->getMessage());
    //         return redirect()->route('sources-used.index')->with('error', 'Failed to load students. Please try again later.');
    //     }
    // }
    // Show all source used records
    public function index()
    {
        $sourcesUsed = SourcesUsed::all();
        return view('admin.testseries.sources-used.index', compact('sourcesUsed'));
    }

    // Show the form to create a new source used record
    public function create()
    {
        $students = Student::all();
        $subjects = [
            'Indian Polity' => 'Indian Polity',
            'Economics' => 'Economics',
            'Geography' => 'Geography',
            'Environment' => 'Environment',
            'Art & Culture' => 'Art & Culture',
        ];
        return view('admin.testseries.sources-used.create', compact('students', 'subjects'));
    }

    // Store the source used record
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'student_id' => 'required|exists:students,id',
                'unique_id' => 'required|string|max:255',
                'subjects_materials' => 'required|array',
                'subjects_materials.*.subject' => 'required|in:Indian Polity,Economics,Geography,Environment,Art & Culture',
                'subjects_materials.*.source_material' => 'required|string',
            ]);

        // Fetch the student's unique_id from the student table
        $student = Student::findOrFail($validated['student_id']);
        $uniqueId = $student->unique_id;

            // Prepare the subjects and materials
            $subjectsMaterials = $validated['subjects_materials'];
            $subjects = [];

            // Loop over the subjects and source materials
            foreach ($subjectsMaterials as $item) {
                $subjects[$item['subject']] = $item['source_material'];
            }

            // Create a new SourceUsed record
            SourcesUsed::create([
                'student_id' => $validated['student_id'],
                'unique_id' => $validated['unique_id'], //$uniqueId,
                'subjects_materials' => json_encode($subjects),
            ]);

            return redirect()->route('sources-used.index')->with('success', 'Source materials added successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error storing source used: ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to add source materials. Please try again later.');
        }
    }

    // Show the form to edit a source used record
    public function edit(SourcesUsed $sourcesUsed)
    {
        $students = Student::all();
        $subjects = [
            'Indian Polity' => 'Indian Polity',
            'Economics' => 'Economics',
            'Geography' => 'Geography',
            'Environment' => 'Environment',
            'Art & Culture' => 'Art & Culture',
        ];

        // Decode the stored JSON data into an array
        $subjectsMaterials = json_decode($sourcesUsed->subjects_materials, true);

        return view('admin.testseries.sources-used.edit', compact('sourcesUsed', 'students', 'subjects', 'subjectsMaterials'));
    }

    // Update the source used record
    public function update(Request $request, SourcesUsed $sourcesUsed)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'student_id' => [
                    'required',
                    'exists:students,id',
                    Rule::unique('sources_useds')->ignore($sourcesUsed->id)->whereNull('deleted_at'),
                ],
                'unique_id' => [
                    'required',
                ],
                'subjects_materials' => 'required|array',
                'subjects_materials.*.subject' => 'required|in:Indian Polity,Economics,Geography,Environment,Art & Culture',
                'subjects_materials.*.source_material' => 'required|string',
            ]);

            // Fetch the student's unique_id from the student table
            $student = Student::findOrFail($validated['student_id']);
            $uniqueId = $student->unique_id;

            // Get the validated subjects

            $subjectsMaterials = $validated['subjects_materials'];
            $subjects = [];

            // Loop through the subjects and source materials
            foreach ($subjectsMaterials as $item) {
                $subjects[$item['subject']] = $item['source_material'];
            }

            // Update the SourceUsed record
            $sourcesUsed->update([
                'student_id' => $validated['student_id'],
                'unique_id' => $validated['unique_id'], // $uniqueId,
                'subjects_materials' => json_encode($subjects),
            ]);

            return redirect()->route('sources-used.index')->with('success', 'Source materials updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating source used: ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to update source materials. Please try again later.');
        }
    }

    // Delete the source used record
    public function destroy(SourcesUsed $sourcesUsed)
    {
        try {
            $sourcesUsed->delete();
            return redirect()->route('sources-used.index')->with('success', 'Source materials deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting source used: ' . $e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to delete source materials. Please try again later.');
        }
    }
}
