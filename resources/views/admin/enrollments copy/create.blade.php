
@extends('admin.layouts.app')

@section('content')
    <h1>Enroll {{ $student->name }} in a Program</h1>
    <form action="{{ route('students.enroll', $student->id) }}" method="POST">
        @csrf
        
        <div>
            <label for="program_id">Program</label>
            <select name="program_id" id="program_id" required>
                <option value="">Select Program</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="batch_id">Batch</label>
            <select name="batch_id" id="batch_id">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="section_id">Section</label>
            <select name="section_id" id="section_id">
                <option value="">Select Section</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit">Enroll</button>
    </form>
    <a href="{{ route('students.index') }}">Back to Students List</a>
@endsection