@extends('admin.layouts.app')

@section('content')
    <h1>Sections</h1>
    <a href="{{ route('sections.create') }}">Add New Section</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Program</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
                <tr>
                    <td>{{ $section->name }}</td>
                    <td>{{ $section->program->name }}</td>
                    <td>
                        <a href="{{ route('sections.show', $section->id) }}">View</a>
                        <a href="{{ route('sections.edit', $section->id) }}">Edit</a>
                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST">
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
