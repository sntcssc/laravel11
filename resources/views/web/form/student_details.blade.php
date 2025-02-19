<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Student Details</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('save_student_details', ['student_id' => $student->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="self_study_hours" class="form-label">Self Study Hours</label>
            <input type="number" class="form-control" id="self_study_hours" name="self_study_hours" value="{{ old('self_study_hours') }}" required>
        </div>

        <div class="mb-3">
            <label for="has_separate_study_room" class="form-label">Has Separate Study Room?</label>
            <select class="form-control" id="has_separate_study_room" name="has_separate_study_room" required>
                <option value="1" {{ old('has_separate_study_room') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('has_separate_study_room') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="is_in_hostel" class="form-label">Is In Hostel?</label>
            <select class="form-control" id="is_in_hostel" name="is_in_hostel" required>
                <option value="1" {{ old('is_in_hostel') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_in_hostel') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Add the remaining fields in the same way -->

        <button type="submit" class="btn btn-primary">Save Student Details</button>
    </form>
</div>
</body>
</html>
