@extends('layouts.app')

@section('title', 'Edit Data Pegawai')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Data Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Data Pegawai</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.show', $employee) }}">{{ $employee->full_name }}</a></div>
            <div class="breadcrumb-item">Edit</div>
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

        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
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
                                <label for="full_name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="full_name" 
                                       name="full_name" 
                                       class="form-control @error('full_name') is-invalid @enderror" 
                                       value="{{ old('full_name', $employee->full_name) }}" 
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
                                       value="{{ old('nip', $employee->nip) }}"
                                       {{ auth()->user()->role !== 'admin' ? 'readonly' : '' }}>
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
                                       value="{{ old('identity_number', $employee->identity_number) }}">
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
                                       value="{{ old('birth_date', $employee->birth_date ? $employee->birth_date->format('Y-m-d') : '') }}"
                                       required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="gender" value="male" class="selectgroup-input" {{ old('gender', $employee->gender) == 'male' ? 'checked' : '' }} required>
                                        <span class="selectgroup-button">Laki-laki</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="gender" value="female" class="selectgroup-input" {{ old('gender', $employee->gender) == 'female' ? 'checked' : '' }}>
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
                                       value="{{ old('phone_number', $employee->phone_number) }}"
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
                                          required>{{ old('address', $employee->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Status Pernikahan <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('marital_status') is-invalid @enderror" name="marital_status" required>
                                    <option value="">-- Pilih Status Pernikahan --</option>
                                    <option value="single" {{ old('marital_status', $employee->marital_status) == 'single' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="married" {{ old('marital_status', $employee->marital_status) == 'married' ? 'selected' : '' }}>Menikah</option>
                                    <option value="divorced" {{ old('marital_status', $employee->marital_status) == 'divorced' ? 'selected' : '' }}>Cerai</option>
                                    <option value="widowed" {{ old('marital_status', $employee->marital_status) == 'widowed' ? 'selected' : '' }}>Janda/Duda</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="religion">Agama <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('religion') is-invalid @enderror" name="religion" required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam" {{ old('religion', $employee->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('religion', $employee->religion) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('religion', $employee->religion) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('religion', $employee->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('religion', $employee->religion) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('religion', $employee->religion) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <option value="Lainnya" {{ old('religion', $employee->religion) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                <label for="position_id">Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('position_id') is-invalid @enderror" name="position_id" required>
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach(\App\Models\Position::orderBy('name')->get() as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id', $employee->position_id) == $position->id ? 'selected' : '' }}>
                                            {{ $position->name }}
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
                                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
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
                                        <option value="{{ $unit->id }}" {{ old('unit_id', $employee->unit_id) == $unit->id ? 'selected' : '' }}>
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
                                        <option value="{{ $rankClass->id }}" {{ old('rank_class_id', $employee->rank_class_id) == $rankClass->id ? 'selected' : '' }}>
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
                                    <option value="civil_servant" {{ old('employment_status', $employee->employment_status) == 'civil_servant' ? 'selected' : '' }}>PNS</option>
                                    <option value="contract" {{ old('employment_status', $employee->employment_status) == 'contract' ? 'selected' : '' }}>Kontrak</option>
                                    <option value="temporary" {{ old('employment_status', $employee->employment_status) == 'temporary' ? 'selected' : '' }}>Honorer</option>
                                </select>
                                @error('employment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Status Lisensi</label>
                                <select class="form-control select2 @error('license_status') is-invalid @enderror" name="license_status">
                                    <option value="">-- Pilih Status Lisensi --</option>
                                    <option value="active" {{ old('license_status', $employee->license_status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="expired" {{ old('license_status', $employee->license_status) == 'expired' ? 'selected' : '' }}>Kadaluarsa</option>
                                    <option value="none" {{ old('license_status', $employee->license_status) == 'none' ? 'selected' : '' }}>Tidak Ada</option>
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
                                       value="{{ old('height_cm', $employee->height_cm) }}"
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
                                       value="{{ old('weight_kg', $employee->weight_kg) }}"
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
                                    <option value="A" {{ old('blood_type', $employee->blood_type) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('blood_type', $employee->blood_type) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('blood_type', $employee->blood_type) == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('blood_type', $employee->blood_type) == 'O' ? 'selected' : '' }}>O</option>
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
                               value="{{ old('hobbies', $employee->hobbies) }}">
                        @error('hobbies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Pisahkan dengan koma jika lebih dari satu</small>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
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
        });
    </script>
@endpush 