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
        @if(auth()->user()->role === 'admin' || !App\Models\Employee::where('nip', auth()->user()->nip)->exists())
        <div class="section-header-button">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah Data Pegawai</a>
        </div>
        @endif
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
                            <label for="golongan-filter">Filter Golongan/Pangkat:</label>
                            <select class="form-control select2" id="golongan-filter">
                                <option value="">Semua</option>
                                @php
                                    $golongan = \App\Models\Employee::distinct('golongan')->pluck('golongan');
                                @endphp
                                @foreach($golongan as $gol)
                                    @if($gol)
                                        <option value="{{ $gol }}">{{ $gol }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jabatan-filter">Filter Jabatan:</label>
                            <select class="form-control select2" id="jabatan-filter">
                                <option value="">Semua</option>
                                @php
                                    $jabatan = \App\Models\Employee::distinct('jabatan')->pluck('jabatan');
                                @endphp
                                @foreach($jabatan as $jab)
                                    @if($jab)
                                        <option value="{{ $jab }}">{{ $jab }}</option>
                                    @endif
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
                                    $unit = \App\Models\Employee::distinct('unit_kerja')->pluck('unit_kerja');
                                @endphp
                                @foreach($unit as $u)
                                    @if($u)
                                        <option value="{{ $u }}">{{ $u }}</option>
                                    @endif
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
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
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
                                    @if(auth()->user()->role === 'admin' || auth()->user()->nip === $employee->nip)
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('employees.upload-document', $employee) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-file-upload"></i> Upload Dokumen
                                    </a>
                                    @endif
                                    @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    @endif
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
            
            $('#golongan-filter').on('change', function() {
                table.column(2).search(this.value).draw();
            });
            
            $('#jabatan-filter').on('change', function() {
                table.column(3).search(this.value).draw();
            });
            
            $('#unit-filter').on('change', function() {
                table.column(4).search(this.value).draw();
            });
            
            $('#reset-filter').on('click', function() {
                $('#golongan-filter').val('').trigger('change');
                $('#jabatan-filter').val('').trigger('change');
                $('#unit-filter').val('').trigger('change');
                table.search('').columns().search('').draw();
            });
        });
    </script>
@endpush 