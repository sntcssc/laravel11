<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFG Program Knowledge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">SFG Program Knowledge</h2>

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

    <form action="{{ route('save_sfg_program_knowledge', ['student_id' => $student->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="key_features_of_sfg_program" class="form-label">Key Features of SFG Program</label>
            <textarea class="form-control" id="key_features_of_sfg_program" name="key_features_of_sfg_program" required>{{ old('key_features_of_sfg_program') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ways_sfg_will_help_in_exam" class="form-label">Ways SFG Will Help in Exam</label>
            <textarea class="form-control" id="ways_sfg_will_help_in_exam" name="ways_sfg_will_help_in_exam" required>{{ old('ways_sfg_will_help_in_exam') }}</textarea>
        </div>

        <!-- Add other fields as needed -->

        <button type="submit" class="btn btn-primary">Save SFG Program Knowledge</button>
    </form>
</div>
</body>
</html>
