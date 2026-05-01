{{-- Day 3: Blade component for status badges --}}
{{-- Accepts: status (string) - The status value to display --}}
@props(['status'])

@if($status === 'active')
    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded font-semibold">Active</span>
@elseif($status === 'completed')
    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded font-semibold">Completed</span>
@elseif($status === 'in_progress')
    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded font-semibold">In Progress</span>
@else
    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded font-semibold">{{ ucfirst($status) }}</span>
@endif
