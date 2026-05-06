@extends('layouts.app')

@section('content')
    {{-- TODO Day 3: build the new-task form layout --}}
    {{-- TODO Day 5: wire POST action and old() helper for repopulation --}}
    {{-- TODO Day 7: add @error directives to display validation errors --}}
    {{-- TODO Day 11: add file upload input (enctype="multipart/form-data") --}}

    <div class="container mx-auto py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold mb-8">Create New Task</h1>

            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">Task Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                               class="w-full px-4 py-2 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter task title">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full px-4 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Enter task description">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="status" class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                        <select id="status" name="status" required
                                class="w-full px-4 py-2 border @error('status') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select status</option>
                            <option value="todo" {{ old('status') == 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="due_date" class="block text-sm font-semibold text-gray-900 mb-2">Due Date</label>
                        <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
                               class="w-full px-4 py-2 border @error('due_date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('due_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="assigned_to_id" class="block text-sm font-semibold text-gray-900 mb-2">Assign To</label>
                        <select id="assigned_to_id" name="assigned_to_id"
                                class="w-full px-4 py-2 border @error('assigned_to_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select user (optional)</option>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('assigned_to_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Create Task
                        </button>
                        <a href="{{ route('projects.show', $project->id) }}" class="bg-gray-300 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-gray-400 transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection