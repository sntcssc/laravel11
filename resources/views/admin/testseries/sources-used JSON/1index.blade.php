@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Source Materials List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Subjects</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sourcesUsed as $sourceUsed)
                <tr>
                    <td>{{ $sourceUsed->student->name }}</td>
                    <td>
                        @foreach(json_decode($sourceUsed->subjects_materials, true) as $subject => $material)
                            <strong>{{ $subject }}:</strong> {{ $material }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('sources-used.edit', $sourceUsed->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('sources-used.destroy', $sourceUsed->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
