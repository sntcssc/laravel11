@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add New CSAT Preparation</h2>

    <form action="{{ route('csat_preparations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror">
                <option value="">Select a Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" class="form-control @error('unique_id') is-invalid @enderror" id="unique_id" name="unique_id" value="{{ old('unique_id') }}">
            @error('unique_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="isever_failed_csat" class="form-label">Ever Failed CSAT</label>
            <select name="isever_failed_csat" id="isever_failed_csat" class="form-control @error('isever_failed_csat') is-invalid @enderror">
                <option value="1" {{ old('isever_failed_csat') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('isever_failed_csat') == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('isever_failed_csat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="failed_csat_count" class="form-label">Failed CSAT Count</label>
            <input type="number" class="form-control @error('failed_csat_count') is-invalid @enderror" id="failed_csat_count" name="failed_csat_count" value="{{ old('failed_csat_count') }}">
            @error('failed_csat_count')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="difficult_csat_section" class="form-label">Difficult CSAT Section</label>
            <textarea class="form-control @error('difficult_csat_section') is-invalid @enderror" id="difficult_csat_section" name="difficult_csat_section">{{ old('difficult_csat_section') }}</textarea>
            @error('difficult_csat_section')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="took_csat_coaching" class="form-label">Took CSAT Coaching</label>
            <select name="took_csat_coaching" id="took_csat_coaching" class="form-control @error('took_csat_coaching') is-invalid @enderror">
                <option value="1" {{ old('took_csat_coaching') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('took_csat_coaching') == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('took_csat_coaching')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mock_test_for_csat" class="form-label">Mock Test for CSAT</label>
            <select name="mock_test_for_csat" id="mock_test_for_csat" class="form-control @error('mock_test_for_csat') is-invalid @enderror">
                <option value="1" {{ old('mock_test_for_csat') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('mock_test_for_csat') == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('mock_test_for_csat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="practicing_csat_every_day" class="form-label">Practicing CSAT Every Day</label>
            <select name="practicing_csat_every_day" id="practicing_csat_every_day" class="form-control @error('practicing_csat_every_day') is-invalid @enderror">
                <option value="1" {{ old('practicing_csat_every_day') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('practicing_csat_every_day') == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('practicing_csat_every_day')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
