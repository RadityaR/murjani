@extends('layouts.app')

@section('title', 'Form Templates')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Templates</h1>
        <a href="{{ route('form-templates.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create New Template
        </a>
    </div>

    @include('partials.alerts')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Available Templates</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Fields</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($formTemplates as $template)
                        <tr>
                            <td>{{ $template->name }}</td>
                            <td>{{ Str::limit($template->description, 50) }}</td>
                            <td>{{ $template->fields->count() }}</td>
                            <td>
                                <span class="badge badge-{{ $template->is_active ? 'success' : 'secondary' }}">
                                    {{ $template->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $template->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('form-templates.show', $template->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('form-templates.edit', $template->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('form-submissions.create-from-template', $template->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-file-alt"></i> Submit
                                    </a>
                                    <form action="{{ route('form-templates.toggle-active', $template->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-{{ $template->is_active ? 'secondary' : 'success' }} btn-sm">
                                            <i class="fas fa-{{ $template->is_active ? 'times' : 'check' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('form-templates.destroy', $template->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No form templates found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this template? This action cannot be undone.')) {
                this.submit();
            }
        });
    });
</script>
@endpush 