@extends('admin.layouts.app')

@section('content')
    <h1>Edit Program</h1>
    <form action="{{ route('programs.update', $program->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Program Name</label>
        <input type="text" name="name" value="{{ $program->name }}" required>

        <label for="description">Description</label>
        <textarea name="description">{{ $program->description }}</textarea>

        <label for="status">Status</label>
        <select name="status" required>
            <option value="1" {{ $program->status ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$program->status ? 'selected' : '' }}>Inactive</option>
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
