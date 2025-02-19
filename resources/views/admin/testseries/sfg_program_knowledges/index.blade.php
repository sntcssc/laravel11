@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>SFG Program Knowledge List</h2>

    <!-- Flash Message for success -->

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('sfg_program_knowledges.create') }}" class="btn btn-primary">Add New Record</a>
    </div>

    <!-- Table of SFG Program Knowledge Records -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Unique ID</th>
                <th>Key Features</th>
                <th>Test Participation</th>
                <th>Highest Test Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programKnowledges as $programKnowledge)
                <tr>
                    <td>{{ $programKnowledge->student->first_name }}</td>
                    <td>{{ $programKnowledge->unique_id }}</td>
                    <td>{{ Str::limit($programKnowledge->key_features_of_sfg_program, 50) }}</td>
                    <td>{{ $programKnowledge->regular_test_participation ? 'Yes' : 'No' }}</td>
                    <td>{{ $programKnowledge->highest_test_score }}</td>
                    <td>
                        <a href="{{ route('sfg_program_knowledges.show', $programKnowledge->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('sfg_program_knowledges.edit', $programKnowledge->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('sfg_program_knowledges.destroy', $programKnowledge->id) }}')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $programKnowledges->links() }}
    </div>
</div>

@include('components.delete-modal')

@endsection
