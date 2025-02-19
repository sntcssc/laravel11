<h3>Final Preview</h3>
<div>
    <h5>Student Details:</h5>
    <p>Name: {{ $student->full_name }}</p>
    <p>Address: {{ $student->present_address }}</p>
    <!-- Add other student details here -->

    <form action="{{ route('submit-final', ['studentId' => $student->id]) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
