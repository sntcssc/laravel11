@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Source Materials for {{ $sourceUsed->student->name }}</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Source Material</th>
                </tr>
            </thead>
            <tbody>
                @foreach(json_decode($sourceUsed->subjects_materials, true) as $subject => $material)
                    <tr>
                        <td>{{ $subject }}</td>
                        <td>{{ $material }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('sources-used.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
