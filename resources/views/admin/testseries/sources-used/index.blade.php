@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Sources Used</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('sources-used.create') }}" class="btn btn-primary mb-3">Create Source Used</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Source Material</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sourcesUsed as $source)
                <tr>
                    <td>{{ $source->student->first_name }}</td>
                    <td>{{ $source->subject }}</td>
                    <td>{{ Str::limit($source->source_material, 50) }}</td>
                    <td>
                        <a href="{{ route('sources-used.show', $source->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('sources-used.edit', $source->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('sources-used.destroy', $source->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
