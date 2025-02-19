@extends('admin.layouts.app')

@section('content')
    <h1>Add New Section</h1>
    <form action="{{ route('sections.store') }}" method="POST">
        @csrf

        <label for="name">Section Name</label>
        <input type="text" name="name" required>

        <label for="batch_id">Batch</label>
        <select name="batch_id" required>
            @foreach ($batches as $batch)
                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
            @endforeach
        </select>

        <label for="seat">Seats</label>
        <input type="number" name="seat">

        <label for="status">Status</label>
        <select name="status" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <button type="submit">Save</button>
    </form>
@endsection
