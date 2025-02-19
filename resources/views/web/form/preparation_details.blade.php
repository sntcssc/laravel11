<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preparation Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Preparation Details</h2>

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

    <form action="{{ route('save_preparation_details', ['student_id' => $student->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="highest_education_qualification" class="form-label">Highest Education Qualification</label>
            <input type="text" class="form-control" id="highest_education_qualification" name="highest_education_qualification" value="{{ old('highest_education_qualification') }}" required>
        </div>

        <div class="mb-3">
            <label for="graduation_subject" class="form-label">Graduation Subject</label>
            <input type="text" class="form-control" id="graduation_subject" name="graduation_subject" value="{{ old('graduation_subject') }}" required>
        </div>

        <!-- Add all other fields here in the same structure -->

        <button type="submit" class="btn btn-primary">Save Preparation Details</button>
    </form>
</div>
</body>
</html>
