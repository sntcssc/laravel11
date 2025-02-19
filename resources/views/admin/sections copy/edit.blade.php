@extends('admin.layouts.app')

@section('content')
    <h1>Edit Section</h1>
    <form action="{{ route('sections.update', $section->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Section Name</label>
        <input type="text" name="name" value="{{ $section->name }}" required>
        
        <label for="program_id">Program</label>
        <select name="program_id" required>
            @foreach($programs as $program)
                <option value="{{ $program->id }}" {{ $section->program_id == $program->id ? 'selected' : '' }}>
                    {{ $program->name }}
                </option>
            @endforeach
        </select>
        
        <button type="submit">Update</button>
    </form>
@endsection
