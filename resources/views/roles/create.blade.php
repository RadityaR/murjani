@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create New Role</h5>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles</a>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="view_users" id="perm_view_users">
                        <label class="form-check-label" for="perm_view_users">View Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="create_users" id="perm_create_users">
                        <label class="form-check-label" for="perm_create_users">Create Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="edit_users" id="perm_edit_users">
                        <label class="form-check-label" for="perm_edit_users">Edit Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="delete_users" id="perm_delete_users">
                        <label class="form-check-label" for="perm_delete_users">Delete Users</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="view_employees" id="perm_view_employees">
                        <label class="form-check-label" for="perm_view_employees">View Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="create_employees" id="perm_create_employees">
                        <label class="form-check-label" for="perm_create_employees">Create Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="edit_employees" id="perm_edit_employees">
                        <label class="form-check-label" for="perm_edit_employees">Edit Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="delete_employees" id="perm_delete_employees">
                        <label class="form-check-label" for="perm_delete_employees">Delete Employees</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="all" id="perm_all">
                        <label class="form-check-label" for="perm_all">All Permissions</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 