@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Source Materials for Student</h1>

    <form method="POST" action="{{ route('sources-used.update', $sourcesUsed->id) }}">
        @csrf
        @method('PUT')

        <!-- Unique ID Field (Read-only for editing) -->
        <div class="form-group">
            <label for="unique_id">Unique ID</label>
            <input type="text" name="unique_id" class="form-control @error('unique_id') is-invalid @enderror" value="{{ $sourcesUsed->unique_id }}" readonly>
            @error('unique_id') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <!-- Student Selection -->
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $sourcesUsed->student_id ? 'selected' : '' }}>
                        {{ $student->first_name }}
                    </option>
                @endforeach
            </select>
            @error('student_id') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <!-- Subjects and Materials -->
        <div class="form-group" id="subjects-section">
            <label for="subjects">Subjects and Materials</label>

            @foreach($subjectsMaterials as $index => $subjectMaterial)
                <div class="form-row mt-2">
                    <div class="col">
                        <select name="subjects_materials[{{ $index }}][subject]" class="form-control" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $key => $subject)
                                <option value="{{ $key }}" {{ $key == $subjectMaterial['subject'] ? 'selected' : '' }}>
                                    {{ $subject }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="subjects_materials[{{ $index }}][source_material]" class="form-control" placeholder="Source Material" value="{{ $subjectMaterial['source_material'] }}" required>
                    </div>
                </div>
            @endforeach

            <button type="button" id="add-subject" class="btn btn-primary mt-3">Add More Subjects</button>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>

@section('scripts')
<script>
    let subjectIndex = {{ count($subjectsMaterials) }};

    document.getElementById('add-subject').addEventListener('click', function () {
        let subjectMaterialRow = `
            <div class="form-row mt-2">
                <div class="col">
                    <select name="subjects_materials[${subjectIndex}][subject]" class="form-control" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $key => $subject)
                            <option value="{{ $key }}" {{ old('subjects_materials.${subjectIndex}.subject') == $key ? 'selected' : '' }}>
                                {{ $subject }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="subjects_materials[${subjectIndex}][source_material]" class="form-control" placeholder="Source Material" required>
                </div>
            </div>
        `;
        document.getElementById('subjects-section').insertAdjacentHTML('beforeend', subjectMaterialRow);
        subjectIndex++;
    });
</script>
@endsection
@endsection
