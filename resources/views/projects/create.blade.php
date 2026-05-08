<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- TODO Day 3: build the new-project form layout --}}
            {{-- TODO Day 5: wire POST action and old() helper for repopulation --}}
            {{-- TODO Day 7: add @error directives to display validation errors --}}

            <div class="container mx-auto py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold mb-8">Create New Project</h1>

            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Project Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter project name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full px-4 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Enter project description">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="status" class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                        <select id="status" name="status"
                                class="w-full px-4 py-2 border @error('status') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 text-Black px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Create Project
                        </button>
                        <a href="{{ route('projects.index') }}" class="bg-gray-300 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-gray-400 transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>