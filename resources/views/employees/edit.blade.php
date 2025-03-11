@extends('layouts.app')

@section('title', 'Edit Employee')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Employee</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></div>
            <div class="breadcrumb-item"><a href="{{ route('employees.show', $employee) }}">{{ $employee->name }}</a></div>
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

        <div class="card">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h4>Employee Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $employee->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                                <input type="text" id="date_of_birth" name="date_of_birth" class="form-control datepicker @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $employee->date_of_birth->format('Y-m-d')) }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                <select id="gender" name="gender" class="form-control select2 @error('gender') is-invalid @enderror" required>
                                    <option value="">Select Gender</option>
                                    <option value="Laki-Laki" {{ old('gender', $employee->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ old('gender', $employee->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                                <select id="marital_status" name="marital_status" class="form-control select2 @error('marital_status') is-invalid @enderror" required>
                                    <option value="">Select Marital Status</option>
                                    <option value="Belum Menikah" {{ old('marital_status', $employee->marital_status) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old('marital_status', $employee->marital_status) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Duda" {{ old('marital_status', $employee->marital_status) == 'Duda' ? 'selected' : '' }}>Duda</option>
                                    <option value="Janda" {{ old('marital_status', $employee->marital_status) == 'Janda' ? 'selected' : '' }}>Janda</option>
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
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $employee->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="height_cm">Height (cm) <span class="text-danger">*</span></label>
                                <input type="number" id="height_cm" name="height_cm" class="form-control @error('height_cm') is-invalid @enderror" value="{{ old('height_cm', $employee->height_cm) }}" required>
                                @error('height_cm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="weight_kg">Weight (kg) <span class="text-danger">*</span></label>
                                <input type="number" id="weight_kg" name="weight_kg" class="form-control @error('weight_kg') is-invalid @enderror" value="{{ old('weight_kg', $employee->weight_kg) }}" required>
                                @error('weight_kg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="blood_type">Blood Type <span class="text-danger">*</span></label>
                                <select id="blood_type" name="blood_type" class="form-control select2 @error('blood_type') is-invalid @enderror" required>
                                    <option value="">Select Blood Type</option>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="religion">Religion <span class="text-danger">*</span></label>
                                <input type="text" id="religion" name="religion" class="form-control @error('religion') is-invalid @enderror" value="{{ old('religion', $employee->religion) }}" required>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hobby">Hobby <span class="text-danger">*</span></label>
                                <input type="text" id="hobby" name="hobby" class="form-control @error('hobby') is-invalid @enderror" value="{{ old('hobby', $employee->hobby) }}" required>
                                @error('hobby')
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
                    <div id="education-container">
                        @forelse($employee->educations as $index => $education)
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
                                        <div class="col-md-6 formal-education" style="{{ old('educations.'.$index.'.type', $education->type) != 'formal' ? 'display: none;' : '' }}">
                                            <div class="form-group">
                                                <label>Level <span class="text-danger">*</span></label>
                                                <select name="educations[{{ $index }}][level]" class="form-control @error('educations.'.$index.'.level') is-invalid @enderror" {{ old('educations.'.$index.'.type', $education->type) == 'formal' ? 'required' : '' }}>
                                                    <option value="">Select Level</option>
                                                    <option value="SD" {{ old('educations.'.$index.'.level', $education->level) == 'SD' ? 'selected' : '' }}>SD</option>
                                                    <option value="SLTP" {{ old('educations.'.$index.'.level', $education->level) == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                                    <option value="SLTA" {{ old('educations.'.$index.'.level', $education->level) == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                                                    <option value="Perguruan Tinggi" {{ old('educations.'.$index.'.level', $education->level) == 'Perguruan Tinggi' ? 'selected' : '' }}>Perguruan Tinggi</option>
                                                </select>
                                                @error('educations.'.$index.'.level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 informal-education" style="{{ old('educations.'.$index.'.type', $education->type) != 'informal' ? 'display: none;' : '' }}">
                                            <div class="form-group">
                                                <label>Course Name <span class="text-danger">*</span></label>
                                                <input type="text" name="educations[{{ $index }}][course_name]" class="form-control @error('educations.'.$index.'.course_name') is-invalid @enderror" value="{{ old('educations.'.$index.'.course_name', $education->course_name) }}" {{ old('educations.'.$index.'.type', $education->type) == 'informal' ? 'required' : '' }}>
                                                @error('educations.'.$index.'.course_name')
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

                <!-- Work Experience Section -->
                <div class="card-header">
                    <h4>Work Experience</h4>
                    <div class="card-header-action">
                        <button type="button" class="btn btn-primary" id="add-work-experience">
                            <i class="fas fa-plus"></i> Add Work Experience
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="work-experience-container">
                        @forelse($employee->workExperiences as $index => $workExperience)
                            <div class="work-experience-item card mb-3">
                                <div class="card-body">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-danger remove-work-experience">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="work_experiences[{{ $index }}][id]" value="{{ $workExperience->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company <span class="text-danger">*</span></label>
                                                <input type="text" name="work_experiences[{{ $index }}][company]" class="form-control @error('work_experiences.'.$index.'.company') is-invalid @enderror" value="{{ old('work_experiences.'.$index.'.company', $workExperience->company) }}" required>
                                                @error('work_experiences.'.$index.'.company')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <input type="text" name="work_experiences[{{ $index }}][position]" class="form-control @error('work_experiences.'.$index.'.position') is-invalid @enderror" value="{{ old('work_experiences.'.$index.'.position', $workExperience->position) }}">
                                                @error('work_experiences.'.$index.'.position')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="text" name="work_experiences[{{ $index }}][start_date]" class="form-control datepicker @error('work_experiences.'.$index.'.start_date') is-invalid @enderror" value="{{ old('work_experiences.'.$index.'.start_date', $workExperience->start_date ? $workExperience->start_date->format('Y-m-d') : '') }}">
                                                @error('work_experiences.'.$index.'.start_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="text" name="work_experiences[{{ $index }}][end_date]" class="form-control datepicker @error('work_experiences.'.$index.'.end_date') is-invalid @enderror" value="{{ old('work_experiences.'.$index.'.end_date', $workExperience->end_date ? $workExperience->end_date->format('Y-m-d') : '') }}">
                                                @error('work_experiences.'.$index.'.end_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="work_experiences[{{ $index }}][description]" class="form-control @error('work_experiences.'.$index.'.description') is-invalid @enderror" rows="3">{{ old('work_experiences.'.$index.'.description', $workExperience->description) }}</textarea>
                                                @error('work_experiences.'.$index.'.description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- No existing work experience records -->
                        @endforelse
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
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
            let educationIndex = {{ $employee->educations->count() }};
            
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
                                        <select name="educations[${educationIndex}][type]" class="form-control education-type" required>
                                            <option value="">Select Type</option>
                                            <option value="formal">Formal</option>
                                            <option value="informal">Informal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Institution Name <span class="text-danger">*</span></label>
                                        <input type="text" name="educations[${educationIndex}][institution_name]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 formal-education" style="display: none;">
                                    <div class="form-group">
                                        <label>Level <span class="text-danger">*</span></label>
                                        <select name="educations[${educationIndex}][level]" class="form-control">
                                            <option value="">Select Level</option>
                                            <option value="SD">SD</option>
                                            <option value="SLTP">SLTP</option>
                                            <option value="SLTA">SLTA</option>
                                            <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 informal-education" style="display: none;">
                                    <div class="form-group">
                                        <label>Course Name <span class="text-danger">*</span></label>
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
            
            // Remove education item
            $(document).on('click', '.remove-education', function() {
                $(this).closest('.education-item').remove();
            });
            
            // Toggle education fields based on type
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
            let workExperienceIndex = {{ $employee->workExperiences->count() }};
            
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
                                        <label>Company <span class="text-danger">*</span></label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][company]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][position]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][start_date]" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" name="work_experiences[${workExperienceIndex}][end_date]" class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="work_experiences[${workExperienceIndex}][description]" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                $('#work-experience-container').append(template);
                
                // Initialize datepicker for new elements
                $('.datepicker').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                
                workExperienceIndex++;
            });
            
            // Remove work experience item
            $(document).on('click', '.remove-work-experience', function() {
                $(this).closest('.work-experience-item').remove();
            });
        });
    </script>
@endpush 