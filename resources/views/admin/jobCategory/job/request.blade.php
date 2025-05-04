@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.jobCategory.index') }}">Job Categories</a> /
    <a href="{{ route('admin.jobCategory.job.index', ['jobCategory_id' => $jobCategory->id]) }}">Jobs</a> /
    <span>Requests</span>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>By</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobRequests as $jobRequest)
                <tr>
                    <td>{{ $jobRequest->name }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="{{ '#jobRequestModal' . $jobRequest->id }}"
                            class="btn btn-info btn-sm ">View</button>
                        <a href="{{ route('admin.jobCategory.job.delRequest', ['jobRequestId' => $jobRequest->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <div class="modal fade" id="{{ 'jobRequestModal' . $jobRequest->id }}" tabindex="-1"
                    aria-labelledby="jobRequestModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="jobRequestModalLabel">Job Request Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <!-- Personal Information Section -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="border-bottom pb-2">Personal Information</h5>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p><strong>Name:</strong> {{ $jobRequest->name }}</p>
                                            <p><strong>Email:</strong> <a
                                                    href="mailto:{{ $jobRequest->email }}">{{ $jobRequest->email }}</a></p>
                                            <p><strong>Phone Number:</strong> {{ $jobRequest->phone_number }}</p>
                                            <p><strong>Date of Birth:</strong> {{ $jobRequest->date_of_birth }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p><strong>Gender:</strong> {{ ucfirst($jobRequest->gender) }}</p>
                                            <p><strong>Experience Type:</strong> {{ ucfirst($jobRequest->experience) }}</p>
                                            <p><strong>Years of Experience:</strong> {{ $jobRequest->year_of_experience }}
                                            </p>
                                            <p><strong>Job ID:</strong> {{ $jobRequest->job_id }}</p>
                                        </div>
                                    </div>

                                    <!-- Professional Information Section -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="border-bottom pb-2">Professional Information</h5>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p><strong>Previous Organization:</strong>
                                                {{ $jobRequest->old_organization ?: 'N/A' }}</p>
                                            <p><strong>Current Designation:</strong>
                                                {{ $jobRequest->current_designation ?: 'N/A' }}</p>
                                            <p><strong>Department:</strong> {{ $jobRequest->department }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p><strong>Current Annual CTC:</strong>
                                                {{ $jobRequest->current_annual_ctc ? 'Rs. ' . number_format($jobRequest->current_annual_ctc, 0) : 'N/A' }}
                                            </p>
                                            <p><strong>Expected Annual CTC:</strong>
                                                {{ 'Rs. ' . number_format($jobRequest->expected_annual_ctc, 0) }}</p>
                                            <p><strong>Notice Period:</strong> {{ $jobRequest->notice_period ?: 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <p><strong>Reason for Change:</strong></p>
                                            <div class="p-2 bg-light rounded">
                                                {{ $jobRequest->reason_of_change ?: 'Not specified' }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Educational Information Section -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="border-bottom pb-2">Educational Information</h5>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p><strong>Institution Name:</strong> {{ $jobRequest->institution_name }}</p>
                                            <p><strong>Degree:</strong> {{ $jobRequest->degree }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p><strong>Year of Completion:</strong> {{ $jobRequest->year_of_completion }}
                                            </p>
                                            <p><strong>Percentage/CGPA:</strong> {{ $jobRequest->percent_or_cgpa }}</p>
                                        </div>
                                    </div>

                                    <!-- Additional Information Section -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="border-bottom pb-2">Additional Information</h5>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <p><strong>Message:</strong></p>
                                            <div class="p-2 bg-light rounded">
                                                {{ $jobRequest->message ?: 'No message provided' }}
                                            </div>
                                        </div>
                                        @if ($jobRequest->resume)
                                            <div class="col-12 mb-3">
                                                <p><strong>Resume:</strong></p>
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="{{ '#resumePreviewModal' . $jobRequest->id }}">
                                                        <i class="fas fa-eye"></i> Preview Resume
                                                    </button>
                                                    <a href="{{ asset($jobRequest->resume) }}"
                                                        class="btn btn-sm btn-secondary" target="_blank">
                                                        <i class="bi bi-file"></i> Download Resume
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Resume Preview Modal -->
                <div class="modal fade" id="{{ 'resumePreviewModal' . $jobRequest->id }}" tabindex="-1"
                    aria-labelledby="resumePreviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="resumePreviewModalLabel">Resume Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <!-- PDF Embedded Viewer -->
                                <div class="ratio ratio-16x9" style="min-height: 80vh;">
                                    <object data="{{ asset($jobRequest->resume) }}#toolbar=0&navpanes=0"
                                        type="application/pdf" width="100%" height="100%">
                                        <div
                                            class="d-flex justify-content-center align-items-center bg-light h-100 flex-column">
                                            <p class="text-danger mb-3">Your browser doesn't support embedded PDF viewing.
                                            </p>
                                            <a href="{{ asset($jobRequest->resume) }}" class="btn btn-primary"
                                                target="_blank">Open
                                                PDF in New Tab</a>
                                        </div>
                                    </object>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ asset('storage/' . $jobRequest->resume) }}" class="btn btn-primary"
                                    download>Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Manage</th>
            </tr>
        </tfoot>
    </table>
@endsection
