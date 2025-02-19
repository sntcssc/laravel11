@extends('admin.layouts.app')

@section('content')
    <h1>Add Section</h1>
    <form action="{{ route('sections.store') }}" method="POST">
        @csrf
        <label for="name">Section Name</label>
        <input type="text" name="name" required>
        
        <label for="program_id">Program</label>
        <select name="program_id" required>
            @foreach($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
            @endforeach
        </select>
        
        <button type="submit">Save</button>
    </form>
@endsection
