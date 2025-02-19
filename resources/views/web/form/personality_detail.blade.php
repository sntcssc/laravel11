<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Personality Details</h2>

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

    <form action="{{ route('save_personality_detail', ['student_id' => $student->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="reason_for_civil_services" class="form-label">Reason for Civil Services</label>
            <input type="text" class="form-control" id="reason_for_civil_services" name="reason_for_civil_services" value="{{ old('reason_for_civil_services') }}" required>
        </div>

        <div class="mb-3">
            <label for="essential_values_for_topping" class="form-label">Essential Values for Topping</label>
            <input type="text" class="form-control" id="essential_values_for_topping" name="essential_values_for_topping" value="{{ old('essential_values_for_topping') }}" required>
        </div>

        <!-- Add other fields as needed -->

        <button type="submit" class="btn btn-primary">Save Personality Details</button>
    </form>
</div>
</body>
</html>
