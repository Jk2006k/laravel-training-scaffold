@extends('layouts.app')

@section('content')
    {{-- TODO Day 3: build the edit-project form layout --}}
    {{-- TODO Day 5: pre-fill fields with $project values --}}
    {{-- TODO Day 7: add @error directives --}}

    <div class="container mx-auto py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold mb-8">Edit Project</h1>

            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Project Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter project name">
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Enter project description">{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="status" class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                        <select id="status" name="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select status</option>
                            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Update Project
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