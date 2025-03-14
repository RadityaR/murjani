@extends('layouts.app')

@section('title', 'Karyawan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Karyawan</h1>
        <div class="section-header-button">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah Baru</a>
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

        <div class="card">
            <div class="card-header">
                <h4>Daftar Karyawan</h4>
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
                            <label for="unit-filter">Filter Unit Kerja:</label>
                            <select class="form-control select2" id="unit-filter">
                                <option value="">Semua</option>
                                @php
                                    $units = \App\Models\Employee::distinct('unit_kerja')->pluck('unit_kerja');
                                @endphp
                                @foreach($units as $unit)
                                    @if($unit)
                                        <option value="{{ $unit }}">{{ $unit }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="search-name">Cari (NIP/Nama):</label>
                            <input type="text" class="form-control" id="search-name" placeholder="Ketik NIP atau nama pegawai...">
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
                                <th>Golongan/Pangkat</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>Status Pegawai</th>
                                <th>Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                            <tr>
                                <td>{{ $employee->nip }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->golongan }}</td>
                                <td>{{ $employee->jabatan }}</td>
                                <td>{{ $employee->unit_kerja }}</td>
                                <td>
                                    <div class="badge badge-{{ $employee->employee_status == 'PNS' ? 'info' : ($employee->employee_status == 'Kontrak' ? 'warning' : 'light') }}">
                                        {{ $employee->employee_status }}
                                    </div>
                                </td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>
                                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data karyawan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</section>
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
                pageLength: 10,
                ordering: true,
                order: [[0, 'desc']],
                dom: 'lrtip', // Removes default search box
                language: {
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // Custom filtering function for golongan/pangkat
            $('#golongan-filter').on('change', function() {
                table.column(2) // Golongan/Pangkat column
                    .search(this.value)
                    .draw();
            });

            // Custom filtering function for unit kerja
            $('#unit-filter').on('change', function() {
                table.column(4) // Unit Kerja column
                    .search(this.value)
                    .draw();
            });

            // Custom filtering function for name and NIP search
            $('#search-name').on('keyup', function() {
                var searchValue = this.value;
                
                // Use a custom function to search both NIP and name columns
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var nip = data[0] || ''; // NIP column (index 0)
                    var name = data[1] || ''; // Name column (index 1)
                    
                    if (searchValue === '') {
                        return true;
                    }
                    
                    // Check if either NIP or name contains the search value (case-insensitive)
                    if (nip.toLowerCase().includes(searchValue.toLowerCase()) ||
                        name.toLowerCase().includes(searchValue.toLowerCase())) {
                        return true;
                    }
                    
                    return false;
                });
                
                table.draw();
                
                // Clear the custom search function
                $.fn.dataTable.ext.search.pop();
            });

            // Reset all filters
            $('#reset-filters').on('click', function() {
                $('#golongan-filter').val('').trigger('change');
                $('#unit-filter').val('').trigger('change');
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