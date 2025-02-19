<form id="verification-form">
    @csrf
    <div class="form-group">
        <label for="student_id">Student ID</label>
        <input type="text" class="form-control" id="student_id" name="student_id" required>
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" required>
    </div>
    <button type="submit" class="btn btn-primary">Verify</button>
</form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).on('submit', '#verification-form', function (e) {
        e.preventDefault();

        let data = $(this).serialize();

        $.ajax({
            url: "{{ route('verify-student') }}",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.success) {
                    window.location.href = '/student/' + response.student_id + '/step-1';
                } else {
                    alert(response.errors);
                }
            }
        });
    });
</script>
