@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Role Details: {{ $role->name }}</h5>
            <div>
                <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit Role</a>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Name:</div>
                <div class="col-md-9">{{ $role->name }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Slug:</div>
                <div class="col-md-9">{{ $role->slug }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Description:</div>
                <div class="col-md-9">{{ $role->description ?? 'No description' }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Status:</div>
                <div class="col-md-9">
                    <span class="badge {{ $role->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $role->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Permissions:</div>
                <div class="col-md-9">
                    @if(is_array($role->permissions) && count($role->permissions) > 0)
                        @foreach($role->permissions as $permission)
                            <span class="badge bg-info me-2">{{ $permission }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">No permissions assigned</span>
                    @endif
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Created At:</div>
                <div class="col-md-9">{{ $role->created_at->format('M d, Y H:i:s') }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Updated At:</div>
                <div class="col-md-9">{{ $role->updated_at->format('M d, Y H:i:s') }}</div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Users with this role:</div>
                <div class="col-md-9">
                    <ul class="list-group">
                        @forelse($role->users as $user)
                            <li class="list-group-item">
                                <a href="{{ route('users.show', $user) }}">{{ $user->username }}</a>
                            </li>
                        @empty
                            <li class="list-group-item">No users assigned to this role</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 