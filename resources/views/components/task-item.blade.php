{{-- Day 3: Blade component for task item --}}
{{-- Accepts: task (array) - Task data including id, title, status --}}
{{-- Accepts: projectId (int) - Parent project ID for routing --}}
@props(['task', 'projectId'])

<div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
    {{-- Task header: title, ID and status badge --}}
    <div class="flex justify-between items-start gap-3">
        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-900">{{ $task['title'] }}</h3>
            <p class="text-xs text-gray-500 mt-1">ID: {{ $task['id'] }}</p>
        </div>
        <x-status-badge :status="$task['status']" />
    </div>
    
    {{-- View task link --}}
    <a href="{{ route('projects.tasks.show', [$projectId, $task['id']]) }}" 
       class="inline-flex items-center text-blue-600 text-sm font-semibold hover:text-blue-800 transition-colors mt-3">
        View Task <span class="ml-1">→</span>
    </a>
</div>
