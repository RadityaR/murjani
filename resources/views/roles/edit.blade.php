@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Role: {{ $role->name }}</h5>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles</a>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="view_users" id="perm_view_users" {{ in_array('view_users', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_view_users">View Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="create_users" id="perm_create_users" {{ in_array('create_users', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_create_users">Create Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="edit_users" id="perm_edit_users" {{ in_array('edit_users', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_edit_users">Edit Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="delete_users" id="perm_delete_users" {{ in_array('delete_users', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_delete_users">Delete Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="view_employees" id="perm_view_employees" {{ in_array('view_employees', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_view_employees">View Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="create_employees" id="perm_create_employees" {{ in_array('create_employees', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_create_employees">Create Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="edit_employees" id="perm_edit_employees" {{ in_array('edit_employees', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_edit_employees">Edit Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="delete_employees" id="perm_delete_employees" {{ in_array('delete_employees', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_delete_employees">Delete Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="all" id="perm_all" {{ in_array('all', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_all">All Permissions</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $role->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 