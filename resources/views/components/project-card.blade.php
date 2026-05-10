{{-- Day 3: Blade component for project card --}}
{{-- Accepts: project (array or object) - Project data including id, name, description, status, tasks_count --}}
@props(['project'])

<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
    {{-- Project header: title and status badge --}}
    <div class="flex justify-between items-start mb-3">
        <h2 class="text-xl font-bold text-gray-900">{{ $project->name }}</h2>
        <x-status-badge :status="$project->status" />
    </div>

    {{-- Project description --}}
    <p class="text-gray-700 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>

    {{-- Tasks count indicator --}}
    <div class="flex items-center justify-between mb-4">
        <span class="text-sm text-gray-600">
            <span class="font-semibold text-gray-900">{{ $project->tasks->count() }}</span> tasks
        </span>
    </div>

    {{-- View details and action buttons --}}
    <div class="flex flex-col md:flex-row gap-3 items-start md:items-center justify-between">
        <a href="{{ route('projects.show', $project->id) }}" 
           class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition-colors">
            View Details <span class="ml-1">→</span>
        </a>
        <div class="flex gap-2">
            @can('update', $project)
            <a href="{{ route('projects.edit', $project->id) }}" 
               class="px-3 py-1 bg-yellow-500 text-white text-sm rounded font-semibold hover:bg-yellow-600 transition-colors">
                Edit
            </a>
            @endcan
            @can('delete', $project)
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded font-semibold hover:bg-red-600 transition-colors">
                    Delete
                </button>
            </form>
            @endcan
        </div>
    </div>
</div>
