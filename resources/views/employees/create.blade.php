@extends('layouts.app')

@section('title', 'Tambah Data Pegawai')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Data Pegawai</a></div>
            <div class="breadcrumb-item">Tambah Data Pegawai</div>
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

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Basic Information Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Dasar</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="full_name" 
                                       name="full_name" 
                                       class="form-control @error('full_name') is-invalid @enderror" 
                                       value="{{ old('full_name', $user->name ?? '') }}" 
                                       required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" 
                                       id="nip" 
                                       name="nip" 
                                       class="form-control @error('nip') is-invalid @enderror" 
                                       value="{{ old('nip', $user->nip ?? '') }}">
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Nomor Induk Pegawai</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="identity_number">Nomor KTP</label>
                                <input type="text" 
                                       id="identity_number" 
                                       name="identity_number" 
                                       class="form-control @error('identity_number') is-invalid @enderror" 
                                       value="{{ old('identity_number') }}">
                                @error('identity_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="birth_date">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="birth_date" 
                                       name="birth_date" 
                                       class="form-control datepicker @error('birth_date') is-invalid @enderror" 
                                       value="{{ old('birth_date') }}"
                                       required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="gender" value="male" class="selectgroup-input" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                        <span class="selectgroup-button">Laki-laki</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="gender" value="female" class="selectgroup-input" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Perempuan</span>
                                    </label>
                                </div>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="phone_number" 
                                       name="phone_number" 
                                       class="form-control @error('phone_number') is-invalid @enderror" 
                                       value="{{ old('phone_number') }}"
                                       required>
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Alamat <span class="text-danger">*</span></label>
                                <textarea id="address" 
                                          name="address" 
                                          class="form-control @error('address') is-invalid @enderror" 
                                          style="height: 100px"
                                          required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Status Pernikahan <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('marital_status') is-invalid @enderror" name="marital_status" required>
                                    <option value="">-- Pilih Status Pernikahan --</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Menikah</option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Cerai</option>
                                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Janda/Duda</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="religion">Agama <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('religion') is-invalid @enderror" name="religion" required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <option value="Lainnya" {{ old('religion') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Employment Information Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Kepegawaian</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position_id">Profesi <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('position_id') is-invalid @enderror" name="position_id" required>
                                    <option value="">-- Pilih Profesi --</option>
                                    @foreach(\App\Models\Position::orderBy('title')->get() as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                            {{ $position->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="department_id">Departemen <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('department_id') is-invalid @enderror" name="department_id" required>
                                    <option value="">-- Pilih Departemen --</option>
                                    @foreach(\App\Models\Department::orderBy('name')->get() as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="unit_id">Unit Kerja <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('unit_id') is-invalid @enderror" name="unit_id" required>
                                    <option value="">-- Pilih Unit Kerja --</option>
                                    @foreach(\App\Models\Unit::orderBy('name')->get() as $unit)
                                        <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rank_class_id">Golongan/Pangkat</label>
                                <select class="form-control select2 @error('rank_class_id') is-invalid @enderror" name="rank_class_id">
                                    <option value="">-- Pilih Golongan/Pangkat --</option>
                                    @foreach(\App\Models\RankClass::orderBy('name')->get() as $rankClass)
                                        <option value="{{ $rankClass->id }}" {{ old('rank_class_id') == $rankClass->id ? 'selected' : '' }}>
                                            {{ $rankClass->name }} - {{ $rankClass->description }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rank_class_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Status Kepegawaian <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('employment_status') is-invalid @enderror" name="employment_status" required>
                                    <option value="">-- Pilih Status Kepegawaian --</option>
                                    <option value="civil_servant" {{ old('employment_status') == 'civil_servant' ? 'selected' : '' }}>PNS</option>
                                    <option value="contract" {{ old('employment_status') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                                    <option value="temporary" {{ old('employment_status') == 'temporary' ? 'selected' : '' }}>Honorer</option>
                                </select>
                                @error('employment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Status Lisensi</label>
                                <select class="form-control select2 @error('license_status') is-invalid @enderror" name="license_status">
                                    <option value="">-- Pilih Status Lisensi --</option>
                                    <option value="active" {{ old('license_status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="expired" {{ old('license_status') == 'expired' ? 'selected' : '' }}>Kadaluarsa</option>
                                    <option value="none" {{ old('license_status') == 'none' ? 'selected' : '' }}>Tidak Ada</option>
                                </select>
                                @error('license_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Physical Information Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Fisik</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="height_cm">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                <input type="number" 
                                       id="height_cm" 
                                       name="height_cm" 
                                       class="form-control @error('height_cm') is-invalid @enderror" 
                                       value="{{ old('height_cm') }}"
                                       min="1"
                                       max="300"
                                       required>
                                @error('height_cm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weight_kg">Berat Badan (kg) <span class="text-danger">*</span></label>
                                <input type="number" 
                                       id="weight_kg" 
                                       name="weight_kg" 
                                       class="form-control @error('weight_kg') is-invalid @enderror" 
                                       value="{{ old('weight_kg') }}"
                                       min="1"
                                       max="500"
                                       required>
                                @error('weight_kg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Golongan Darah <span class="text-danger">*</span></label>
                                <select class="form-control @error('blood_type') is-invalid @enderror" name="blood_type" required>
                                    <option value="">-- Pilih Golongan Darah --</option>
                                    <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O</option>
                                </select>
                                @error('blood_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="hobbies">Hobi</label>
                        <input type="text" 
                               id="hobbies" 
                               name="hobbies" 
                               class="form-control @error('hobbies') is-invalid @enderror" 
                               value="{{ old('hobbies') }}">
                        @error('hobbies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Pisahkan dengan koma jika lebih dari satu</small>
                    </div>
                </div>
            </div>
            
            <!-- Education Information Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Pendidikan <button type="button" class="btn btn-sm btn-primary ml-2" id="add-education"><i class="fas fa-plus"></i> Tambah Pendidikan</button></h4>
                </div>
                <div class="card-body">
                    <div id="education-container">
                        <div class="education-entry border rounded p-3 mb-3 position-relative">
                            <button type="button" class="btn btn-sm btn-danger position-absolute remove-education" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pendidikan <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="educations[0][education_type]" required>
                                            <option value="">-- Pilih Jenis Pendidikan --</option>
                                            <option value="formal">Formal</option>
                                            <option value="non_formal">Non-Formal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Institusi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="educations[0][institution_name]" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="educations[0][education_level]" required>
                                            <option value="">-- Pilih Tingkat Pendidikan --</option>
                                            <option value="sd">SD / Sederajat</option>
                                            <option value="smp">SMP / Sederajat</option>
                                            <option value="sma">SMA / Sederajat</option>
                                            <option value="d1">D1</option>
                                            <option value="d2">D2</option>
                                            <option value="d3">D3</option>
                                            <option value="d4">D4</option>
                                            <option value="s1">S1</option>
                                            <option value="s2">S2</option>
                                            <option value="s3">S3</option>
                                            <option value="course">Kursus/Pelatihan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <input type="text" class="form-control" name="educations[0][major]">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar</label>
                                        <input type="text" class="form-control" name="educations[0][degree]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Mulai <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="educations[0][start_year]" min="1950" max="{{ date('Y') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Lulus <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="educations[0][graduation_year]" min="1950" max="{{ date('Y') + 10 }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nilai / IPK</label>
                                        <input type="text" class="form-control" name="educations[0][gpa]" placeholder="Contoh: 3.50">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Ijazah</label>
                                        <input type="text" class="form-control" name="educations[0][certificate_number]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Document Upload Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Foto Profil</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="profile_picture">Foto Pegawai</label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('profile_picture') is-invalid @enderror" 
                                   id="profile_picture" 
                                   name="profile_picture"
                                   accept="image/jpeg,image/png,image/jpg">
                            <label class="custom-file-label" for="profile_picture">Pilih gambar</label>
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">Format yang diperbolehkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>
                    <div class="mt-3">
                        <div id="image-preview" class="image-preview" style="display: none; max-width: 200px;">
                            <img id="preview" src="#" alt="Preview Foto" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data Pegawai
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    
    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();
            
            // Initialize Datepicker
            $('.datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            
            // Custom file input
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
                
                // Preview image if this is the profile picture input
                if (this.id === 'profile_picture') {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview').attr('src', e.target.result);
                            $('#image-preview').show();
                        }
                        reader.readAsDataURL(file);
                    }
                }
            });
            
            // Education dynamic form
            let educationIndex = 0;
            
            // Add new education entry
            $('#add-education').on('click', function() {
                educationIndex++;
                
                const newEntry = `
                <div class="education-entry border rounded p-3 mb-3 position-relative">
                    <button type="button" class="btn btn-sm btn-danger position-absolute remove-education" style="top: 10px; right: 10px;"><i class="fas fa-times"></i></button>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Pendidikan <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="educations[${educationIndex}][education_type]" required>
                                    <option value="">-- Pilih Jenis Pendidikan --</option>
                                    <option value="formal">Formal</option>
                                    <option value="non_formal">Non-Formal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Institusi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="educations[${educationIndex}][institution_name]" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tingkat Pendidikan <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="educations[${educationIndex}][education_level]" required>
                                    <option value="">-- Pilih Tingkat Pendidikan --</option>
                                    <option value="sd">SD / Sederajat</option>
                                    <option value="smp">SMP / Sederajat</option>
                                    <option value="sma">SMA / Sederajat</option>
                                    <option value="d1">D1</option>
                                    <option value="d2">D2</option>
                                    <option value="d3">D3</option>
                                    <option value="d4">D4</option>
                                    <option value="s1">S1</option>
                                    <option value="s2">S2</option>
                                    <option value="s3">S3</option>
                                    <option value="course">Kursus/Pelatihan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jurusan</label>
                                <input type="text" class="form-control" name="educations[${educationIndex}][major]">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gelar</label>
                                <input type="text" class="form-control" name="educations[${educationIndex}][degree]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahun Mulai <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="educations[${educationIndex}][start_year]" min="1950" max="${new Date().getFullYear()}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahun Lulus <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="educations[${educationIndex}][graduation_year]" min="1950" max="${new Date().getFullYear() + 10}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nilai / IPK</label>
                                <input type="text" class="form-control" name="educations[${educationIndex}][gpa]" placeholder="Contoh: 3.50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Ijazah</label>
                                <input type="text" class="form-control" name="educations[${educationIndex}][certificate_number]">
                            </div>
                        </div>
                    </div>
                </div>
                `;
                
                $('#education-container').append(newEntry);
                
                // Initialize select2 for the new entry
                $('#education-container .education-entry:last-child .select2').select2();
            });
            
            // Remove education entry
            $(document).on('click', '.remove-education', function() {
                if ($('.education-entry').length > 1) {
                    $(this).closest('.education-entry').remove();
                } else {
                    alert('Minimal harus ada satu data pendidikan!');
                }
            });
        });
    </script>
@endpush 