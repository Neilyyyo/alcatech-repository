@extends('layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-600 leading-tight">
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-orange-600">Rooms</h1>
                <a href="{{ route('rooms.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-700">
                    Add New Room
                </a>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full bg-white border border-gray-200 table-auto text-left">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-6 py-3">House Name</th>
                            <th class="px-6 py-3">Room Name</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Max Tenants</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr class="border-b hover:bg-orange-100">
                                <td class="px-6 py-4 text-gray-800">{{ $room->house->houseName ?? 'No House' }}</td> <!-- Display House Name -->
                                <td class="px-6 py-4 text-gray-800">{{ $room->roomName }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $room->description }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $room->price }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $room->max_tenants }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('rooms.edit', $room->id) }}" 
                                           class="bg-orange-400 text-white px-3 py-1 rounded-lg hover:bg-orange-500">
                                            Edit
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline-block">
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

            <!-- No Rooms Found -->
            @if($rooms->isEmpty())
                <p class="text-center text-gray-500 mt-6">No rooms found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
@endsection
