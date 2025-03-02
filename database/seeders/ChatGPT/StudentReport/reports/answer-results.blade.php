<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0">
            {{ $question }}
            <small class="float-end opacity-75">{{ $answers->count() }} responses</small>
        </h5>
    </div>
    
    <div class="card-body p-0">
        @if($answers->isEmpty())
            <div class="p-4 text-center">
                <div class="text-muted mb-3">🗒️ No responses found</div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Response</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($answers as $index => $answer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $answer['student']->id }}</td>
                            <td>{{ $answer['student']->full_name }}</td>
                            <td>{{ $answer['student']->email }}</td>
                            <td>{{ $answer['student']->mobile_number ?? 'N/A' }}</td>
                            <td style="max-width: 400px;">
                                @if(is_array($answer['answer']))
                                    <ul class="mb-0">
                                        @foreach($answer['answer'] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $answer['answer'] ?? 'Not answered' }}
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary view-details" 
                                        data-student-id="{{ $answer['student']->id }}">
                                    <i class="bi bi-eye"></i> View All
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Add Modal Structure -->
    {{-- Add this modal at the bottom of the file --}}
    <div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Student Complete Responses</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>