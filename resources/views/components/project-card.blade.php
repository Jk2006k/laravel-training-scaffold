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
            <span class="font-semibold text-gray-900">0</span> tasks
        </span>
    </div>

    {{-- View details link --}}
    <a href="{{ route('projects.show', $project->id) }}" 
       class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition-colors">
        View Details <span class="ml-1">→</span>
    </a>
</div>
