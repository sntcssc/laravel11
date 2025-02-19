<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSeries\AdditionalPreparation;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdditionalPreparationController extends Controller
{
    public function index()
    {
        try {
            $preparations = AdditionalPreparation::all();
            return view('admin.testseries.preparations.index', compact('preparations'));
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Something went wrong while fetching the data.']);
        }
    }

    // Display the specified resource
    public function show(AdditionalPreparation $additionalPreparation)
    {
        try {
            return view('admin.testseries.preparations.show', compact('additionalPreparation'));
        } catch (\Exception $e) {
            Log::error('Error displaying CSAT preparations details: ' . $e->getMessage());
            return redirect()->route('preparations.index')->with('error', 'Failed to fetch CSAT preparations. Please try again later.');
        }
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.testseries.preparations.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string',
            'youtube_channels_followed' => 'required|string',
            'other_coaching_programs' => 'required|string',
            'coaching_name' => 'nullable|string',
            'coaching_program_details' => 'nullable|string',
            'revision_before_prelims_count' => 'required|integer',
            'experience_stress_anxiety' => 'required|string',
            'positive_takeaways_from_mock_tests' => 'required|string',
            'mistakes_after_mock_tests' => 'required|string',
            'specific_strategy_for_tests' => 'required|string',
            'daily_study_hours' => 'required|integer',
            'study_schedule' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            AdditionalPreparation::create($request->all());
            return redirect()->route('preparations.index')->with('success', 'Preparation added successfully!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Something went wrong while saving the data.']);
        }
    }

    public function edit($id)
    {
        $preparation = AdditionalPreparation::findOrFail($id);
        $students = Student::all();
        return view('admin.testseries.preparations.edit', compact('preparation', 'students'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string',
            'youtube_channels_followed' => 'required|string',
            'other_coaching_programs' => 'required|string',
            'coaching_name' => 'nullable|string',
            'coaching_program_details' => 'nullable|string',
            'revision_before_prelims_count' => 'required|integer',
            'experience_stress_anxiety' => 'required|string',
            'positive_takeaways_from_mock_tests' => 'required|string',
            'mistakes_after_mock_tests' => 'required|string',
            'specific_strategy_for_tests' => 'required|string',
            'daily_study_hours' => 'required|integer',
            'study_schedule' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $preparation = AdditionalPreparation::findOrFail($id);
            $preparation->update($request->all());
            return redirect()->route('preparations.index')->with('success', 'Preparation updated successfully!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Something went wrong while updating the data.']);
        }
    }

    public function destroy($id)
    {
        try {
            $preparation = AdditionalPreparation::findOrFail($id);
            $preparation->delete();
            return redirect()->route('preparations.index')->with('success', 'Preparation deleted successfully!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Something went wrong while deleting the data.']);
        }
    }
}
