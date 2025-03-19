<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_template_id',
        'name',
        'key',
        'label',
        'field_type',
        'description',
        'placeholder',
        'help_text',
        'default_value',
        'options',
        'validation_rules',
        'is_required',
        'is_unique',
        'is_visible',
        'is_editable',
        'min_length',
        'max_length',
        'sort_order',
        'section',
        'width',
        'conditional_logic',
    ];

    protected $casts = [
        'options' => 'array',
        'validation_rules' => 'array',
        'conditional_logic' => 'array',
        'is_required' => 'boolean',
        'is_unique' => 'boolean',
        'is_visible' => 'boolean',
        'is_editable' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the form template that owns the field
     */
    public function formTemplate()
    {
        return $this->belongsTo(FormTemplate::class);
    }

    /**
     * Get the documents associated with this field
     */
    public function documents()
    {
        return $this->hasMany(FormDocument::class);
    }

    /**
     * Check if field is file upload type
     */
    public function isFileUpload()
    {
        return $this->field_type === 'file';
    }

    /**
     * Check if field has options (select, radio, checkbox)
     */
    public function hasOptions()
    {
        return in_array($this->field_type, ['select', 'multiselect', 'radio', 'checkbox']);
    }

    /**
     * Get field options as key-value pairs
     */
    public function getOptionsArray()
    {
        return $this->options ?? [];
    }
} 