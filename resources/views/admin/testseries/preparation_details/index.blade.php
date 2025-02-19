@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Preparation Details</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Display preparation details in a table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Unique ID</th>
                <th>Student Name</th>
                <th>Highest Education</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($preparationDetails as $detail)
                <tr>
                    <td>{{ $detail->unique_id }}</td>
                    <td>{{ $detail->student->name }}</td>
                    <td>{{ $detail->highest_education_qualification }}</td>
                    <td>
                        <a href="{{ route('preparation_details.edit', $detail) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete Button -->
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $detail->id }}">Delete</button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $detail->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this preparation detail?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('preparation_details.destroy', $detail) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('preparation_details.create') }}" class="btn btn-primary">Create New</a>
</div>
@endsection
