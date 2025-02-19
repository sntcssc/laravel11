<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSeries\SourcesUsed;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SourcesUsedController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Authentication middleware
    // }

    // Display a list of all resources
    public function index()
    {
        try {
            $sourcesUsed = SourcesUsed::with('student')->get();
            // dd($sourcesUsed);
            return view('admin.testseries.sources-used.index', compact('sourcesUsed'));
        } catch (\Exception $e) {
            Log::error('Error fetching sources: ' . $e->getMessage());
            dd($e->getMessage());
            // return redirect()->route('sources-used.index')->with('error', 'Failed to retrieve sources. Please try again later.');
        }
    }

    // Show the form to create a new resource
    public function create()
    {
        try {
            $students = Student::all();
            $subjects = [
                'Indian Polity' => 'Indian Polity',
                'Economics' => 'Economics',
                'Geography' => 'Geography',
                'Environment' => 'Environment',
                'Art & Culture' => 'Art & Culture',
            ];
            return view('admin.testseries.sources-used.create', compact('students', 'subjects'));
        } catch (\Exception $e) {
            Log::error('Error fetching students: ' . $e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to load students. Please try again later.');
        }
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // dd($request);
        try {
            // Validate the request data
            $validated = $request->validate([
                'student_id' => 'required|exists:students,id',
                'unique_id' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'source_material' => 'required|string',
            ]);

            // Create a new source used record
            SourcesUsed::create($validated);

            return redirect()->route('sources-used.index')->with('success', 'Source used created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log any other exceptions
            Log::error('Error storing source used: ' . $e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to create source used. Please try again later.');
        }
    }

    // Display the specified resource
    public function show(SourcesUsed $sourcesUsed)
    {
        try {
            return view('admin.testseries.sources-used.show', compact('sourcesUsed'));
        } catch (\Exception $e) {
            Log::error('Error displaying source used details: ' . $e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to fetch source used details. Please try again later.');
        }
    }

    // Show the form to edit the specified resource
    public function edit(SourcesUsed $sourcesUsed)
    {
        try {
            $students = Student::all();
            $subjects = [
                'Indian Polity' => 'Indian Polity',
                'Economics' => 'Economics',
                'Geography' => 'Geography',
                'Environment' => 'Environment',
                'Art & Culture' => 'Art & Culture',
            ];
            return view('admin.testseries.sources-used.edit', compact('sourcesUsed', 'students', 'subjects'));
        } catch (\Exception $e) {
            Log::error('Error fetching students for edit: ' . $e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to load students for editing. Please try again later.');
        }
    }

    // Update the specified resource in storage
    public function update(Request $request, SourcesUsed $sourcesUsed)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'student_id' => 'required|exists:students,id',
                'unique_id' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'source_material' => 'required|string',
            ]);

            // Update the source used record
            $sourcesUsed->update($validated);

            return redirect()->route('sources-used.index')->with('success', 'Source used updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log any other exceptions
            Log::error('Error updating source used: ' . $e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to update source used. Please try again later.');
        }
    }

    // Remove the specified resource from storage
    public function destroy(SourcesUsed $sourcesUsed)
    {
        try {
            // Delete the source used record
            $sourcesUsed->delete();
            return redirect()->route('sources-used.index')->with('success', 'Source used deleted successfully.');
        } catch (\Exception $e) {
            // Log the error and show a friendly message to the user
            Log::error('Error deleting source used: ' . $e->getMessage());
            return redirect()->route('sources-used.index')->with('error', 'Failed to delete source used. Please try again later.');
        }
    }
}
