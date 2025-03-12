@extends('layouts.app')

@section('title', 'Upload Dokumen Pegawai')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Upload Dokumen Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Karyawan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.show', $employee) }}">{{ $employee->name }}</a></div>
            <div class="breadcrumb-item">Upload Dokumen</div>
        </div>
    </div>

    <div class="section-body">
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
                                <p class="mb-0">Silakan upload dokumen Form Data Pegawai yang telah diisi. Format yang diperbolehkan: .doc, .docx, atau .pdf dengan ukuran maksimal 5MB.</p>
                            </div>
                            <div class="form-group">
                                <label for="employee_document">Dokumen Form Data Pegawai <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('employee_document') is-invalid @enderror" id="employee_document" name="employee_document" accept=".doc,.docx,.pdf" required>
                                    <label class="custom-file-label" for="employee_document">Pilih file</label>
                                    @error('employee_document')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if($employee->employee_document)
                                    <small class="form-text text-muted">
                                        Dokumen saat ini: {{ $employee->employee_document }}
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Update custom file input label when file is selected
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var label = e.target.nextElementSibling;
        label.innerHTML = fileName;
    });
</script>
@endpush 