@extends('layouts.app')

@section('title', 'Submit Form: ' . $formTemplate->name)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Submit Form: {{ $formTemplate->name }}</h1>
        <a href="{{ route('form-templates.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Templates
        </a>
    </div>

    @include('partials.alerts')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Fields</h6>
        </div>
        <div class="card-body">
            @if($formTemplate->fields->count() > 0)
                <form action="{{ route('form-submissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form_template_id" value="{{ $formTemplate->id }}">
                    <input type="hidden" name="status" value="draft">
                    
                    <div class="row">
                        @php
                            $currentSection = null;
                        @endphp
                        
                        @foreach($formTemplate->fields as $field)
                            @if($field->section && $field->section !== $currentSection)
                                @if($currentSection !== null)
                                    </div> <!-- Close previous section row -->
                                @endif
                                
                                <div class="col-12">
                                    <h5 class="border-bottom pb-2 mb-3 mt-3">{{ $field->section }}</h5>
                                </div>
                                <div class="row">
                                @php $currentSection = $field->section; @endphp
                            @endif
                            
                            @if(!$field->section && $currentSection !== null)
                                </div> <!-- Close previous section row -->
                                <div class="row">
                                @php $currentSection = null; @endphp
                            @endif
                            
                            <div class="col-md-{{ $field->width === 'full' ? '12' : ($field->width === 'half' ? '6' : ($field->width === 'third' ? '4' : '3')) }}">
                                <div class="form-group">
                                    @switch($field->field_type)
                                        @case('text')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="text" class="form-control @error('form_data.' . $field->key) is-invalid @enderror" 
                                                id="field_{{ $field->id }}" name="form_data[{{ $field->key }}]" 
                                                placeholder="{{ $field->placeholder }}" {{ $field->is_required ? 'required' : '' }}
                                                value="{{ old('form_data.' . $field->key, $field->default_value) }}">
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @error('form_data.' . $field->key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @break
                                            
                                        @case('textarea')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <textarea class="form-control @error('form_data.' . $field->key) is-invalid @enderror" 
                                                id="field_{{ $field->id }}" name="form_data[{{ $field->key }}]" rows="3" 
                                                placeholder="{{ $field->placeholder }}" {{ $field->is_required ? 'required' : '' }}
                                            >{{ old('form_data.' . $field->key, $field->default_value) }}</textarea>
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @error('form_data.' . $field->key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @break
                                            
                                        @case('select')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <select class="form-control @error('form_data.' . $field->key) is-invalid @enderror" 
                                                id="field_{{ $field->id }}" name="form_data[{{ $field->key }}]" 
                                                {{ $field->is_required ? 'required' : '' }}>
                                                <option value="">-- Select an option --</option>
                                                @if($field->options)
                                                    @foreach($field->options as $value => $label)
                                                        <option value="{{ $value }}" 
                                                            {{ old('form_data.' . $field->key, $field->default_value) == $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @error('form_data.' . $field->key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @break
                                            
                                        @case('file')
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('form_data.' . $field->key) is-invalid @enderror" 
                                                    id="field_{{ $field->id }}" name="form_files[{{ $field->key }}]" 
                                                    {{ $field->is_required ? 'required' : '' }}>
                                                <label class="custom-file-label" for="field_{{ $field->id }}">
                                                    {{ $field->placeholder ?: 'Choose file' }}
                                                </label>
                                            </div>
                                            <input type="hidden" name="form_field_ids[{{ $field->key }}]" value="{{ $field->id }}">
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @error('form_data.' . $field->key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @break
                                            
                                        @case('radio')
                                            <label class="d-block">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            @if($field->options)
                                                @foreach($field->options as $value => $label)
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input @error('form_data.' . $field->key) is-invalid @enderror" 
                                                            id="field_{{ $field->id }}_{{ $value }}" name="form_data[{{ $field->key }}]" 
                                                            value="{{ $value }}" {{ $field->is_required ? 'required' : '' }}
                                                            {{ old('form_data.' . $field->key, $field->default_value) == $value ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="field_{{ $field->id }}_{{ $value }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @error('form_data.' . $field->key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @break
                                            
                                        @case('checkbox')
                                            <label class="d-block">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            @if($field->options)
                                                @foreach($field->options as $value => $label)
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input @error('form_data.' . $field->key) is-invalid @enderror" 
                                                            id="field_{{ $field->id }}_{{ $value }}" name="form_data[{{ $field->key }}][]" 
                                                            value="{{ $value }}" {{ $field->is_required ? 'required' : '' }}
                                                            {{ is_array(old('form_data.' . $field->key, [])) && in_array($value, old('form_data.' . $field->key, [])) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="field_{{ $field->id }}_{{ $value }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @error('form_data.' . $field->key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @break
                                            
                                        @default
                                            <label for="field_{{ $field->id }}">
                                                {{ $field->label }}
                                                @if($field->is_required) <span class="text-danger">*</span> @endif
                                            </label>
                                            <input type="{{ $field->field_type }}" class="form-control @error('form_data.' . $field->key) is-invalid @enderror" 
                                                id="field_{{ $field->id }}" name="form_data[{{ $field->key }}]" 
                                                placeholder="{{ $field->placeholder }}" {{ $field->is_required ? 'required' : '' }}
                                                value="{{ old('form_data.' . $field->key, $field->default_value) }}">
                                            @if($field->help_text)
                                                <small class="form-text text-muted">{{ $field->help_text }}</small>
                                            @endif
                                            @error('form_data.' . $field->key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    @endswitch
                                </div>
                            </div>
                        @endforeach
                        
                        @if($currentSection !== null)
                            </div> <!-- Close last section row if exists -->
                        @endif
                    </div>

                    <!-- Additional file uploads section -->
                    @if($formTemplate->max_file_uploads > 0)
                        <div class="mt-4">
                            <h5 class="border-bottom pb-2 mb-3">Additional Documents</h5>
                            <div class="row" id="additional-documents">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="additional_file_1">Document 1</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="additional_file_1" name="additional_files[]">
                                            <label class="custom-file-label" for="additional_file_1">Choose file</label>
                                        </div>
                                        <div class="input-group mt-2">
                                            <input type="text" class="form-control" name="document_types[]" placeholder="Document type">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                            </div>
                                        </div>
                                        <textarea class="form-control mt-2" name="document_descriptions[]" rows="2" placeholder="Document description (optional)"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-secondary" id="add-document-btn">
                                        <i class="fas fa-plus"></i> Add Document
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notes">Notes (Optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" id="status_draft" name="status" value="draft" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="status_draft">Save as Draft</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="status_submitted" name="status" value="submitted" class="custom-control-input">
                                    <label class="custom-control-label" for="status_submitted">Submit for Review</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Form</button>
                        <a href="{{ route('form-templates.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            @else
                <div class="text-center py-5">
                    <p class="text-muted mb-0">This form template has no fields defined.</p>
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
@endsection

@push('scripts')
<script>
(function() {
    // Safely convert PHP variables to JavaScript
    const maxDocuments = @json($formTemplate->max_file_uploads);
    
    $(document).ready(function() {
        // Handle file input labels
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName || 'Choose file');
        });
        
        // Add more document upload fields
        let documentCount = 1;
        
        $('#add-document-btn').on('click', function() {
            if (documentCount < maxDocuments) {
                documentCount++;
                
                const newDocField = `
                    <div class="col-md-6 additional-document">
                        <div class="form-group">
                            <label for="additional_file_${documentCount}">Document ${documentCount}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="additional_file_${documentCount}" name="additional_files[]">
                                <label class="custom-file-label" for="additional_file_${documentCount}">Choose file</label>
                            </div>
                            <div class="input-group mt-2">
                                <input type="text" class="form-control" name="document_types[]" placeholder="Document type">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                            </div>
                            <textarea class="form-control mt-2" name="document_descriptions[]" rows="2" placeholder="Document description (optional)"></textarea>
                            <button type="button" class="btn btn-sm btn-danger remove-document-btn mt-2">
                                <i class="fas fa-times"></i> Remove
                            </button>
                        </div>
                    </div>
                `;
                
                // Insert before the 'Add Document' button
                $(newDocField).insertBefore('#add-document-btn').parent();
                
                // Update file input event listeners
                $('.custom-file-input').on('change', function() {
                    let fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').html(fileName || 'Choose file');
                });
                
                // Hide add button if max reached
                if (documentCount >= maxDocuments) {
                    $('#add-document-btn').hide();
                }
            }
        });
        
        // Remove document upload field
        $(document).on('click', '.remove-document-btn', function() {
            $(this).closest('.additional-document').remove();
            documentCount--;
            
            // Show add button if below max
            if (documentCount < maxDocuments) {
                $('#add-document-btn').show();
            }
        });
    });
})();
</script>
@endpush 