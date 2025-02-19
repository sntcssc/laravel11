<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSeries\PersonalityDetail;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PersonalityDetailController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        try {
            $personalityDetails = PersonalityDetail::with('student')->get();
            return view('admin.testseries.personality_details.index', compact('personalityDetails'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withError('Error fetching data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.testseries.personality_details.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string',
            'reason_for_civil_services' => 'required|string',
            'essential_values_for_topping' => 'required|string',
            'motivation_for_daily_effort' => 'required|string',
            'strengths_in_clearing_exams' => 'required|string',
            'areas_for_improvement' => 'required|string',
            'obstacles_to_success' => 'required|string',
            'current_challenges' => 'required|string',
            'overcoming_challenges_plan' => 'required|string',
            'strategies_for_success' => 'required|string',
            'major_distractions' => 'required|string',
            'distraction_overcoming_plan' => 'required|string',
            'distraction_timeline' => 'required|string',
        ]);

        try {
            PersonalityDetail::create($request->all());
            return redirect()->route('personality_details.index')->with('success', 'Personality Detail created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withError('Error creating personality detail: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $personalityDetail = PersonalityDetail::findOrFail($id);
            return view('admin.testseries.personality_details.show', compact('personalityDetail'));
        } catch (\Exception $e) {
            return back()->withError('Error fetching personality detail: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $personalityDetail = PersonalityDetail::findOrFail($id);
            $students = Student::all();
            return view('admin.testseries.personality_details.edit', compact('personalityDetail', 'students'));
        } catch (\Exception $e) {
            return back()->withError('Error fetching personality detail for editing: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string',
            'reason_for_civil_services' => 'required|string',
            'essential_values_for_topping' => 'required|string',
            'motivation_for_daily_effort' => 'required|string',
            'strengths_in_clearing_exams' => 'required|string',
            'areas_for_improvement' => 'required|string',
            'obstacles_to_success' => 'required|string',
            'current_challenges' => 'required|string',
            'overcoming_challenges_plan' => 'required|string',
            'strategies_for_success' => 'required|string',
            'major_distractions' => 'required|string',
            'distraction_overcoming_plan' => 'required|string',
            'distraction_timeline' => 'required|string',
        ]);

        try {
            $personalityDetail = PersonalityDetail::findOrFail($id);
            $personalityDetail->update($request->all());
            return redirect()->route('personality_details.index')->with('success', 'Personality Detail updated successfully');
        } catch (\Exception $e) {
            return back()->withError('Error updating personality detail: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $personalityDetail = PersonalityDetail::findOrFail($id);
            $personalityDetail->delete();
            return redirect()->route('personality_details.index')->with('success', 'Personality Detail deleted successfully');
        } catch (\Exception $e) {
            return back()->withError('Error deleting personality detail: ' . $e->getMessage());
        }
    }
}
