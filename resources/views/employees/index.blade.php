@extends('layouts.app')

@section('title', 'Data Pegawai')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pegawai</h1>
        <div class="section-header-button">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah Data Pegawai</a>
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

        <div class="card">
            <div class="card-header">
                <h4>Daftar Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rank-filter">Filter Golongan/Pangkat:</label>
                            <select class="form-control select2" id="rank-filter">
                                <option value="">Semua</option>
                                @php
                                    $rankClasses = \App\Models\RankClass::orderBy('name')->get();
                                @endphp
                                @foreach($rankClasses as $rank)
                                    <option value="{{ $rank->name }}">{{ $rank->name }} - {{ $rank->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="position-filter">Filter Profesi:</label>
                            <select class="form-control select2" id="position-filter">
                                <option value="">Semua</option>
                                @php
                                    $positions = \App\Models\Position::orderBy('title')->get();
                                @endphp
                                @foreach($positions as $position)
                                    <option value="{{ $position->title }}">{{ $position->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="unit-filter">Filter Unit Kerja:</label>
                            <select class="form-control select2" id="unit-filter">
                                <option value="">Semua</option>
                                @php
                                    $units = \App\Models\Unit::orderBy('name')->get();
                                @endphp
                                @foreach($units as $unit)
                                    <option value="{{ $unit->name }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button id="reset-filter" class="btn btn-light form-control">Reset Filter</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="employee-table">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Golongan</th>
                                <th>Profesi</th>
                                <th>Unit Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->nip }}</td>
                                <td>{{ $employee->full_name }}</td>
                                <td>{{ $employee->rankClass->name ?? '-' }}</td>
                                <td>{{ $employee->position->title ?? '-' }}</td>
                                <td>{{ $employee->unit->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('employees.upload-document', $employee) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-file-upload"></i> Upload Dokumen
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    
    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            
            var table = $('#employee-table').DataTable({
                "paging": false,
                "info": false,
                "ordering": true,
                "searching": true
            });
            
            $('#rank-filter').on('change', function() {
                table.column(2).search(this.value).draw();
            });
            
            $('#position-filter').on('change', function() {
                table.column(3).search(this.value).draw();
            });
            
            $('#unit-filter').on('change', function() {
                table.column(4).search(this.value).draw();
            });
            
            $('#reset-filter').on('click', function() {
                $('#rank-filter').val('').trigger('change');
                $('#position-filter').val('').trigger('change');
                $('#unit-filter').val('').trigger('change');
                table.search('').columns().search('').draw();
            });
        });
    </script>
@endpush 