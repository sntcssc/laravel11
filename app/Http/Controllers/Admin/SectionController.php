<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Batch;

class SectionController extends Controller
{
    // Display a listing of sections
    public function index()
    {
        $sections = Section::all(); // Get all sections
        return view('admin.sections.index', compact('sections'));
    }

    // Show the form for creating a new section
    public function create()
    {
        $batches = Batch::all(); // Get all batches to show in a dropdown
        return view('admin.sections.create', compact('batches'));
    }

    // Store a newly created section in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections',
            'batch_id' => 'required|exists:batches,id',
            'seat' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        Section::create([
            'name' => $request->name,
            'batch_id' => $request->batch_id,
            'seat' => $request->seat,
            'status' => $request->status,
        ]);

        return redirect()->route('sections.index')->with('success', 'Section created successfully');
    }

    // Show the form for editing the specified section
    public function edit(Section $section)
    {
        $batches = Batch::all(); // Get all batches to show in a dropdown
        return view('admin.sections.edit', compact('section', 'batches'));
    }

    // Update the specified section in storage
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|unique:sections,name,' . $section->id,
            'batch_id' => 'required|exists:batches,id',
            'seat' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $section->update([
            'name' => $request->name,
            'batch_id' => $request->batch_id,
            'seat' => $request->seat,
            'status' => $request->status,
        ]);

        return redirect()->route('sections.index')->with('success', 'Section updated successfully');
    }

    // Display the specified section
    public function show(Section $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    // Remove the specified section from storage
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully');
    }
}
