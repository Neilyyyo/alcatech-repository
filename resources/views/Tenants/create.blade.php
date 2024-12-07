@extends('layout')

@section('content')
<div class="min-h-screen bg-purple-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-purple-300">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-black">Add New Tenant</h1>
            <a href="{{ route('tenants.index') }}" class="text-purple-600 hover:text-purple-800 text-sm">
                Back
            </a>
        </div>

        <!-- Display error message if room reaches max tenants -->
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-800 p-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Add New Tenant Form -->
        <form action="{{ route('tenants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- First Name -->
            <div class="mb-4">
                <label for="firstName" class="block text-sm font-medium text-black">First Name:</label>
                <input type="text" name="firstName" value="{{ old('firstName') }}" required
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300" />
                @error('firstName')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <label for="lastName" class="block text-sm font-medium text-black">Last Name:</label>
                <input type="text" name="lastName" value="{{ old('lastName') }}" required
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300" />
                @error('lastName')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-black">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300" />
                @error('email')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Room -->
            <div class="mb-4">
                <label for="room_ID" class="block text-sm font-medium text-black">Room:</label>
                <select name="room_ID" required
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_ID') == $room->id ? 'selected' : '' }}>{{ $room->roomName }}</option>
                    @endforeach
                </select>
                @error('room_ID')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date In -->
            <div class="mb-4">
                <label for="date_in" class="block text-sm font-medium text-black">Date In:</label>
                <input type="date" name="date_in" value="{{ old('date_in') }}" required
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300" />
                @error('date_in')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-black">Upload Image (optional):</label>
                <input type="file" name="image" accept="image/*"
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300" />
                @error('image')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 focus:outline-none transition-all duration-300">
                    Add Tenant
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
