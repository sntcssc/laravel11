@extends('admin.layouts.app')

@section('content')
    <h1>Programs</h1>
    <a href="{{ route('programs.create') }}">Add New Program</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programs as $program)
                <tr>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->description }}</td>
                    <td>{{ $program->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('programs.show', $program->id) }}">View</a>
                        <a href="{{ route('programs.edit', $program->id) }}">Edit</a>
                        <form action="{{ route('programs.destroy', $program->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
