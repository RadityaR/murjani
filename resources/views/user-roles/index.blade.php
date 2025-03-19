@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User Roles: {{ $user->username }}</h5>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <h5>Current Roles</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($userRoles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>
                                            <form action="{{ route('user-roles.remove', ['user' => $user->id, 'role' => $role->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this role?')">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No roles assigned</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5>Assign New Role</h5>
                    @if($availableRoles->count() > 0)
                        <form action="{{ route('user-roles.assign', $user) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Select Role</label>
                                <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                                    <option value="">-- Select a role --</option>
                                    @foreach($availableRoles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }} - {{ $role->description }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Assign Role</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info">
                            All available roles have already been assigned to this user.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 