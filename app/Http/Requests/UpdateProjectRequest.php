<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidProjectName;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // TODO Day 7: define validation rules
        // Hint:
        //   'name' => 'required|string|max:255',
        //   'description' => 'nullable|string',
        //   'status' => 'required|in:active,archived,completed',
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('projects', 'name')->ignore($this->project->id), new ValidProjectName()],
            'description' => 'nullable|string',
            'status' => 'required|in:active,pending,completed',
        ];
    }

    public function messages(): array
    {
        // TODO Day 7 (optional): customize error messages
        return [
            'name.required' => 'Project name is required.',
            'name.unique' => 'A project with this name already exists.',
            'status.required' => 'Please select a project status.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}