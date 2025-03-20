@extends('layouts.app')

@section('title', 'Edit Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Profile</div>
        </div>
    </div>

    <div class="section-body">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Basic Information Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Dasar</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $user->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" 
                                       id="nip" 
                                       name="nip" 
                                       class="form-control @error('nip') is-invalid @enderror" 
                                       value="{{ old('nip', $user->nip) }}" 
                                       readonly>
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
                                       value="{{ old('identity_number', $user->identity_number) }}">
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
                                       value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}"
                                       required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone', $user->phone) }}"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Alamat <span class="text-danger">*</span></label>
                                <textarea id="address" 
                                          name="address" 
                                          class="form-control @error('address') is-invalid @enderror" 
                                          style="height: 100px"
                                          required>{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="religion">Agama <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('religion') is-invalid @enderror" name="religion" required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam" {{ old('religion', $user->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('religion', $user->religion) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('religion', $user->religion) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('religion', $user->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('religion', $user->religion) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('religion', $user->religion) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <option value="Lainnya" {{ old('religion', $user->religion) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                <label for="position">Profesi <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="position" 
                                       name="position" 
                                       class="form-control @error('position') is-invalid @enderror" 
                                       value="{{ old('position', $user->position) }}"
                                       required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="department_id">Departemen <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('department_id') is-invalid @enderror" name="department_id" required>
                                    <option value="">-- Pilih Departemen --</option>
                                    @foreach(\App\Models\Department::orderBy('name')->get() as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id', $user->employee?->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="golongan_pangkat">Golongan/Pangkat</label>
                                <input type="text" 
                                       id="golongan_pangkat" 
                                       name="golongan_pangkat" 
                                       class="form-control @error('golongan_pangkat') is-invalid @enderror" 
                                       value="{{ old('golongan_pangkat', $user->golongan_pangkat) }}" 
                                       placeholder="Contoh: III/a">
                                <small class="form-text text-muted">Masukkan golongan/pangkat (contoh: III/a)</small>
                                @error('golongan_pangkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" 
                                       id="jabatan" 
                                       name="jabatan" 
                                       class="form-control @error('jabatan') is-invalid @enderror" 
                                       value="{{ old('jabatan', $user->jabatan) }}" 
                                       placeholder="Contoh: Kepala Seksi">
                                <small class="form-text text-muted">Masukkan jabatan (contoh: Kepala Seksi)</small>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="unit_kerja">Unit Kerja</label>
                                <input type="text" 
                                       id="unit_kerja" 
                                       name="unit_kerja" 
                                       class="form-control @error('unit_kerja') is-invalid @enderror" 
                                       value="{{ old('unit_kerja', $user->unit_kerja) }}" 
                                       placeholder="Contoh: Puskesmas">
                                <small class="form-text text-muted">Masukkan unit kerja (contoh: Puskesmas)</small>
                                @error('unit_kerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education Section -->
            <div class="card">
                <div class="card-header">
                    <h4>Pendidikan <button type="button" class="btn btn-sm btn-primary ml-2" id="add-education"><i class="fas fa-plus"></i> Tambah Pendidikan</button></h4>
                </div>
                <div class="card-body">
                    <div id="education-container" data-education-count="{{ $user->educations->count() }}">
                        @forelse($user->educations as $index => $education)
                            <div class="education-item card mb-3">
                                <div class="card-body">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-danger remove-education">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="educations[{{ $index }}][id]" value="{{ $education->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Pendidikan <span class="text-danger">*</span></label>
                                                <select name="educations[{{ $index }}][type]" class="form-control select2 education-type @error('educations.'.$index.'.type') is-invalid @enderror" required>
                                                    <option value="">-- Pilih Jenis Pendidikan --</option>
                                                    <option value="formal" {{ old('educations.'.$index.'.type', $education->type) == 'formal' ? 'selected' : '' }}>Formal</option>
                                                    <option value="informal" {{ old('educations.'.$index.'.type', $education->type) == 'informal' ? 'selected' : '' }}>Non-Formal</option>
                                                </select>
                                                @error('educations.'.$index.'.type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Institusi <span class="text-danger">*</span></label>
                                                <input type="text" name="educations[{{ $index }}][institution_name]" class="form-control @error('educations.'.$index.'.institution_name') is-invalid @enderror" value="{{ old('educations.'.$index.'.institution_name', $education->institution_name) }}" required>
                                                @error('educations.'.$index.'.institution_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tingkat Pendidikan <span class="text-danger">*</span></label>
                                                <select name="educations[{{ $index }}][level]" class="form-control select2 @error('educations.'.$index.'.level') is-invalid @enderror" {{ old('educations.'.$index.'.type', $education->type) == 'formal' ? 'required' : '' }}>
                                                    <option value="">-- Pilih Tingkat Pendidikan --</option>
                                                    <option value="SD" {{ old('educations.'.$index.'.level', $education->level) == 'SD' ? 'selected' : '' }}>SD / Sederajat</option>
                                                    <option value="SLTP" {{ old('educations.'.$index.'.level', $education->level) == 'SLTP' ? 'selected' : '' }}>SLTP / Sederajat</option>
                                                    <option value="SLTA" {{ old('educations.'.$index.'.level', $education->level) == 'SLTA' ? 'selected' : '' }}>SLTA / Sederajat</option>
                                                    <option value="Diploma" {{ old('educations.'.$index.'.level', $education->level) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                                    <option value="S1" {{ old('educations.'.$index.'.level', $education->level) == 'S1' ? 'selected' : '' }}>S1</option>
                                                    <option value="S2" {{ old('educations.'.$index.'.level', $education->level) == 'S2' ? 'selected' : '' }}>S2</option>
                                                    <option value="S3" {{ old('educations.'.$index.'.level', $education->level) == 'S3' ? 'selected' : '' }}>S3</option>
                                                    <option value="Spesialis" {{ old('educations.'.$index.'.level', $education->level) == 'Spesialis' ? 'selected' : '' }}>Spesialis</option>
                                                    <option value="Sub Spesialis" {{ old('educations.'.$index.'.level', $education->level) == 'Sub Spesialis' ? 'selected' : '' }}>Sub Spesialis</option>
                                                </select>
                                                @error('educations.'.$index.'.level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <input type="text" name="educations[{{ $index }}][major]" class="form-control @error('educations.'.$index.'.major') is-invalid @enderror" value="{{ old('educations.'.$index.'.major', $education->major) }}">
                                                @error('educations.'.$index.'.major')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gelar</label>
                                                <input type="text" name="educations[{{ $index }}][degree]" class="form-control @error('educations.'.$index.'.degree') is-invalid @enderror" value="{{ old('educations.'.$index.'.degree', $education->degree) }}">
                                                @error('educations.'.$index.'.degree')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tahun Mulai <span class="text-danger">*</span></label>
                                                <input type="number" name="educations[{{ $index }}][start_year]" class="form-control @error('educations.'.$index.'.start_year') is-invalid @enderror" value="{{ old('educations.'.$index.'.start_year', $education->start_year) }}" min="1950" max="{{ date('Y') }}" required>
                                                @error('educations.'.$index.'.start_year')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tahun Lulus <span class="text-danger">*</span></label>
                                                <input type="number" name="educations[{{ $index }}][graduation_year]" class="form-control @error('educations.'.$index.'.graduation_year') is-invalid @enderror" value="{{ old('educations.'.$index.'.graduation_year', $education->graduation_year) }}" min="1950" max="{{ date('Y') + 10 }}" required>
                                                @error('educations.'.$index.'.graduation_year')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nilai / IPK</label>
                                                <input type="text" name="educations[{{ $index }}][gpa]" class="form-control @error('educations.'.$index.'.gpa') is-invalid @enderror" value="{{ old('educations.'.$index.'.gpa', $education->gpa) }}" placeholder="Contoh: 3.50">
                                                @error('educations.'.$index.'.gpa')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor Ijazah</label>
                                                <input type="text" name="educations[{{ $index }}][certificate_number]" class="form-control @error('educations.'.$index.'.certificate_number') is-invalid @enderror" value="{{ old('educations.'.$index.'.certificate_number', $education->certificate_number) }}">
                                                @error('educations.'.$index.'.certificate_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row informal-education" {!! old('educations.'.$index.'.type', $education->type) != 'informal' ? 'style=display:none' : '' !!}>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Kursus/Pelatihan <span class="text-danger">*</span></label>
                                                <input type="text" name="educations[{{ $index }}][course_name]" class="form-control @error('educations.'.$index.'.course_name') is-invalid @enderror" value="{{ old('educations.'.$index.'.course_name', $education->course_name) }}" {{ old('educations.'.$index.'.type', $education->type) == 'informal' ? 'required' : '' }}>
                                                @error('educations.'.$index.'.course_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea name="educations[{{ $index }}][description]" class="form-control @error('educations.'.$index.'.description') is-invalid @enderror" rows="3">{{ old('educations.'.$index.'.description', $education->description) }}</textarea>
                                                @error('educations.'.$index.'.description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- No existing education records -->
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Profile Picture Card -->
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
            </div>

            <div class="card-footer text-right">
                <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
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
            var educationIndex = parseInt($('#education-container').data('education-count'));
            
            $('#add-education').click(function() {
                const template = `
                    <div class="education-item card mb-3">
                        <div class="card-body">
                            <div class="float-right">
                                <button type="button" class="btn btn-danger remove-education">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Pendidikan <span class="text-danger">*</span></label>
                                        <select name="educations[\${educationIndex}][type]" class="form-control select2 education-type" required>
                                            <option value="">-- Pilih Jenis Pendidikan --</option>
                                            <option value="formal">Formal</option>
                                            <option value="informal">Non-Formal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Institusi <span class="text-danger">*</span></label>
                                        <input type="text" name="educations[\${educationIndex}][institution_name]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tingkat Pendidikan <span class="text-danger">*</span></label>
                                        <select name="educations[\${educationIndex}][level]" class="form-control select2">
                                            <option value="">-- Pilih Tingkat Pendidikan --</option>
                                            <option value="SD">SD / Sederajat</option>
                                            <option value="SLTP">SLTP / Sederajat</option>
                                            <option value="SLTA">SLTA / Sederajat</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                            <option value="Spesialis">Spesialis</option>
                                            <option value="Sub Spesialis">Sub Spesialis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <input type="text" name="educations[\${educationIndex}][major]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gelar</label>
                                        <input type="text" name="educations[\${educationIndex}][degree]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Mulai <span class="text-danger">*</span></label>
                                        <input type="number" name="educations[\${educationIndex}][start_year]" class="form-control" min="1950" max="{{ date('Y') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Lulus <span class="text-danger">*</span></label>
                                        <input type="number" name="educations[\${educationIndex}][graduation_year]" class="form-control" min="1950" max="{{ date('Y') + 10 }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nilai / IPK</label>
                                        <input type="text" name="educations[\${educationIndex}][gpa]" class="form-control" placeholder="Contoh: 3.50">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Ijazah</label>
                                        <input type="text" name="educations[\${educationIndex}][certificate_number]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row informal-education" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Kursus/Pelatihan <span class="text-danger">*</span></label>
                                        <input type="text" name="educations[\${educationIndex}][course_name]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="educations[\${educationIndex}][description]" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                $('#education-container').append(template);
                
                // Initialize new select2 and datepickers
                $('.select2').select2();
                
                educationIndex++;
            });
            
            // Remove education item
            $(document).on('click', '.remove-education', function() {
                $(this).closest('.education-item').remove();
            });
            
            // Toggle informal education fields
            $(document).on('change', '.education-type', function() {
                const type = $(this).val();
                const item = $(this).closest('.education-item');
                
                if (type === 'informal') {
                    item.find('.informal-education').show();
                    item.find('.informal-education input').prop('required', true);
                } else {
                    item.find('.informal-education').hide();
                    item.find('.informal-education input').prop('required', false);
                }
            });
        });
    </script>
@endpush