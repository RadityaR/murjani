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
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Nama</th>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor KTP</th>
                                        <td>{{ $employee->ktp_number ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIP</th>
                                        <td>{{ $employee->nip ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Golongan</th>
                                        <td>{{ $employee->golongan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pegawai</th>
                                        <td>{{ $employee->employee_status ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $employee->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>{{ $employee->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ $employee->date_of_birth->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $employee->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pernikahan</th>
                                        <td>{{ $employee->marital_status }}</td>
                                    </tr>
                                    <tr>
                                        <th>SIP</th>
                                        <td>{{ $employee->sip ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Alamat</th>
                                        <td>{{ $employee->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tinggi Badan</th>
                                        <td>{{ $employee->height_cm }} cm</td>
                                    </tr>
                                    <tr>
                                        <th>Berat Badan</th>
                                        <td>{{ $employee->weight_kg }} kg</td>
                                    </tr>
                                    <tr>
                                        <th>Golongan Darah</th>
                                        <td>{{ $employee->blood_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>{{ $employee->religion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hobi</th>
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
    </div>
</section>
@endsection

@push('scripts')
    <!-- JS Libraries -->
@endpush 