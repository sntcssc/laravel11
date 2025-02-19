<?php

namespace App\Http\Controllers\Admin\TestSeries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSeries\CsatPreparation;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CsatPreparationController extends Controller
{
    public function index()
    {
        try {
            $csatPreparations = CsatPreparation::with('student')->get();
            return view('admin.testseries.csat_preparations.index', compact('csatPreparations'));
        } catch (\Exception $e) {
            Log::error('Error fetching CSAT preparations: '.$e->getMessage());
            return redirect()->route('admin.testseries.csat_preparations.index')->with('error', 'Unable to fetch CSAT preparations.');
        }
    }

    // Display the specified resource
    public function show(CsatPreparation $csatPreparation)
    {
        try {
            return view('admin.testseries.csat_preparations.show', compact('csatPreparation'));
        } catch (\Exception $e) {
            Log::error('Error displaying CSAT preparations details: ' . $e->getMessage());
            return redirect()->route('csat_preparations.index')->with('error', 'Failed to fetch CSAT preparations. Please try again later.');
        }
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.testseries.csat_preparations.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string|max:255',
            'isever_failed_csat' => 'required|boolean',
            'failed_csat_count' => 'required|integer',
            'difficult_csat_section' => 'required|string',
            'took_csat_coaching' => 'required|boolean',
            'mock_test_for_csat' => 'required|boolean',
            'practicing_csat_every_day' => 'required|boolean',
        ]);

        try {
            CsatPreparation::create($request->all());
            return redirect()->route('csat_preparations.index')->with('success', 'CSAT preparation added successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating CSAT preparation: '.$e->getMessage());
            dd($e->getMessage());
            return redirect()->route('csat_preparations.index')->with('error', 'Failed to add CSAT preparation.');
        }
    }

    public function edit(CsatPreparation $csatPreparation)
    {
        $students = Student::all();
        return view('admin.testseries.csat_preparations.edit', compact('csatPreparation', 'students'));
    }

    public function update(Request $request, CsatPreparation $csatPreparation)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'unique_id' => 'required|string|max:255',
            'isever_failed_csat' => 'required|boolean',
            'failed_csat_count' => 'required|integer',
            'difficult_csat_section' => 'required|string',
            'took_csat_coaching' => 'required|boolean',
            'mock_test_for_csat' => 'required|boolean',
            'practicing_csat_every_day' => 'required|boolean',
        ]);

        try {
            $csatPreparation->update($request->all());
            return redirect()->route('admin.testseries.csat_preparations.index')->with('success', 'CSAT preparation updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating CSAT preparation: '.$e->getMessage());
            return redirect()->route('admin.testseries.csat_preparations.index')->with('error', 'Failed to update CSAT preparation.');
        }
    }

    public function destroy(CsatPreparation $csatPreparation)
    {
        try {
            $csatPreparation->delete();
            return redirect()->route('admin.testseries.csat_preparations.index')->with('success', 'CSAT preparation deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting CSAT preparation: '.$e->getMessage());
            return redirect()->route('admin.testseries.csat_preparations.index')->with('error', 'Failed to delete CSAT preparation.');
        }
    }
}
