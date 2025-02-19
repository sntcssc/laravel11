@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Source Used</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('sources-used.update', $sourcesUsed->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $sourcesUsed->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }}
                    </option>
                @endforeach
            </select>
            @error('student_id') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="form-group">
            <label for="unique_id">Unique ID</label>
            <input type="text" name="unique_id" class="form-control @error('unique_id') is-invalid @enderror" 
                   value="{{ old('unique_id', $sourcesUsed->unique_id) }}" placeholder="Enter the unique student ID" required>
            @error('unique_id') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>

                        <select name="subject" class="form-control @error('subject') is-invalid @enderror"  required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $key => $subject)
                                <option value="{{ $key }}" {{ $key == $sourcesUsed->subject ? 'selected' : '' }}>
                                    {{ $subject }}
                                </option>
                            @endforeach
                        </select>
            @error('subject') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="form-group">
            <label for="source_material">Source Material</label>
            <textarea name="source_material" class="form-control @error('source_material') is-invalid @enderror" 
                      rows="4" placeholder="Enter the source material details" required>{{ old('source_material', $sourcesUsed->source_material) }}</textarea>
            @error('source_material') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
