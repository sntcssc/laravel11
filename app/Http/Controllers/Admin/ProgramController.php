<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    // Display a listing of programs
    public function index()
    {
        $programs = Program::all(); // Get all programs
        return view('admin.programs.index', compact('programs'));
    }

    // Show the form for creating a new program
    public function create()
    {
        return view('admin.programs.create');
    }

    // Store a newly created program in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:programs',
            'description' => 'nullable',
            'status' => 'required|boolean',
        ]);

        Program::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('programs.index')->with('success', 'Program created successfully');
    }

    // Show the form for editing the specified program
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    // Update the specified program in storage
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|unique:programs,name,' . $program->id,
            'description' => 'nullable',
            'status' => 'required|boolean',
        ]);

        $program->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('programs.index')->with('success', 'Program updated successfully');
    }

    // Display the specified program
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    // Remove the specified program from storage
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program deleted successfully');
    }
}
