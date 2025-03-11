@extends('layouts.app')

@section('title', 'Employee Details')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Employee Details</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></div>
            <div class="breadcrumb-item">Employee Details</div>
        </div>
    </div>

    <div class="section-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Employee Information</h4>
                        <div class="card-header-action">
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Name</th>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $employee->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $employee->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>{{ $employee->date_of_birth->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{ $employee->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th>Marital Status</th>
                                        <td>{{ $employee->marital_status }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Address</th>
                                        <td>{{ $employee->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Height</th>
                                        <td>{{ $employee->height_cm }} cm</td>
                                    </tr>
                                    <tr>
                                        <th>Weight</th>
                                        <td>{{ $employee->weight_kg }} kg</td>
                                    </tr>
                                    <tr>
                                        <th>Blood Type</th>
                                        <td>{{ $employee->blood_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th>
                                        <td>{{ $employee->religion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hobby</th>
                                        <td>{{ $employee->hobby }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Education</h4>
                    </div>
                    <div class="card-body">
                        @if($employee->educations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Institution</th>
                                            <th>Level</th>
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->educations as $education)
                                            <tr>
                                                <td>{{ ucfirst($education->type) }}</td>
                                                <td>{{ $education->institution_name }}</td>
                                                <td>{{ $education->level ?? '-' }}</td>
                                                <td>{{ $education->course_name ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <h2>No education records found</h2>
                                <p class="lead">
                                    No education records have been added for this employee yet.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Work Experience Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Work Experience</h4>
                    </div>
                    <div class="card-body">
                        @if($employee->workExperiences->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Position</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->workExperiences as $workExperience)
                                            <tr>
                                                <td>{{ $workExperience->company }}</td>
                                                <td>{{ $workExperience->position ?? '-' }}</td>
                                                <td>{{ $workExperience->start_date ? $workExperience->start_date->format('d M Y') : '-' }}</td>
                                                <td>{{ $workExperience->end_date ? $workExperience->end_date->format('d M Y') : '-' }}</td>
                                                <td>{{ $workExperience->description ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <h2>No work experience records found</h2>
                                <p class="lead">
                                    No work experience records have been added for this employee yet.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <!-- JS Libraries -->
@endpush 