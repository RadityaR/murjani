@extends('layouts.app')

@section('title', $formTemplate->name)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $formTemplate->name }}</h1>
        <div>
            <a href="{{ route('form-templates.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Templates
            </a>
            <a href="{{ route('form-templates.edit', $formTemplate->id) }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit Template
            </a>
            <a href="{{ route('form-submissions.create-from-template', $formTemplate->id) }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-file-alt fa-sm text-white-50"></i> Submit Form
            </a>
        </div>
    </div>

    @include('partials.alerts')

    <div class="row">
        <!-- Template Details -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Template Details</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge badge-{{ $formTemplate->is_active ? 'success' : 'secondary' }} mb-2">
                            {{ $formTemplate->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        
                        <p class="mb-1"><strong>Description:</strong></p>
                        <p>{{ $formTemplate->description ?: 'No description provided' }}</p>
                        
                        <p class="mb-1"><strong>Slug:</strong></p>
                        <p><code>{{ $formTemplate->slug }}</code></p>
                        
                        <p class="mb-1"><strong>Maximum File Uploads:</strong></p>
                        <p>{{ $formTemplate->max_file_uploads }}</p>
                        
                        <p class="mb-1"><strong>Created By:</strong></p>
                        <p>{{ $formTemplate->creator->name ?? 'Unknown' }}</p>
                        
                        <p class="mb-1"><strong>Created At:</strong></p>
                        <p>{{ $formTemplate->created_at->format('M d, Y H:i') }}</p>
                        
                        <p class="mb-1"><strong>Last Updated:</strong></p>
                        <p>{{ $formTemplate->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Preview -->
        <div class="col-md-8 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Preview</h6>
                </div>
                <div class="card-body">
                    @if($formTemplate->fields->count() > 0)
                        <form>
                            @php
                                $currentSection = null;
                            @endphp
                            
                            @foreach($formTemplate->fields as $field)
                                @if($field->section && $field->section !== $currentSection)
                                    @if($currentSection !== null)
                                        </div> <!-- Close previous section -->
                                    @endif
                                    
                                    <div class="form-section mb-4">
                                        <h5 class="border-bottom pb-2 mb-3">{{ $field->section }}</h5>
                                        @php $currentSection = $field->section; @endphp
                                @endif
                                
                                @if(!$field->section && $currentSection !== null)
                                    </div> <!-- Close previous section if moving to no section -->
                                    @php $currentSection = null; @endphp
                                @endif
                                
                                <div class="form-group {{ $field->width === 'full' ? 'col-md-12' : ($field->width === 'half' ? 'col-md-6' : ($field->width === 'third' ? 'col-md-4' : 'col-md-3')) }}">
                                    @switch($field->field_type)
                                        @case('text')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="text" class="form-control" id="field_{{ $field->id }}" 
                                                name="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                                                {{ $field->is_required ? 'required' : '' }}
                                                value="{{ $field->default_value }}">
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @break
                                            
                                        @case('textarea')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <textarea class="form-control" id="field_{{ $field->id }}" 
                                                name="{{ $field->key }}" rows="3" placeholder="{{ $field->placeholder }}"
                                                {{ $field->is_required ? 'required' : '' }}>{{ $field->default_value }}</textarea>
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @break
                                            
                                        @case('select')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <select class="form-control" id="field_{{ $field->id }}" 
                                                name="{{ $field->key }}" {{ $field->is_required ? 'required' : '' }}>
                                                <option value="">-- Select an option --</option>
                                                @if($field->options)
                                                    @foreach($field->options as $value => $label)
                                                        <option value="{{ $value }}" 
                                                            {{ $field->default_value == $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @break
                                            
                                        @case('file')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="field_{{ $field->id }}" 
                                                    name="{{ $field->key }}" {{ $field->is_required ? 'required' : '' }}>
                                                <label class="custom-file-label" for="field_{{ $field->id }}">
                                                    {{ $field->placeholder ?: 'Choose file' }}
                                                </label>
                                            </div>
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @break
                                            
                                        @default
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }} ({{ ucfirst($field->field_type) }})
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="{{ $field->field_type }}" class="form-control" id="field_{{ $field->id }}" 
                                                name="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
                                                {{ $field->is_required ? 'required' : '' }}
                                                value="{{ $field->default_value }}">
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                    @endswitch
                                </div>
                            @endforeach
                            
                            @if($currentSection !== null)
                                </div> <!-- Close last section if exists -->
                            @endif
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary" disabled>Submit</button>
                                <div class="text-muted small mt-2">This is just a preview, submission is disabled</div>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted mb-0">No fields have been added to this form template yet.</p>
                            <p>
                                <a href="{{ route('form-templates.edit', $formTemplate->id) }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus fa-sm"></i> Add Fields
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 