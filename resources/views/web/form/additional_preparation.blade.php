<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Preparation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Additional Preparation</h2>

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

    <form action="{{ route('save_additional_preparation', ['student_id' => $student->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="youtube_channels_followed" class="form-label">YouTube Channels Followed</label>
            <input type="text" class="form-control" id="youtube_channels_followed" name="youtube_channels_followed" value="{{ old('youtube_channels_followed') }}">
        </div>

        <div class="mb-3">
            <label for="other_coaching_programs" class="form-label">Other Coaching Programs</label>
            <input type="text" class="form-control" id="other_coaching_programs" name="other_coaching_programs" value="{{ old('other_coaching_programs') }}">
        </div>

        <div class="mb-3">
            <label for="coaching_name" class="form-label">Coaching Name</label>
            <input type="text" class="form-control" id="coaching_name" name="coaching_name" value="{{ old('coaching_name') }}">
        </div>

        <div class="mb-3">
            <label for="coaching_program_details" class="form-label">Coaching Program Details</label>
            <textarea class="form-control" id="coaching_program_details" name="coaching_program_details">{{ old('coaching_program_details') }}</textarea>
        </div>

        <!-- Add other fields as needed -->

        <button type="submit" class="btn btn-primary">Save Additional Preparation</button>
    </form>
</div>
</body>
</html>
