@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Karyawan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Karyawan</a></div>
            <div class="breadcrumb-item">Tambah Karyawan</div>
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
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4>Informasi Karyawan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $user->name ?? '') }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $user->email ?? '') }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nip">NIP <span class="text-danger">*</span></label>
                                @if(auth()->user()->role === 'admin')
                                    <input type="text" 
                                           id="nip" 
                                           name="nip" 
                                           class="form-control @error('nip') is-invalid @enderror" 
                                           value="{{ old('nip') }}" 
                                           required>
                                @else
                                    <input type="text" 
                                           class="form-control" 
                                           value="{{ auth()->user()->nip }}" 
                                           readonly>
                                    <small class="form-text text-muted">NIP akan diisi otomatis sesuai dengan akun Anda.</small>
                                @endif
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ktp_number">Nomor KTP</label>
                                <input type="text" id="ktp_number" name="ktp_number" class="form-control @error('ktp_number') is-invalid @enderror" value="{{ old('ktp_number') }}">
                                @error('ktp_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="golongan">Golongan/Jabatan/Unit Kerja</label>
                                <input type="text" id="golongan" name="golongan" class="form-control @error('golongan') is-invalid @enderror" value="{{ old('golongan') }}" placeholder="Contoh: III/a - Kepala Seksi - Puskesmas">
                                <small class="form-text text-muted">Masukkan golongan, jabatan, dan unit kerja (contoh: III/a - Kepala Seksi - Puskesmas)</small>
                                @error('golongan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employee_status">Status Pegawai</label>
                                <select id="employee_status" name="employee_status" class="form-control select2 @error('employee_status') is-invalid @enderror">
                                    <option value="">Pilih Status Pegawai</option>
                                    <option value="Kontrak" {{ old('employee_status') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                    <option value="PNS" {{ old('employee_status') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ old('employee_status') == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                </select>
                                @error('employee_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
              
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Telepon <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_birth">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="text" id="date_of_birth" name="date_of_birth" class="form-control datepicker @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select id="gender" name="gender" class="form-control select2 @error('gender') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marital_status">Status Pernikahan <span class="text-danger">*</span></label>
                                <select id="marital_status" name="marital_status" class="form-control select2 @error('marital_status') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Menikah" {{ old('marital_status') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old('marital_status') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Duda" {{ old('marital_status') == 'Duda' ? 'selected' : '' }}>Duda</option>
                                    <option value="Janda" {{ old('marital_status') == 'Janda' ? 'selected' : '' }}>Janda</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Alamat <span class="text-danger">*</span></label>
                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="height_cm">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                <input type="number" id="height_cm" name="height_cm" class="form-control @error('height_cm') is-invalid @enderror" value="{{ old('height_cm') }}" required>
                                @error('height_cm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="weight_kg">Berat Badan (kg) <span class="text-danger">*</span></label>
                                <input type="number" id="weight_kg" name="weight_kg" class="form-control @error('weight_kg') is-invalid @enderror" value="{{ old('weight_kg') }}" required>
                                @error('weight_kg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="blood_type">Golongan Darah <span class="text-danger">*</span></label>
                                <select id="blood_type" name="blood_type" class="form-control select2 @error('blood_type') is-invalid @enderror" required>
                                    <option value="">Pilih Golongan Darah</option>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="religion">Agama <span class="text-danger">*</span></label>
                                <input type="text" id="religion" name="religion" class="form-control @error('religion') is-invalid @enderror" value="{{ old('religion') }}" required>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hobby">Hobi <span class="text-danger">*</span></label>
                                <input type="text" id="hobby" name="hobby" class="form-control @error('hobby') is-invalid @enderror" value="{{ old('hobby') }}" required>
                                @error('hobby')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sip">SIP</label>
                                <select id="sip" name="sip" class="form-control select2 @error('sip') is-invalid @enderror">
                                    <option value="">Pilih SIP</option>
                                    <option value="Hidup" {{ old('sip') == 'Hidup' ? 'selected' : '' }}>Hidup</option>
                                    <option value="Mati" {{ old('sip') == 'Mati' ? 'selected' : '' }}>Mati</option>
                                    <option value="Tidak Punya" {{ old('sip') == 'Tidak Punya' ? 'selected' : '' }}>Tidak Punya</option>
                                </select>
                                @error('sip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card-header">
                    <h4>Pendidikan</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" id="add-education">
                            <i class="fas fa-plus"></i> Tambah Pendidikan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="education-container">
                        @if(old('educations'))
                            @foreach(old('educations') as $index => $education)
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
                                                    <select name="educations[{{ $index }}][type]" class="form-control education-type @error('educations.'.$index.'.type') is-invalid @enderror" required>
                                                        <option value="">Pilih Jenis</option>
                                                        <option value="formal" {{ $education['type'] == 'formal' ? 'selected' : '' }}>Formal</option>
                                                        <option value="informal" {{ $education['type'] == 'informal' ? 'selected' : '' }}>Non-Formal</option>
                                                    </select>
                                                    @error('educations.'.$index.'.type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Institusi <span class="text-danger">*</span></label>
                                                    <input type="text" name="educations[{{ $index }}][institution_name]" class="form-control @error('educations.'.$index.'.institution_name') is-invalid @enderror" value="{{ $education['institution_name'] ?? '' }}" required>
                                                    @error('educations.'.$index.'.institution_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 formal-education" style="{{ $education['type'] != 'formal' ? 'display: none;' : '' }}">
                                                <div class="form-group">
                                                    <label>Tingkat <span class="text-danger">*</span></label>
                                                    <select name="educations[{{ $index }}][level]" class="form-control @error('educations.'.$index.'.level') is-invalid @enderror" {{ $education['type'] == 'formal' ? 'required' : '' }}>
                                                        <option value="">Pilih Tingkat</option>
                                                        <option value="SD" {{ ($education['level'] ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                                                        <option value="SLTP" {{ ($education['level'] ?? '') == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                                        <option value="SLTA" {{ ($education['level'] ?? '') == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                                                        <option value="Diploma" {{ ($education['level'] ?? '') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                                        <option value="S1" {{ ($education['level'] ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                                                        <option value="S2" {{ ($education['level'] ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                                                        <option value="S3" {{ ($education['level'] ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
                                                        <option value="Spesialis" {{ ($education['level'] ?? '') == 'Spesialis' ? 'selected' : '' }}>Spesialis</option>
                                                        <option value="Sub Spesialis" {{ ($education['level'] ?? '') == 'Sub Spesialis' ? 'selected' : '' }}>Sub Spesialis</option>
                                                    </select>
                                                    @error('educations.'.$index.'.level')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 informal-education" style="{{ $education['type'] != 'informal' ? 'display: none;' : '' }}">
                                                <div class="form-group">
                                                    <label>Nama Kursus <span class="text-danger">*</span></label>
                                                    <input type="text" name="educations[{{ $index }}][course_name]" class="form-control @error('educations.'.$index.'.course_name') is-invalid @enderror" value="{{ $education['course_name'] ?? '' }}" {{ $education['type'] == 'informal' ? 'required' : '' }}>
                                                    @error('educations.'.$index.'.course_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Work Experience Section -->
                <div class="card-header">
                    <h4>Pengalaman Kerja</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" id="add-work-experience">
                            <i class="fas fa-plus"></i> Tambah Pengalaman Kerja
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="work-experience-container">
                        @if(old('work_experiences'))
                            @foreach(old('work_experiences') as $index => $workExperience)
                                <div class="work-experience-item card mb-3">
                                    <div class="card-body">
                                        <div class="float-right">
                                            <button type="button" class="btn btn-danger remove-work-experience">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Perusahaan <span class="text-danger">*</span></label>
                                                    <input type="text" name="work_experiences[{{ $index }}][company]" class="form-control @error('work_experiences.'.$index.'.company') is-invalid @enderror" value="{{ $workExperience['company'] ?? '' }}" required>
                                                    @error('work_experiences.'.$index.'.company')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input type="text" name="work_experiences[{{ $index }}][position]" class="form-control @error('work_experiences.'.$index.'.position') is-invalid @enderror" value="{{ $workExperience['position'] ?? '' }}">
                                                    @error('work_experiences.'.$index.'.position')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai</label>
                                                    <input type="text" name="work_experiences[{{ $index }}][start_date]" class="form-control datepicker @error('work_experiences.'.$index.'.start_date') is-invalid @enderror" value="{{ $workExperience['start_date'] ?? '' }}">
                                                    @error('work_experiences.'.$index.'.start_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Selesai</label>
                                                    <input type="text" name="work_experiences[{{ $index }}][end_date]" class="form-control datepicker @error('work_experiences.'.$index.'.end_date') is-invalid @enderror" value="{{ $workExperience['end_date'] ?? '' }}">
                                                    @error('work_experiences.'.$index.'.end_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea name="work_experiences[{{ $index }}][description]" class="form-control @error('work_experiences.'.$index.'.description') is-invalid @enderror" rows="3">{{ $workExperience['description'] ?? '' }}</textarea>
                                                    @error('work_experiences.'.$index.'.description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    
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
            
            // Education dynamic form
            let educationIndex = {{ old('educations') ? count(old('educations')) : 0 }};
            
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
                                        <select name="educations[${educationIndex}][type]" class="form-control education-type" required>
                                            <option value="">Pilih Jenis</option>
                                            <option value="formal">Formal</option>
                                            <option value="informal">Non-Formal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Institusi <span class="text-danger">*</span></label>
                                        <input type="text" name="educations[${educationIndex}][institution_name]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 formal-education" style="display: none;">
                                    <div class="form-group">
                                        <label>Tingkat <span class="text-danger">*</span></label>
                                        <select name="educations[${educationIndex}][level]" class="form-control">
                                            <option value="">Pilih Tingkat</option>
                                            <option value="SD">SD</option>
                                            <option value="SLTP">SLTP</option>
                                            <option value="SLTA">SLTA</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                            <option value="Spesialis">Spesialis</option>
                                            <option value="Sub Spesialis">Sub Spesialis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 informal-education" style="display: none;">
                                    <div class="form-group">
                                        <label>Nama Kursus <span class="text-danger">*</span></label>
                                        <input type="text" name="educations[${educationIndex}][course_name]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                $('#education-container').append(template);
                educationIndex++;
            });
            
            $(document).on('click', '.remove-education', function() {
                $(this).closest('.education-item').remove();
            });
            
            $(document).on('change', '.education-type', function() {
                const type = $(this).val();
                const item = $(this).closest('.education-item');
                
                if (type === 'formal') {
                    item.find('.formal-education').show();
                    item.find('.informal-education').hide();
                    item.find('.formal-education select').prop('required', true);
                    item.find('.informal-education input').prop('required', false);
                } else if (type === 'informal') {
                    item.find('.formal-education').hide();
                    item.find('.informal-education').show();
                    item.find('.formal-education select').prop('required', false);
                    item.find('.informal-education input').prop('required', true);
                } else {
                    item.find('.formal-education').hide();
                    item.find('.informal-education').hide();
                    item.find('.formal-education select').prop('required', false);
                    item.find('.informal-education input').prop('required', false);
                }
            });
            
            // Work Experience dynamic form
            let workExperienceIndex = {{ old('work_experiences') ? count(old('work_experiences')) : 0 }};
            
            $('#add-work-experience').click(function() {
                const template = `
                    <div class="work-experience-item card mb-3">
                        <div class="card-body">
                            <div class="float-right">
                                <button type="button" class="btn btn-danger remove-work-experience">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][company]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][position]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][start_date]" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][end_date]" class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="work_experiences[${workExperienceIndex}][description]" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                $('#work-experience-container').append(template);
                
                // Initialize datepicker for new elements
                $(`input[name="work_experiences[${workExperienceIndex}][start_date]"]`).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                
                $(`input[name="work_experiences[${workExperienceIndex}][end_date]"]`).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                
                workExperienceIndex++;
            });
            
            $(document).on('click', '.remove-work-experience', function() {
                $(this).closest('.work-experience-item').remove();
            });
        });
    </script>
@endpush 