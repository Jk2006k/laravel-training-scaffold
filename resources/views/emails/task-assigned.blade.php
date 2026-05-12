<x-mail::message>
{{-- TODO Day 11: design the email — greet the user, show task title, due date, link --}}
# Task Assignment Notification

You have been assigned a new task!

**Task Title:** {{ $task->title }}

**Description:**
{{ $task->description ?? 'No description provided' }}

**Status:** {{ ucfirst(str_replace('_', ' ', $task->status)) }}

**Due Date:** {{ $task->due_date ? $task->due_date->format('F d, Y') : 'No due date' }}

**Project:** {{ $task->project->name }}

<x-mail::button :url="route('projects.tasks.show', [$task->project_id, $task->id])">
View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>