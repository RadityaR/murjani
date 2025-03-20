@extends('layouts.app')

@section('title', 'Dashboard Index')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Navigation</h1>
    </div>

    <div class="section-body">
        @if(session('employee_data_required') || !auth()->user()->employee)
        <div class="row">
            <div class="col-12">
                <div class="card card-large-icons bg-warning text-white">
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="card-body">
                        <h4 class="text-white">Perhatian!</h4>
                        <p>Anda belum melengkapi data pegawai. Untuk dapat mengakses fitur-fitur lainnya dalam sistem, silakan lengkapi data pegawai Anda.</p>
                        <a href="{{ route('employees.create') }}" class="btn btn-light mt-3">
                            <i class="fas fa-user-edit"></i> Lengkapi Data Pegawai
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Employees</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['employees'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Users</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['users'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Form Templates</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['formTemplates'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Form Submissions</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['formSubmissions'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title">Main Features</h2>
        <div class="row">
            <!-- Employee Management -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Employee Management</h4>
                    </div>
                    <div class="card-body">
                        <p>Manage employee profiles, personal information, and documents.</p>
                        <div class="buttons">
                            <a href="{{ route('employees.index') }}" class="btn btn-primary">View Employees</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>User Management</h4>
                    </div>
                    <div class="card-body">
                        <p>Manage system users, roles, and permissions.</p>
                        <div class="buttons">
                            <a href="{{ route('users.index') }}" class="btn btn-primary">Manage Users</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Management -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Document Management</h4>
                    </div>
                    <div class="card-body">
                        <p>Upload, validate, and manage employee documents.</p>
                        <div class="buttons">
                            <a href="{{ route('files.index') }}" class="btn btn-primary">View Documents</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Templates -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Templates</h4>
                    </div>
                    <div class="card-body">
                        <p>Create and manage form templates for data collection.</p>
                        <div class="buttons">
                            <a href="{{ route('form-templates.index') }}" class="btn btn-primary">Manage Templates</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Submissions -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Submissions</h4>
                    </div>
                    <div class="card-body">
                        <p>View and manage form submissions from employees.</p>
                        <div class="buttons">
                            <a href="{{ route('form-submissions.index') }}" class="btn btn-primary">View Submissions</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile & Settings -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile & Settings</h4>
                    </div>
                    <div class="card-body">
                        <p>Update your profile information and account settings.</p>
                        <div class="buttons">
                            <a href="{{ url('profile/edit') }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title">Latest Activity</h2>
        <div class="row">
            <!-- Latest Employees -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Employees</h4>
                        <div class="card-header-action">
                            <a href="{{ route('employees.index') }}" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestEmployees as $employee)
                                    <tr>
                                        <td>{{ $employee->nip }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>
                                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No employees found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Form Submissions -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Form Submissions</h4>
                        <div class="card-header-action">
                            <a href="{{ route('form-submissions.index') }}" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Form</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestFormSubmissions as $submission)
                                    <tr>
                                        <td>{{ $submission->id }}</td>
                                        <td>{{ $submission->form_template ? $submission->form_template->title : 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $submission->status == 'approved' ? 'success' : ($submission->status == 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($submission->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('form-submissions.show', $submission) }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No submissions found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 