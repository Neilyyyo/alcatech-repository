@extends('layout')

@section('content')
<div class="min-h-screen bg-orange-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Edit Room: {{ $room->roomName }}</h1>
            <a href="{{ route('rooms.index') }}" class="text-orange-600 hover:text-orange-700 text-sm">
                Back
            </a>
        </div>

        <!-- Display error message if room reaches max tenants -->
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-800 p-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Edit Room Form -->
        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- House -->
            <div class="mb-4">
                <label for="house_id" class="block text-sm font-medium text-gray-700">Select House:</label>
                <select name="house_id" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
                    <option value="">Select a House</option>
                    @foreach($houses as $house)
                        <option value="{{ $house->id }}" {{ old('house_id', $room->house_id) == $house->id ? 'selected' : '' }}>
                            {{ $house->houseName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Room Name -->
            <div class="mb-4">
                <label for="roomName" class="block text-sm font-medium text-gray-700">Room Name:</label>
                <input type="text" name="roomName" value="{{ old('roomName', $room->roomName) }}" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="number" name="price" value="{{ old('price', $room->price) }}" required min="1" step="0.01"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" rows="4" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">{{ old('description', $room->description) }}</textarea>
            </div>

            <!-- Maximum Tenants -->
            <div class="mb-4">
                <label for="max_tenants" class="block text-sm font-medium text-gray-700">Maximum Tenants:</label>
                <input type="number" name="max_tenants" value="{{ old('max_tenants', $room->max_tenants) }}" required min="1"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 focus:outline-none">
                    Update Room
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
