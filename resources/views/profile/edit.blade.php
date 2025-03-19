@extends('layouts.app')

@section('title', 'Edit Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
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

        <div class="card">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h4>Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $user->nip) }}" readonly>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select id="department_id" name="department_id" class="form-control select2 @error('department_id') is-invalid @enderror">
                                    <option value="">Select Department</option>
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
                                <label for="position">Position</label>
                                <input type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $user->position) }}">
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employee_status">Status Pegawai</label>
                                <select id="employee_status" name="employee_status" class="form-control select2 @error('employee_status') is-invalid @enderror">
                                    <option value="">Pilih Status Pegawai</option>
                                    <option value="Kontrak" {{ old('employee_status', $user->employee_status) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                    <option value="PNS" {{ old('employee_status', $user->employee_status) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ old('employee_status', $user->employee_status) == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                </select>
                                @error('employee_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="golongan_pangkat">Golongan/Pangkat</label>
                                <input type="text" id="golongan_pangkat" name="golongan_pangkat" class="form-control @error('golongan_pangkat') is-invalid @enderror" value="{{ old('golongan_pangkat', $user->golongan_pangkat) }}" placeholder="Contoh: III/a">
                                <small class="form-text text-muted">Masukkan golongan/pangkat (contoh: III/a)</small>
                                @error('golongan_pangkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $user->jabatan) }}" placeholder="Contoh: Kepala Seksi">
                                <small class="form-text text-muted">Masukkan jabatan (contoh: Kepala Seksi)</small>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit_kerja">Unit Kerja</label>
                                <input type="text" id="unit_kerja" name="unit_kerja" class="form-control @error('unit_kerja') is-invalid @enderror" value="{{ old('unit_kerja', $user->unit_kerja) }}" placeholder="Contoh: Puskesmas">
                                <small class="form-text text-muted">Masukkan unit kerja (contoh: Puskesmas)</small>
                                @error('unit_kerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card-header">
                    <h4>Education</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" id="add-education">
                            <i class="fas fa-plus"></i> Add Education
                        </button>
                    </div>
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
                                                <label>Education Type <span class="text-danger">*</span></label>
                                                <select name="educations[{{ $index }}][type]" class="form-control education-type @error('educations.'.$index.'.type') is-invalid @enderror" required>
                                                    <option value="">Select Type</option>
                                                    <option value="formal" {{ old('educations.'.$index.'.type', $education->type) == 'formal' ? 'selected' : '' }}>Formal</option>
                                                    <option value="informal" {{ old('educations.'.$index.'.type', $education->type) == 'informal' ? 'selected' : '' }}>Informal</option>
                                                </select>
                                                @error('educations.'.$index.'.type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Institution Name <span class="text-danger">*</span></label>
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
                                                <label>Start Date</label>
                                                <input type="text" name="educations[{{ $index }}][start_date]" class="form-control datepicker @error('educations.'.$index.'.start_date') is-invalid @enderror" value="{{ old('educations.'.$index.'.start_date', $education->start_date ? $education->start_date->format('Y-m-d') : '') }}">
                                                @error('educations.'.$index.'.start_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="text" name="educations[{{ $index }}][end_date]" class="form-control datepicker @error('educations.'.$index.'.end_date') is-invalid @enderror" value="{{ old('educations.'.$index.'.end_date', $education->end_date ? $education->end_date->format('Y-m-d') : '') }}">
                                                @error('educations.'.$index.'.end_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Education Level <span class="text-danger">*</span></label>
                                                <select name="educations[{{ $index }}][level]" class="form-control @error('educations.'.$index.'.level') is-invalid @enderror" {{ old('educations.'.$index.'.type', $education->type) == 'formal' ? 'required' : '' }}>
                                                    <option value="">Select Level</option>
                                                    <option value="SD" {{ old('educations.'.$index.'.level', $education->level) == 'SD' ? 'selected' : '' }}>SD</option>
                                                    <option value="SLTP" {{ old('educations.'.$index.'.level', $education->level) == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                                    <option value="SLTA" {{ old('educations.'.$index.'.level', $education->level) == 'SLTA' ? 'selected' : '' }}>SLTA</option>
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
                                    </div>
                                    <div class="row informal-education" {!! old('educations.'.$index.'.type', $education->type) != 'informal' ? 'style=display:none' : '' !!}>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Course Name <span class="text-danger">*</span></label>
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
                                                <label>Description</label>
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

                <div class="card-footer text-right">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
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
                                        <label>Education Type <span class="text-danger">*</span></label>
                                        <select name="educations[\${educationIndex}][type]" class="form-control education-type" required>
                                            <option value="">Select Type</option>
                                            <option value="formal">Formal</option>
                                            <option value="informal">Informal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Institution Name <span class="text-danger">*</span></label>
                                        <input type="text" name="educations[\${educationIndex}][institution_name]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" name="educations[\${educationIndex}][start_date]" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" name="educations[\${educationIndex}][end_date]" class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Education Level <span class="text-danger">*</span></label>
                                        <select name="educations[\${educationIndex}][level]" class="form-control">
                                            <option value="">Select Level</option>
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
                            </div>
                            <div class="row informal-education" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Course Name <span class="text-danger">*</span></label>
                                        <input type="text" name="educations[\${educationIndex}][course_name]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="educations[\${educationIndex}][description]" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                $('#education-container').append(template);
                
                // Initialize new datepickers
                $('.datepicker').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                
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