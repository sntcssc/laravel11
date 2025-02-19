@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Personality Details</h2>
    <a href="{{ route('personality_details.create') }}" class="btn btn-primary mb-3">Create New Personality Detail</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Unique ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personalityDetails as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->student->first_name }}</td>
                        <td>{{ $detail->unique_id }}</td>
                        <td>
                            <a href="{{ route('personality_details.show', $detail->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('personality_details.edit', $detail->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('personality_details.destroy', $detail->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record? This action cannot be undone!')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
