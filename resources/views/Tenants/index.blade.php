@extends('layout')

@section('content')
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Tenants</h1>
            <a href="{{ route('tenants.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-700">
                Add Tenant
            </a>
        </div>

        <!-- Search Form -->
        <div class="mb-4">
            <form method="GET" action="{{ route('tenants.index') }}" class="flex space-x-4">
                <input type="text" name="search" value="{{ request()->get('search') }}" placeholder="Search by name" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 w-1/2">
                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-700">
                    Search
                </button>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="table-auto w-full text-left border-collapse">
                <thead class="bg-orange-500 text-white">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Room</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Date In</th>
                        <th class="px-4 py-2">Guardian Name and Contact #</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="px-4 py-2 text-gray-800">{{ $tenant->id }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $tenant->firstName }} {{ $tenant->lastName }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $tenant->room->roomName ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $tenant->email }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $tenant->date_in }}</td>
                            <td class="px-4 py-2 text-gray-800">{{ $tenant->guardian_name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="{{ route('tenants.edit', $tenant->id) }}" 
                                       class="bg-orange-400 text-white px-3 py-1 rounded-lg hover:bg-orange-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" 
                                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- No Tenants Found -->
        @if($tenants->isEmpty())
            <p class="text-center text-gray-500 mt-6">No tenants found.</p>
        @endif
    </div>
</x-app-layout>
@endsection
