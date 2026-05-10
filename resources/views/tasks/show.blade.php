<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $task->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- TODO Day 3: build the task detail page --}}
            {{-- TODO Day 5: pass $task from the controller and display its fields --}}
            {{-- TODO Day 6: list nested $task->comments --}}
            {{-- TODO Day 11: if $task->attachment_path exists, show a download link --}}

            <div class="container mx-auto py-8 px-4">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">{{ $task->title }}</h1>
                <p class="text-gray-600 mt-2">Project: <a href="{{ route('projects.show', $task->project_id) }}" class="text-blue-600 hover:text-blue-800">{{ $task->project->name }}</a></p>
            </div>
            <div class="flex gap-2">
                @can('update', $task)
                <a href="{{ route('projects.tasks.edit', [$task->project_id, $task->id]) }}" 
                   class="px-4 py-2 bg-yellow-600 text-Black rounded-lg font-semibold hover:bg-yellow-700 transition-colors">
                    Edit
                </a>
                @endcan
                @can('delete', $task)
                <form action="{{ route('projects.tasks.destroy', [$task->project_id, $task->id]) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-Black rounded-lg font-semibold hover:bg-red-700 transition-colors"
                            onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
                @endcan
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Main content --}}
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Details</h2>

                    <div class="space-y-6">
                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Status</label>
                            <span class="px-4 py-2 rounded-full font-semibold inline-block
                                @if($task->status == 'todo') bg-gray-200 text-gray-800
                                @elseif($task->status == 'in_progress') bg-yellow-200 text-yellow-800
                                @else bg-green-200 text-green-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>

                        {{-- Description --}}
                        @if($task->description)
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Description</label>
                                <p class="text-gray-800">{{ $task->description }}</p>
                            </div>
                        @endif

                        {{-- Due Date --}}
                        @if($task->due_date)
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Due Date</label>
                                <p class="text-gray-800">{{ $task->due_date->format('F d, Y') }}</p>
                            </div>
                        @endif

                        {{-- Assigned To --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Assigned To</label>
                            @if($task->assignee)
                                <p class="text-gray-800">{{ $task->assignee->name }} ({{ $task->assignee->email }})</p>
                            @else
                                <p class="text-gray-500">Unassigned</p>
                            @endif
                        </div>

                        {{-- Created/Updated Info --}}
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                Created: {{ $task->created_at->format('F d, Y \a\t g:i A') }}
                            </p>
                            @if($task->updated_at->ne($task->created_at))
                                <p class="text-sm text-gray-600">
                                    Last updated: {{ $task->updated_at->format('F d, Y \a\t g:i A') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Comments Section --}}
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Comments ({{ $task->comments->count() }})</h2>

                    @if($task->comments->count() > 0)
                        <div class="space-y-4">
                            @foreach($task->comments as $comment)
                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $comment->created_at->format('F d, Y \a\t g:i A') }}</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-800 mt-2">{{ $comment->body }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No comments yet.</p>
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <div>
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Info</h3>
                    
                    <div class="space-y-4 text-sm">
                        <div>
                            <p class="font-semibold text-gray-600">Created By</p>
                            <p class="text-gray-800">{{ $task->project->owner->name }}</p>
                        </div>

                        @if($task->due_date)
                            <div>
                                <p class="font-semibold text-gray-600">Days Until Due</p>
                                <p class="text-gray-800">
                                    @if($task->due_date->isPast()) 
                                        <span class="text-red-600">{{ $task->due_date->diffInDays() }} days overdue</span>
                                    @elseif($task->due_date->isToday())
                                        <span class="text-red-600">Today</span>
                                    @else
                                        {{ $task->due_date->diffInDays() }} days
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('projects.tasks.index', $task->project_id) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                            ← Back to Tasks
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>