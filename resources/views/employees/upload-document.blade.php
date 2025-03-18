@extends('layouts.app')

@section('title', 'Upload Dokumen Pegawai')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/dropzone/dist/min/dropzone.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Upload Dokumen Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Data Pegawai</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.show', $employee) }}">{{ $employee->full_name }}</a></div>
            <div class="breadcrumb-item">Upload Dokumen</div>
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
                <h4>Form Upload Dokumen</h4>
            </div>
            <form action="{{ route('employees.upload-document', $employee) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle mr-3 fa-2x"></i>
                                    <div>
                                        <p class="mb-0">Silakan upload dokumen Form Data Pegawai yang telah diisi.</p>
                                        <p class="mb-0"><strong>Format yang diperbolehkan:</strong> .doc, .docx, atau .pdf dengan ukuran maksimal 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($employee->employee_document)
                            <div class="alert alert-warning">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle mr-3 fa-2x"></i>
                                    <div>
                                        <p class="mb-0"><strong>Dokumen saat ini:</strong> {{ $employee->employee_document }}</p>
                                        <p class="mb-0">Mengunggah dokumen baru akan menggantikan dokumen yang sudah ada.</p>
                                        <a href="{{ asset('storage/employee-documents/'.$employee->employee_document) }}" 
                                           target="_blank" class="btn btn-sm btn-info mt-2">
                                            <i class="fas fa-file-download"></i> Download Dokumen Saat Ini
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="form-group">
                                <label for="employee_document">Dokumen Form Data Pegawai <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('employee_document') is-invalid @enderror" id="employee_document" name="employee_document" accept=".doc,.docx,.pdf" required>
                                    <label class="custom-file-label" for="employee_document">Pilih file</label>
                                    @error('employee_document')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Klik pada area di atas untuk memilih file atau seret dan lepas file ke area tersebut.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Dokumen
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('library/dropzone/dist/min/dropzone.min.js') }}"></script>

<script>
    // Update custom file input label when file is selected
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var label = e.target.nextElementSibling;
        label.innerHTML = fileName;
    });
</script>
@endpush 