<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'due_date' => 'nullable|date|after:today',
            //'project_id' => 'required|exists:projects,id',
            'assigned_to_id' => 'nullable|exists:users,id',
            'attachment' => 'nullable|file|max:10240',
        ];
    }

    public function messages(): array
    {
        // TODO Day 7 (optional): customize error messages
        return [
            'title.required' => 'Task title is required.',
            'status.required' => 'Please select a task status.',
            'status.in' => 'The selected status is invalid.',
            'due_date.date' => 'Please provide a valid date.',
            'due_date.after' => 'The due date must be in the future.',
            'project_id.required' => 'Please select a project.',
            'project_id.exists' => 'The selected project does not exist.',
            'assigned_to_id.exists' => 'The selected user does not exist.',
        ];
    }
}