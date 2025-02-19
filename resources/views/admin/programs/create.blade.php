@extends('admin.layouts.app')

@section('content')
    <h1>Add Program</h1>
    <form action="{{ route('programs.store') }}" method="POST">
        @csrf

        <label for="name">Program Name</label>
        <input type="text" name="name" required>

        <label for="description">Description</label>
        <textarea name="description"></textarea>

        <label for="status">Status</label>
        <select name="status" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <button type="submit">Save</button>
    </form>
@endsection
