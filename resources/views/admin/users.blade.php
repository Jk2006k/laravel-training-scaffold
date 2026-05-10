<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin - Users Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-6">All Users</h1>
                    
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr class="hover:bg-gray-50">
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                    @if($user->role === 'admin') bg-red-200 text-red-800
                                                    @elseif($user->role === 'manager') bg-blue-200 text-blue-800
                                                    @else bg-gray-200 text-gray-800
                                                    @endif">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
