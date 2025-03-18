@extends('layouts.app')

@section('title', 'Detail Karyawan')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Karyawan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Karyawan</a></div>
            <div class="breadcrumb-item">Detail Karyawan</div>
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
                        <h4>Informasi Karyawan</h4>
                        <div class="card-header-action">
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">
                                <i class="fas fa-pencil-alt"></i> Ubah
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center mb-4">
                                @if($employee->profile_picture)
                                    <img src="{{ asset('storage/profile-pictures/' . $employee->profile_picture) }}" 
                                         alt="{{ $employee->full_name }}" 
                                         class="img-fluid rounded shadow" 
                                         style="max-width: 100%; max-height: 250px;">
                                @else
                                    <div class="empty-state" data-height="200">
                                        <div class="empty-state-icon bg-light">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <p class="mt-2 text-muted">Belum ada foto profil</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%">Nama</th>
                                                <td>{{ $employee->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor KTP</th>
                                                <td>{{ $employee->identity_number ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIP</th>
                                                <td>{{ $employee->nip ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Golongan/Pangkat</th>
                                                <td>{{ $employee->rankClass->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Profesi</th>
                                                <td>{{ $employee->position->title ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Unit Kerja</th>
                                                <td>{{ $employee->unit->name ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Status Pegawai</th>
                                                <td>{{ $employee->employment_status ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $employee->user->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Telepon</th>
                                                <td>{{ $employee->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Lahir</th>
                                                <td>{{ $employee->birth_date ? $employee->birth_date->format('d F Y') : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>{{ $employee->gender }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Pernikahan</th>
                                                <td>{{ $employee->marital_status }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="15%">Alamat</th>
                                                <td>{{ $employee->address }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Tinggi Badan</th>
                                        <td>{{ $employee->height_cm }} cm</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Berat Badan</th>
                                        <td>{{ $employee->weight_kg }} kg</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Golongan Darah</th>
                                        <td>{{ $employee->blood_type }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Agama</th>
                                        <td>{{ $employee->religion }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Hobi</th>
                                        <td>{{ $employee->hobbies ?? '-' }}</td>
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
                        <h4>Pendidikan</h4>
                    </div>
                    <div class="card-body">
                        @if($employee->educations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jenis</th>
                                            <th>Institusi</th>
                                            <th>Tingkat</th>
                                            <th>Kursus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->educations as $education)
                                            <tr>
                                                <td>{{ $education->type === 'formal' ? 'Formal' : 'Non-Formal' }}</td>
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
                                <h2>Tidak ada data pendidikan</h2>
                                <p class="lead">
                                    Belum ada data pendidikan yang ditambahkan untuk karyawan ini.
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
                        <h4>Pengalaman Kerja</h4>
                    </div>
                    <div class="card-body">
                        @if($employee->workExperiences->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Perusahaan</th>
                                            <th>Jabatan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->workExperiences as $workExperience)
                                            <tr>
                                                <td>{{ $workExperience->company }}</td>
                                                <td>{{ $workExperience->position ?? '-' }}</td>
                                                <td>{{ $workExperience->start_date ? $workExperience->start_date->format('d M Y') : '-' }}</td>
                                                <td>{{ $workExperience->end_date ? $workExperience->end_date->format('d M Y') : 'Sekarang' }}</td>
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
                                <h2>Tidak ada data pengalaman kerja</h2>
                                <p class="lead">
                                    Belum ada data pengalaman kerja yang ditambahkan untuk karyawan ini.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dokumen Pegawai</h4>
                        <div class="card-header-action">
                            <a href="{{ route('employees.upload-form', $employee) }}" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Dokumen
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($employee->employee_document)
                            <div class="mb-3">
                                <strong>Dokumen Form Data Pegawai:</strong>
                                <div class="mt-2">
                                    <a href="{{ asset('storage/employee-documents/' . $employee->employee_document) }}" class="btn btn-info" target="_blank">
                                        <i class="fas fa-file-alt"></i> Lihat Dokumen
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="empty-state" data-height="300">
                                <div class="empty-state-icon">
                                    <i class="fas fa-file-upload"></i>
                                </div>
                                <h2>Belum ada dokumen</h2>
                                <p class="lead">
                                    Belum ada Form Data Pegawai yang diupload untuk karyawan ini.
                                </p>
                                <a href="{{ route('employees.upload-form', $employee) }}" class="btn btn-primary mt-4">
                                    <i class="fas fa-upload"></i> Upload Dokumen
                                </a>
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