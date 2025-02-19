@extends('admin.layouts.app')

@section('content')
    <h1>Add New Batch</h1>
    <form action="{{ route('batches.store') }}" method="POST">
        @csrf

        <label for="name">Batch Name</label>
        <input type="text" name="name" required>

        <label for="start_date">Start Date</label>
        <input type="date" name="start_date">

        <label for="end_date">End Date</label>
        <input type="date" name="end_date" required>

        <label for="status">Status</label>
        <select name="status" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <button type="submit">Save</button>
    </form>
@endsection
