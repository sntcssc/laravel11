<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Step 1 - Personal Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Step 1: Personal Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="personalDetailsForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Student ID</label>
                                    <input type="number" name="unique_id" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Father's Name</label>
                                    <input type="text" name="father_name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Father's Occupation</label>
                                    <input type="text" name="father_occupation" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Mother's Name</label>
                                    <input type="text" name="mother_name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Mother's Occupation</label>
                                    <input type="text" name="mother_occupation" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" name="mobile_number" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">WhatsApp Number</label>
                                    <input type="text" name="whatsapp_number" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Upload Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                            </div>
                            <div id="error-message" class="text-danger mb-3"></div>
                            <button type="submit" class="btn btn-primary w-100">Save & Preview</button>
                        </form>
                    </div>
                </div>

                <div id="previewSection" class="mt-4 d-none">
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">
                            <h5>Preview Your Details</h5>
                        </div>
                        <div class="card-body">
                            <ul id="previewList" class="list-group"></ul>
                            <button id="confirmDetails" class="btn btn-success mt-3 w-100">Confirm & Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#personalDetailsForm").submit(function(event){
                event.preventDefault();
                $("#error-message").text('');

                $.ajax({
                    url: "{{ route('student.registration.step1.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    success: function(response) {
                        if (response.success) {
                            $("#previewList").empty();
                            $.each(response.data, function(key, value) {
                                $("#previewList").append(`<li class="list-group-item"><strong>${key}:</strong> ${value}</li>`);
                            });
                            $("#previewSection").removeClass("d-none");
                        } else {
                            $("#error-message").text(response.message);
                        }
                    }
                });
            });

            $("#confirmDetails").click(function(){
                $.post("{{ route('student.registration.step1.confirm') }}", {_token: "{{ csrf_token() }}"}, function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    }
                });
            });
        });
    </script>
</body>
</html>
