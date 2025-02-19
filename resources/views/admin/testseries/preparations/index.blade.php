@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Additional Preparations</h1>

        <a href="{{ route('preparations.create') }}" class="btn btn-primary mb-3">Add New Preparation</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Unique ID</th>
                    <th>Coaching Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($preparations as $preparation)
                    <tr>
                        <td>{{ $preparation->id }}</td>
                        <td>{{ $preparation->student->first_name }}</td>
                        <td>{{ $preparation->unique_id }}</td>
                        <td>{{ $preparation->coaching_name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('preparations.edit', $preparation->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Button triggers modal -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                    data-id="{{ $preparation->id }}" data-name="{{ $preparation->unique_id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Reusable Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the preparation for <strong id="prep-name"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="delete-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Modal Script -->
    <script>
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var prepId = button.getAttribute('data-id');
            var prepName = button.getAttribute('data-name');

            var modalTitle = deleteModal.querySelector('.modal-title');
            var prepNameElement = deleteModal.querySelector('#prep-name');
            var form = deleteModal.querySelector('#delete-form');

            modalTitle.textContent = 'Confirm Deletion';
            prepNameElement.textContent = prepName;
            form.action = '/preparations/' + prepId;
        });
    </script>
@endsection
