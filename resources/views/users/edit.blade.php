@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nip">NIP <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('nip') is-invalid @enderror" 
                                               id="nip" 
                                               name="nip" 
                                               value="{{ old('nip', $user->nip) }}" 
                                               required>
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password"
                                               placeholder="Leave blank to keep current password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="department">Department</label>
                                        <input type="text" 
                                               class="form-control @error('department') is-invalid @enderror" 
                                               id="department" 
                                               name="department" 
                                               value="{{ old('department', $user->department) }}">
                                        @error('department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="position">Position</label>
                                        <input type="text" 
                                               class="form-control @error('position') is-invalid @enderror" 
                                               id="position" 
                                               name="position" 
                                               value="{{ old('position', $user->position) }}">
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select class="form-control select2 @error('role') is-invalid @enderror" 
                                                id="role" 
                                                name="role" 
                                                {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}
                                                required>
                                            <option value="">Select Role</option>
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="hr" {{ old('role', $user->role) == 'hr' ? 'selected' : '' }}>HR</option>
                                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-control select2 @error('status') is-invalid @enderror" 
                                                id="status" 
                                                name="status" 
                                                {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}
                                                required>
                                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="suspended" {{ old('status', $user->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Permissions</label>
                                        <div class="selectgroup selectgroup-pills">
                                            <label class="selectgroup-item">
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="view_reports" 
                                                       class="selectgroup-input"
                                                       {{ in_array('view_reports', old('permissions', $user->permissions ?? [])) ? 'checked' : '' }}
                                                       {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
                                                <span class="selectgroup-button">View Reports</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="manage_employees" 
                                                       class="selectgroup-input"
                                                       {{ in_array('manage_employees', old('permissions', $user->permissions ?? [])) ? 'checked' : '' }}
                                                       {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
                                                <span class="selectgroup-button">Manage Employees</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="manage_departments" 
                                                       class="selectgroup-input"
                                                       {{ in_array('manage_departments', old('permissions', $user->permissions ?? [])) ? 'checked' : '' }}
                                                       {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
                                                <span class="selectgroup-button">Manage Departments</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                                              id="notes" 
                                              name="notes" 
                                              rows="3">{{ old('notes', $user->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Update User
                                    </button>
                                    <a href="{{ route('users.index') }}" class="btn btn-link">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();
        });
    </script>
@endpush 