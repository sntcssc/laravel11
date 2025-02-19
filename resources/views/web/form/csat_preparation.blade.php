<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSAT Preparation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">CSAT Preparation</h2>

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

    <form action="{{ route('save_csat_preparation', ['student_id' => $student->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="isever_failed_csat" class="form-label">Ever Failed CSAT?</label>
            <select class="form-control" id="isever_failed_csat" name="isever_failed_csat" required>
                <option value="1" {{ old('isever_failed_csat') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('isever_failed_csat') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="failed_csat_count" class="form-label">Failed CSAT Count</label>
            <input type="number" class="form-control" id="failed_csat_count" name="failed_csat_count" value="{{ old('failed_csat_count') }}">
        </div>

        <div class="mb-3">
            <label for="difficult_csat_section" class="form-label">Difficult CSAT Section</label>
            <input type="text" class="form-control" id="difficult_csat_section" name="difficult_csat_section" value="{{ old('difficult_csat_section') }}">
        </div>

        <div class="mb-3">
            <label for="took_csat_coaching" class="form-label">Took CSAT Coaching?</label>
            <select class="form-control" id="took_csat_coaching" name="took_csat_coaching" required>
                <option value="1" {{ old('took_csat_coaching') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('took_csat_coaching') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Add other fields as needed -->

        <button type="submit" class="btn btn-primary">Save CSAT Preparation</button>
    </form>
</div>
</body>
</html>
