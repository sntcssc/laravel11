@extends('admin.layouts.app')

@section('content')
    <h1>Edit Section</h1>
    <form action="{{ route('sections.update', $section->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Section Name</label>
        <input type="text" name="name" value="{{ $section->name }}" required>

        <label for="batch_id">Batch</label>
        <select name="batch_id" required>
            @foreach ($batches as $batch)
                <option value="{{ $batch->id }}" {{ $batch->id == $section->batch_id ? 'selected' : '' }}>
                    {{ $batch->name }}
                </option>
            @endforeach
        </select>

        <label for="seat">Seats</label>
        <input type="number" name="seat" value="{{ $section->seat }}">

        <label for="status">Status</label>
        <select name="status" required>
            <option value="1" {{ $section->status ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$section->status ? 'selected' : '' }}>Inactive</option>
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
