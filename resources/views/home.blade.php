@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="section-body">
            @if(auth()->user()->role === 'admin')
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\User::count() }}
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
                                <h4>Admin Users</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\User::where('role', 'admin')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>HR Users</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\User::where('role', 'hr')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Regular Users</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\User::where('role', 'user')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pegawai Terbaru</h4>
                            <div class="card-header-action">
                                <a href="{{ route('employees.index') }}" class="btn btn-primary">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="employee-table">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Golongan</th>
                                            <th>Jabatan</th>
                                            <th>Unit Kerja</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $latestEmployees = \App\Models\Employee::latest()->take(5)->get();
                                        @endphp
                                        @foreach($latestEmployees as $employee)
                                        <tr>
                                            <td>{{ $employee->nip }}</td>
                                            <td>{{ $employee->nama }}</td>
                                            <td>{{ $employee->golongan }}</td>
                                            <td>{{ $employee->jabatan }}</td>
                                            <td>{{ $employee->unit_kerja }}</td>
                                            <td>
                                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Informasi Pegawai</h4>
                        </div>
                        <div class="card-body">
                            @if($employee)
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="mb-3">
                                            <img src="{{ $employee->photo ? asset('storage/employee-photos/'.$employee->photo) : asset('img/avatar/avatar-1.png') }}" 
                                                alt="Profile Photo" class="rounded-circle" width="150" height="150">
                                        </div>
                                        <h4>{{ $employee->nama }}</h4>
                                        <p class="text-muted">{{ $employee->nip }}</p>
                                        <p class="badge badge-primary">{{ $employee->jabatan }}</p>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Golongan/Pangkat</label>
                                                    <p class="form-control-static">{{ $employee->golongan ?: '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Unit Kerja</label>
                                                    <p class="form-control-static">{{ $employee->unit_kerja ?: '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <p class="form-control-static">{{ $employee->email ?: '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Telepon</label>
                                                    <p class="form-control-static">{{ $employee->telepon ?: '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <p class="form-control-static">{{ $employee->alamat ?: '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Dokumen</label>
                                                    <p class="form-control-static">
                                                        @if($employee->employee_document)
                                                            <a href="{{ asset('storage/employee-documents/'.$employee->employee_document) }}" 
                                                               target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-file-download"></i> Download Dokumen
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Belum ada dokumen</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Edit Profil
                                                </a>
                                                <a href="{{ route('employees.upload-document', $employee) }}" class="btn btn-warning">
                                                    <i class="fas fa-file-upload"></i> Upload Dokumen
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>Anda belum memiliki data pegawai</h2>
                                    <p class="lead">
                                        Silakan lengkapi data pegawai Anda terlebih dahulu untuk mengakses fitur lainnya.
                                    </p>
                                    <a href="{{ route('employees.create') }}" class="btn btn-primary mt-4">Lengkapi Data Pegawai</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengumuman Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Informasi Sistem</h5>
                                <p>Selamat datang di Sistem Informasi Kepegawaian. Sistem ini digunakan untuk mengelola data pegawai dan informasi terkait.</p>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle"></i> Pengumuman Penting</h5>
                                <p>Mohon untuk selalu memperbarui data pegawai Anda secara berkala untuk memastikan informasi yang akurat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    
    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable for employee table
            $('#employee-table').DataTable({
                "paging": false,
                "ordering": true,
                "info": false,
                "searching": false
            });
        });
    </script>
@endpush
