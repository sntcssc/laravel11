@extends('admin.layouts.app')

@section('content')
    <h1>Batches</h1>
    <a href="{{ route('batches.create') }}">Add New Batch</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($batches as $batch)
                <tr>
                    <td>{{ $batch->name }}</td>
                    <td>{{ $batch->start_date ? $batch->start_date->format('d-m-Y') : 'N/A' }}</td>
                    <td>{{ $batch->end_date->format('d-m-Y') }}</td>
                    <td>{{ $batch->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('batches.show', $batch->id) }}">View</a>
                        <a href="{{ route('batches.edit', $batch->id) }}">Edit</a>
                        <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" style="display:inline;">
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
