<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;

class BatchController extends Controller
{
    // Display a listing of batches
    public function index()
    {
        $batches = Batch::all(); // Get all batches
        return view('admin.batches.index', compact('batches'));
    }

    // Show the form for creating a new batch
    public function create()
    {
        return view('admin.batches.create');
    }

    // Store a newly created batch in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:batches',
            'start_date' => 'nullable|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|boolean',
        ]);

        Batch::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch created successfully');
    }

    // Show the form for editing the specified batch
    public function edit(Batch $batch)
    {
        return view('admin.batches.edit', compact('batch'));
    }

    // Update the specified batch in storage
    public function update(Request $request, Batch $batch)
    {
        $request->validate([
            'name' => 'required|unique:batches,name,' . $batch->id,
            'start_date' => 'nullable|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|boolean',
        ]);

        $batch->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch updated successfully');
    }

    // Display the specified batch
    public function show(Batch $batch)
    {
        return view('admin.batches.show', compact('batch'));
    }

    // Remove the specified batch from storage
    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully');
    }
}
