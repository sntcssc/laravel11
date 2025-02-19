<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TestSeries\SfgProgramKnowledge;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class SfgProgramKnowledgeController extends Controller
{
    // Constructor to apply middleware
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Display all records
    public function index()
    {
        try {
            $programKnowledges = SfgProgramKnowledge::with('student')->paginate(10); //->get();
            return view('admin.testseries.sfg_program_knowledges.index', compact('programKnowledges'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error("Error fetching SFG program knowledge: " . $e->getMessage());
            return redirect()->route('sfg_program_knowledges.index')->with('error', 'Unable to fetch records');
        }
    }

    // Show form to create a new record
    public function create()
    {
        try {
            $students = Student::all();
            return view('admin.testseries.sfg_program_knowledges.create', compact('students'));
        } catch (\Exception $e) {
            Log::error("Error loading create form: " . $e->getMessage());
            return redirect()->route('sfg_program_knowledges.index')->with('error', 'Unable to load create form');
        }
    }

    // Store a newly created record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string|max:255',
            'key_features_of_sfg_program' => 'required|string',
            'ways_sfg_will_help_in_exam' => 'required|string',
            'regular_analysis_of_prelims_performance' => 'required|boolean',
            'benefits_from_prelims_analysis' => 'required|string',
            'identifying_weak_areas_after_tests' => 'required|boolean',
            'working_to_eliminate_weak_areas' => 'required|string',
            'reading_test_explanations' => 'required|boolean',
            'taking_notes_from_explanations' => 'required|boolean',
            'regular_test_participation' => 'required|boolean',
            'test_participation_challenges' => 'required|string',
            'overcoming_test_challenges' => 'required|string',
            'highest_test_score' => 'required|integer',
            'lowest_test_score' => 'required|integer',
            'average_test_score' => 'required|numeric',
            'belief_in_clearing_prelims_this_year' => 'required|boolean',
        ]);

        try {
            SfgProgramKnowledge::create($validated);
            return redirect()->route('sfg_program_knowledges.index')->with('success', 'SFG Program Knowledge created successfully');
        } catch (\Exception $e) {
            Log::error("Error storing SFG program knowledge: " . $e->getMessage());
            return back()->with('error', 'An error occurred while saving the record');
        }
    }

    // Display a specific record
    public function show($id)
    {
        try {
            $programKnowledge = SfgProgramKnowledge::findOrFail($id);
            return view('admin.testseries.sfg_program_knowledges.show', compact('programKnowledge'));
        } catch (\Exception $e) {
            Log::error("Error fetching SFG program knowledge with ID $id: " . $e->getMessage());
            return redirect()->route('sfg_program_knowledges.index')->with('error', 'Unable to fetch the record');
        }
    }

    // Show form to edit a specific record
    public function edit($id)
    {
        try {
            $programKnowledge = SfgProgramKnowledge::findOrFail($id);
            $students = Student::all();
            return view('admin.testseries.sfg_program_knowledges.edit', compact('programKnowledge', 'students'));
        } catch (\Exception $e) {
            Log::error("Error loading edit form for SFG program knowledge with ID $id: " . $e->getMessage());
            return redirect()->route('sfg_program_knowledges.index')->with('error', 'Unable to load edit form');
        }
    }

    // Update a specific record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string|max:255',
            'key_features_of_sfg_program' => 'required|string',
            'ways_sfg_will_help_in_exam' => 'required|string',
            'regular_analysis_of_prelims_performance' => 'required|boolean',
            'benefits_from_prelims_analysis' => 'required|string',
            'identifying_weak_areas_after_tests' => 'required|boolean',
            'working_to_eliminate_weak_areas' => 'required|string',
            'reading_test_explanations' => 'required|boolean',
            'taking_notes_from_explanations' => 'required|boolean',
            'regular_test_participation' => 'required|boolean',
            'test_participation_challenges' => 'required|string',
            'overcoming_test_challenges' => 'required|string',
            'highest_test_score' => 'required|integer',
            'lowest_test_score' => 'required|integer',
            'average_test_score' => 'required|numeric',
            'belief_in_clearing_prelims_this_year' => 'required|boolean',
        ]);

        try {
            $programKnowledge = SfgProgramKnowledge::findOrFail($id);
            $programKnowledge->update($validated);
            return redirect()->route('sfg_program_knowledges.index')->with('success', 'SFG Program Knowledge updated successfully');
        } catch (\Exception $e) {
            Log::error("Error updating SFG program knowledge with ID $id: " . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the record');
        }
    }

    // Delete a specific record
    public function destroy($id)
    {
        try {
            $programKnowledge = SfgProgramKnowledge::findOrFail($id);
            $programKnowledge->delete();
            return redirect()->route('sfg_program_knowledges.index')->with('success', 'SFG Program Knowledge deleted successfully');
        } catch (\Exception $e) {
            Log::error("Error deleting SFG program knowledge with ID $id: " . $e->getMessage());
            return redirect()->route('sfg_program_knowledges.index')->with('error', 'Unable to delete the record');
        }
    }
}
