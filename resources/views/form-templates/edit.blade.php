@extends('layouts.app')

@section('title', 'Edit Form Template')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Form Template</h1>
        <div>
            <a href="{{ route('form-templates.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Templates
            </a>
            <a href="{{ route('form-templates.show', $formTemplate->id) }}" class="btn btn-sm btn-info shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i> View Template
            </a>
        </div>
    </div>

    @include('partials.alerts')

    <div class="row">
        <!-- Template Details -->
        <div class="col-md-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Template Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('form-templates.update', $formTemplate->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Template Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                                name="name" value="{{ old('name', $formTemplate->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" 
                                name="slug" value="{{ old('slug', $formTemplate->slug) }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" 
                                name="description" rows="3">{{ old('description', $formTemplate->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_file_uploads">Maximum File Uploads</label>
                            <input type="number" class="form-control @error('max_file_uploads') is-invalid @enderror" 
                                id="max_file_uploads" name="max_file_uploads" 
                                value="{{ old('max_file_uploads', $formTemplate->max_file_uploads) }}" min="0">
                            @error('max_file_uploads')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                id="sort_order" name="sort_order" 
                                value="{{ old('sort_order', $formTemplate->sort_order) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" 
                                    {{ old('is_active', $formTemplate->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Template</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form Fields -->
        <div class="col-md-7 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Fields</h6>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addFieldModal">
                        <i class="fas fa-plus fa-sm"></i> Add Field
                    </button>
                </div>
                <div class="card-body">
                    @if($formTemplate->fields->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="30">Order</th>
                                    <th>Label</th>
                                    <th>Key</th>
                                    <th>Type</th>
                                    <th>Required</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-fields">
                                @foreach($formTemplate->fields as $field)
                                <tr data-id="{{ $field->id }}">
                                    <td class="text-center handle">
                                        <i class="fas fa-grip-vertical text-muted cursor-move"></i>
                                        <input type="hidden" name="field_order[]" value="{{ $field->id }}">
                                    </td>
                                    <td>{{ $field->label }}</td>
                                    <td><code>{{ $field->key }}</code></td>
                                    <td>{{ Str::title(str_replace('_', ' ', $field->field_type)) }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-{{ $field->is_required ? 'danger' : 'secondary' }}">
                                            {{ $field->is_required ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm edit-field-btn" 
                                                data-field="{{ json_encode($field) }}" data-toggle="modal" data-target="#editFieldModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('form-fields.destroy', [$formTemplate->id, $field->id]) }}" 
                                                method="POST" class="d-inline delete-field-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">No fields added yet</p>
                        <p class="text-muted">Click "Add Field" to start building your form</p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addFieldModal">
                            <i class="fas fa-plus fa-sm"></i> Add Field
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Field Modal -->
<div class="modal fade" id="addFieldModal" tabindex="-1" role="dialog" aria-labelledby="addFieldModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFieldModalLabel">Add New Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('form-fields.store', $formTemplate->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_name">Field Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_key">Field Key <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field_key" name="key" required>
                                <small class="form-text text-muted">Unique identifier for this field (no spaces)</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_label">Label <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field_label" name="label" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_type">Field Type <span class="text-danger">*</span></label>
                                <select class="form-control" id="field_type" name="field_type" required>
                                    <option value="text">Text</option>
                                    <option value="textarea">Text Area</option>
                                    <option value="number">Number</option>
                                    <option value="email">Email</option>
                                    <option value="password">Password</option>
                                    <option value="date">Date</option>
                                    <option value="datetime">Date & Time</option>
                                    <option value="time">Time</option>
                                    <option value="select">Select (Dropdown)</option>
                                    <option value="multiselect">Multi-select</option>
                                    <option value="radio">Radio Buttons</option>
                                    <option value="checkbox">Checkboxes</option>
                                    <option value="file">File Upload</option>
                                    <option value="tel">Telephone</option>
                                    <option value="url">URL</option>
                                    <option value="hidden">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field_description">Description</label>
                        <textarea class="form-control" id="field_description" name="description" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_placeholder">Placeholder</label>
                                <input type="text" class="form-control" id="field_placeholder" name="placeholder">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_help_text">Help Text</label>
                                <input type="text" class="form-control" id="field_help_text" name="help_text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_default_value">Default Value</label>
                                <input type="text" class="form-control" id="field_default_value" name="default_value">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field_options">Options (for select, radio, checkbox)</label>
                                <textarea class="form-control" id="field_options" name="options" 
                                    rows="2" placeholder="key:value, one per line"></textarea>
                                <small class="form-text text-muted">Format: key:value, one per line</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="field_is_required" 
                                        name="is_required" value="1">
                                    <label class="custom-control-label" for="field_is_required">Required</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="field_is_unique" 
                                        name="is_unique" value="1">
                                    <label class="custom-control-label" for="field_is_unique">Unique</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="field_is_visible" 
                                        name="is_visible" value="1" checked>
                                    <label class="custom-control-label" for="field_is_visible">Visible</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field_min_length">Min Length</label>
                                <input type="number" class="form-control" id="field_min_length" name="min_length" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field_max_length">Max Length</label>
                                <input type="number" class="form-control" id="field_max_length" name="max_length" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field_width">Width</label>
                                <select class="form-control" id="field_width" name="width">
                                    <option value="full">Full Width</option>
                                    <option value="half">Half Width</option>
                                    <option value="third">Third Width</option>
                                    <option value="quarter">Quarter Width</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="sort_order" value="{{ $formTemplate->fields->count() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Field</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Field Modal -->
<div class="modal fade" id="editFieldModal" tabindex="-1" role="dialog" aria-labelledby="editFieldModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFieldModalLabel">Edit Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editFieldForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_name">Field Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_field_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_key">Field Key <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_field_key" name="key" required>
                                <small class="form-text text-muted">Unique identifier for this field (no spaces)</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_label">Label <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_field_label" name="label" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_type">Field Type <span class="text-danger">*</span></label>
                                <select class="form-control" id="edit_field_type" name="field_type" required>
                                    <option value="text">Text</option>
                                    <option value="textarea">Text Area</option>
                                    <option value="number">Number</option>
                                    <option value="email">Email</option>
                                    <option value="password">Password</option>
                                    <option value="date">Date</option>
                                    <option value="datetime">Date & Time</option>
                                    <option value="time">Time</option>
                                    <option value="select">Select (Dropdown)</option>
                                    <option value="multiselect">Multi-select</option>
                                    <option value="radio">Radio Buttons</option>
                                    <option value="checkbox">Checkboxes</option>
                                    <option value="file">File Upload</option>
                                    <option value="tel">Telephone</option>
                                    <option value="url">URL</option>
                                    <option value="hidden">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Rest of the edit field form similar to add field form -->
                    <div class="form-group">
                        <label for="edit_field_description">Description</label>
                        <textarea class="form-control" id="edit_field_description" name="description" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_placeholder">Placeholder</label>
                                <input type="text" class="form-control" id="edit_field_placeholder" name="placeholder">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_help_text">Help Text</label>
                                <input type="text" class="form-control" id="edit_field_help_text" name="help_text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_default_value">Default Value</label>
                                <input type="text" class="form-control" id="edit_field_default_value" name="default_value">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_field_options">Options (for select, radio, checkbox)</label>
                                <textarea class="form-control" id="edit_field_options" name="options" 
                                    rows="2" placeholder="key:value, one per line"></textarea>
                                <small class="form-text text-muted">Format: key:value, one per line</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="edit_field_is_required" 
                                        name="is_required" value="1">
                                    <label class="custom-control-label" for="edit_field_is_required">Required</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="edit_field_is_unique" 
                                        name="is_unique" value="1">
                                    <label class="custom-control-label" for="edit_field_is_unique">Unique</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="edit_field_is_visible" 
                                        name="is_visible" value="1">
                                    <label class="custom-control-label" for="edit_field_is_visible">Visible</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_field_min_length">Min Length</label>
                                <input type="number" class="form-control" id="edit_field_min_length" name="min_length" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_field_max_length">Max Length</label>
                                <input type="number" class="form-control" id="edit_field_max_length" name="max_length" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_field_width">Width</label>
                                <select class="form-control" id="edit_field_width" name="width">
                                    <option value="full">Full Width</option>
                                    <option value="half">Half Width</option>
                                    <option value="third">Third Width</option>
                                    <option value="quarter">Quarter Width</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="sort_order" id="edit_field_sort_order">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Field</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    // Get the PHP values we need from data attributes
    const templateId = {{ $formTemplate->id }};
    const orderUrl = "{{ route('form-fields.order', $formTemplate->id) }}";
    const csrfToken = "{{ csrf_token() }}";
    
    $(document).ready(function() {
        // Auto-generate key from field name for new fields
        $('#field_name').on('blur', function() {
            if ($('#field_key').val() === '') {
                const name = $(this).val();
                const key = name.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '_');
                $('#field_key').val(key);
            }
        });

        // Auto-copy label from name for new fields
        $('#field_name').on('blur', function() {
            if ($('#field_label').val() === '') {
                $('#field_label').val($(this).val());
            }
        });

        // Handle field edit button click
        $('.edit-field-btn').on('click', function() {
            const field = $(this).data('field');
            const form = $('#editFieldForm');
            
            // Set the form action URL
            form.attr('action', '/form-templates/' + templateId + '/fields/' + field.id);
            
            // Fill the form fields
            $('#edit_field_name').val(field.name);
            $('#edit_field_key').val(field.key);
            $('#edit_field_label').val(field.label);
            $('#edit_field_type').val(field.field_type);
            $('#edit_field_description').val(field.description);
            $('#edit_field_placeholder').val(field.placeholder);
            $('#edit_field_help_text').val(field.help_text);
            $('#edit_field_default_value').val(field.default_value);
            
            // Handle options for select/radio/checkbox
            if (field.options) {
                let optionsText = '';
                for (const [key, value] of Object.entries(field.options)) {
                    optionsText += key + ':' + value + '\n';
                }
                $('#edit_field_options').val(optionsText.trim());
            } else {
                $('#edit_field_options').val('');
            }
            
            // Set checkboxes
            $('#edit_field_is_required').prop('checked', field.is_required);
            $('#edit_field_is_unique').prop('checked', field.is_unique);
            $('#edit_field_is_visible').prop('checked', field.is_visible);
            
            // Set other field properties
            $('#edit_field_min_length').val(field.min_length);
            $('#edit_field_max_length').val(field.max_length);
            $('#edit_field_sort_order').val(field.sort_order);
            $('#edit_field_width').val(field.width);
        });

        // Handle field delete confirmation
        $('.delete-field-form').on('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this field? This action cannot be undone.')) {
                this.submit();
            }
        });

        // Make fields sortable
        $('#sortable-fields').sortable({
            handle: '.handle',
            update: function(event, ui) {
                const order = {};
                $('#sortable-fields tr').each(function(index) {
                    order[$(this).data('id')] = index;
                });
                
                // Save the new order via AJAX
                $.ajax({
                    url: orderUrl,
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        fields: Object.keys(order).map(id => {
                            return {
                                id: id,
                                sort_order: order[id]
                            };
                        })
                    },
                    success: function(response) {
                        console.log('Field order updated');
                    },
                    error: function(xhr) {
                        console.error('Error updating field order');
                    }
                });
            }
        });
    });
})();
</script>
@endpush 