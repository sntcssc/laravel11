@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Source Used Details</h1>

    <div class="mb-3">
        <strong>Student:</strong> {{ $sourcesUsed->student->name }}
    </div>
    <div class="mb-3">
        <strong>Unique ID:</strong> {{ $sourcesUsed->unique_id }}
    </div>
    <div class="mb-3">
        <strong>Subject:</strong> {{ $sourcesUsed->subject }}
    </div>
    <div class="mb-3">
        <strong>Source Material:</strong> {{ $sourcesUsed->source_material }}
    </div>

    <a href="{{ route('sources-used.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
