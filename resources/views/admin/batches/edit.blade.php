@extends('admin.layouts.app')

@section('content')
    <h1>Edit Batch</h1>
    <form action="{{ route('batches.update', $batch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Batch Name</label>
        <input type="text" name="name" value="{{ $batch->name }}" required>

        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" value="{{ $batch->start_date ? $batch->start_date->format('Y-m-d') : '' }}">

        <label for="end_date">End Date</label>
        <input type="date" name="end_date" value="{{ $batch->end_date->format('Y-m-d') }}" required>

        <label for="status">Status</label>
        <select name="status" required>
            <option value="1" {{ $batch->status ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$batch->status ? 'selected' : '' }}>Inactive</option>
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
