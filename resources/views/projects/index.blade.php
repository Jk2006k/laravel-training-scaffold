@extends('layouts.app')

@section('content')
    {{-- TODO Day 3: build the projects list page --}}
    {{-- Should display all projects in a Tailwind grid; each card links to the show page --}}
    {{-- TODO Day 5: replace hardcoded data with real DB data passed from the controller --}}
    {{-- TODO Day 9: use @can('update', $project) to conditionally show edit/delete buttons --}}

    <div class="container mx-auto py-8 px-4">
        {{-- Page header with title and create button --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Projects</h1>
            <a href="{{ route('projects.create') }}" 
               class="inline-flex items-center bg-blue-600 text-Black px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                <span class="mr-2">+</span> New Project
            </a>
        </div>

        {{-- Day 3: Hardcoded dummy data using @foreach and Blade components --}}
        {{-- Grid layout: responsive (1 col on mobile, 2 on tablet, 3 on desktop) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- TODO Day 5: replace hardcoded data with real DB data passed from the controller --}}
            @foreach($projects as $project)
                {{-- Day 3: Using Blade component <x-project-card /> --}}
                <x-project-card :project="$project" />
            @endforeach
        </div>
    </div>
@endsection
