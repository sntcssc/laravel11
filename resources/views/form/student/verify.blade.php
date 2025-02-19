<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Student Verification</h4>
                    </div>
                    <div class="card-body">
                        <form id="verificationForm">
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student ID</label>
                                <input type="text" id="student_id" name="student_id" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" id="dob" name="dob" class="form-control" required>
                            </div>
                            <div id="error-message" class="text-danger mb-3"></div>
                            <button type="submit" class="btn btn-primary w-100">Verify & Proceed</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#verificationForm").submit(function(event){
                event.preventDefault();
                $("#error-message").text('');

                $.ajax({
                    url: "{{ route('student.verify.post') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            $("#error-message").text(response.message);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
