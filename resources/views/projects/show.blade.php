<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- TODO Day 3: build the project detail page --}}
            {{-- TODO Day 5: pass $project from the controller and display its fields --}}
            {{-- TODO Day 6: list nested $project->tasks with their $task->comments --}}

            <div class="container mx-auto py-8 px-4">
        {{-- Back button --}}
        <div class="mb-6">
            <a href="{{ route('projects.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                <span class="mr-1">←</span> Back to Projects
            </a>
        </div>

        {{-- Project main card --}}
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            {{-- Project header with title and action buttons --}}
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-8 pb-8 border-b border-gray-200">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">{{ $project->name }}</h1>
                    <p class="text-gray-600 text-sm mt-2">Project ID: <span class="font-semibold">{{ $project->id }}</span></p>
                </div>
                
                {{-- Edit and Delete action buttons --}}
                <div class="flex gap-3">
                    <a href="{{ route('projects.edit', $project->id) }}" 
                       class="bg-yellow-600 text-Black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-700 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-Black px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            {{-- Project info cards: Status, Owner, Created Date --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Status card --}}
                <div class="bg-gray-50 p-5 rounded-lg">
                    <h3 class="text-xs font-bold text-gray-600 uppercase tracking-wide">Status</h3>
                    <div class="mt-3">
                        <x-status-badge :status="$project->status" />
                    </div>
                </div>

                {{-- Owner card --}}
                <div class="bg-gray-50 p-5 rounded-lg">
                    <h3 class="text-xs font-bold text-gray-600 uppercase tracking-wide">Project Owner</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-3">{{ $project->user->name ?? 'Unassigned' }}</p>
                </div>

                {{-- Created date card --}}
                <div class="bg-gray-50 p-5 rounded-lg">
                    <h3 class="text-xs font-bold text-gray-600 uppercase tracking-wide">Created On</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-3">{{ $project->created_at->format('M d, Y') }}</p>
                </div>
                
            </div>

            {{-- Full project description --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
                <p class="text-gray-700 leading-relaxed text-base">{{ $project->description ?? 'No description provided' }}</p>
            </div>
        </div>

        {{-- Tasks section --}}
        <div class="bg-white rounded-lg shadow-md p-8">
            {{-- Tasks header with add button --}}
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6 pb-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Tasks</h2>
                <a href="{{ route('projects.tasks.create', $project->id) }}" 
                   class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    <span class="mr-2">+</span> Add Task
                </a>
            </div>

            {{-- Day 3: Using @foreach with Blade component <x-task-item /> --}}
            {{-- Display tasks from the relationship --}}
            @if ($project->tasks->count() > 0)
                <div class="space-y-4">
                    @foreach ($project->tasks as $task)
                        <x-task-item :task="$task->toArray()" :projectId="$project->id" />
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 py-12 text-center text-lg">
                    No tasks yet. <a href="{{ route('projects.tasks.create', $project->id) }}" class="text-blue-600 font-semibold hover:underline">Create one to get started!</a>
                </p>
            @endif
        </div>
        </div>
    </div>
</x-app-layout>
