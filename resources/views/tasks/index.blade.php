@extends('layouts.app')

@section('content')
    {{-- TODO Day 3: build the tasks list page --}}
    {{-- Should display all tasks for the current project, grouped or filtered by status --}}
    {{-- TODO Day 5: replace hardcoded data with real DB data passed from the controller --}}
    {{-- TODO Day 9: use @can('update', $task) to conditionally show edit/delete buttons --}}

    <div class="container mx-auto py-8 px-4">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Tasks</h1>
                <p class="text-gray-600 mt-2">Project: <span class="font-semibold">{{ $project->name }}</span></p>
            </div>
            <a href="{{ route('projects.tasks.create', $project->id) }}" 
               class="inline-flex items-center bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                <span class="mr-2">+</span> New Task
            </a>
        </div>

        @if($tasks->count() > 0)
            <div class="space-y-4">
                @foreach($tasks as $task)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900">
                                    <a href="{{ route('projects.tasks.show', [$project, $task]) }}" 
                                       class="text-blue-600 hover:text-blue-800">
                                        {{ $task->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mt-2">{{ $task->description ? Str::limit($task->description, 150) : 'No description' }}</p>
                                
                                <div class="flex flex-wrap gap-3 mt-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                        @if($task->status == 'todo') bg-gray-200 text-gray-800
                                        @elseif($task->status == 'in_progress') bg-yellow-200 text-yellow-800
                                        @else bg-green-200 text-green-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                    
                                    @if($task->due_date)
                                        <span class="text-sm text-gray-600">
                                            Due: {{ $task->due_date->format('M d, Y') }}
                                        </span>
                                    @endif
                                    
                                    @if($task->assignee)
                                        <span class="text-sm text-gray-600">
                                            Assigned to: {{ $task->assignee->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('projects.tasks.show', [$project, $task]) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                                    View
                                </a>
                                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" 
                                   class="px-4 py-2 bg-yellow-600 text-Black rounded-lg text-sm font-semibold hover:bg-yellow-700 transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-Black rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <p class="text-gray-600 text-lg">No tasks found for this project.</p>
                <p class="text-gray-500 mt-2">
                    <a href="{{ route('projects.tasks.create', $project->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        Create the first task
                    </a>
                </p>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('projects.show', $project->id) }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                ← Back to Project
            </a>
        </div>
    </div>
@endsection