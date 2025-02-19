@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h2>CSAT Preparations</h2>
        <a href="{{ route('csat_preparations.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Unique ID</th>
                <th>Failed CSAT Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($csatPreparations as $csatPreparation)
                <tr>
                    <td>{{ $csatPreparation->id }}</td>
                    <td>{{ $csatPreparation->student->name }}</td>
                    <td>{{ $csatPreparation->unique_id }}</td>
                    <td>{{ $csatPreparation->failed_csat_count }}</td>
                    <td>
                        <a href="{{ route('csat_preparations.show', $csatPreparation) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('csat_preparations.edit', $csatPreparation) }}" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Reusable Delete Component -->
                        @include('components.delete', ['route' => route('csat_preparations.destroy', $csatPreparation)])
                    </td>

                    <td class="d-none">
                        <a href="{{ route('csat_preparations.edit', $csatPreparation) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('csat_preparations.destroy', $csatPreparation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
