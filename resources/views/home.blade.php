@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

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
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unit-filter">Filter Unit Kerja:</label>
                                        <select class="form-control select2" id="unit-filter">
                                            <option value="">Semua Unit Kerja</option>
                                            @php
                                                $units = \App\Models\Employee::distinct('unit_kerja')->pluck('unit_kerja');
                                            @endphp
                                            @foreach($units as $unit)
                                                <option value="{{ $unit }}">{{ $unit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="jabatan-filter">Filter Jabatan:</label>
                                        <select class="form-control select2" id="jabatan-filter">
                                            <option value="">Semua Jabatan</option>
                                            @php
                                                $jabatan = \App\Models\Employee::distinct('jabatan')->pluck('jabatan');
                                            @endphp
                                            @foreach($jabatan as $jab)
                                                <option value="{{ $jab }}">{{ $jab }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="search-name">Cari Nama:</label>
                                        <input type="text" class="form-control" id="search-name" placeholder="Ketik nama pegawai...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-primary btn-block" id="reset-filters">
                                            <i class="fas fa-sync-alt"></i> Reset Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="employees-table">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Golongan</th>
                                            <th>Status</th>
                                            <th>Unit Kerja</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\Employee::latest()->take(5)->get() as $employee)
                                        <tr>
                                            <td>{{ $employee->nip }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->jabatan }}</td>
                                            <td>{{ $employee->golongan }}</td>
                                            <td>
                                                <div class="badge badge-{{ $employee->employee_status == 'PNS' ? 'info' : ($employee->employee_status == 'Kontrak' ? 'warning' : 'light') }}">
                                                    {{ $employee->employee_status }}
                                                </div>
                                            </td>
                                            <td>{{ $employee->unit_kerja }}</td>
                                            <td>
                                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
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
                            <h4>Data Pegawai Saya</h4>
                        </div>
                        <div class="card-body">
                            @if($employee)
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%">Nama</th>
                                                <td>{{ $employee->name }}</td>
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
                                                <th>Jabatan</th>
                                                <td>{{ $employee->jabatan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Pegawai</th>
                                                <td>{{ $employee->employee_status ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Unit Kerja</th>
                                                <td>{{ $employee->unit_kerja ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $employee->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Telepon</th>
                                                <td>{{ $employee->phone }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%">Tanggal Lahir</th>
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
                                                <th>Agama</th>
                                                <td>{{ $employee->religion }}</td>
                                            </tr>
                                            <tr>
                                                <th>Golongan Darah</th>
                                                <td>{{ $employee->blood_type }}</td>
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
                                                <th>Hobi</th>
                                                <td>{{ $employee->hobby }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @if($employee->employee_document)
                                    <div class="mt-4">
                                        <h5>Dokumen Pegawai</h5>
                                        <a href="{{ asset('storage/employee-documents/' . $employee->employee_document) }}" class="btn btn-info" target="_blank">
                                            <i class="fas fa-file-alt"></i> Lihat Dokumen
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon bg-warning">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <h2>Data Pegawai Belum Tersedia</h2>
                                    <p class="lead">
                                        Data pegawai Anda belum terdaftar dalam sistem.
                                        Silakan tambahkan data Anda menggunakan tombol di bawah ini.
                                    </p>
                                    <a href="{{ route('employees.create') }}" class="btn btn-warning mt-4">
                                        <i class="fas fa-plus"></i> Tambah Data Pegawai
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Initialize DataTable
            var table = $('#employees-table').DataTable({
                pageLength: 5,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                ordering: true,
                order: [[0, 'desc']],
                dom: 'lrtip' // Removes default search box
            });

            // Custom filtering function for unit kerja
            $('#unit-filter').on('change', function() {
                table.column(5) // Unit Kerja column
                    .search(this.value)
                    .draw();
            });

            // Custom filtering function for jabatan
            $('#jabatan-filter').on('change', function() {
                table.column(2) // Jabatan column
                    .search(this.value)
                    .draw();
            });

            // Custom filtering function for name search
            $('#search-name').on('keyup', function() {
                table.column(1) // Nama column
                    .search(this.value)
                    .draw();
            });

            // Reset all filters
            $('#reset-filters').on('click', function() {
                $('#unit-filter').val('').trigger('change');
                $('#jabatan-filter').val('').trigger('change');
                $('#search-name').val('');
                table
                    .search('')
                    .columns()
                    .search('')
                    .draw();
            });
        });
    </script>
@endpush
