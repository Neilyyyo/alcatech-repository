<!-- resources/views/tenants/create.blade.php -->

@extends('layout')

@section('content')
<div class="min-h-screen bg-orange-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Add New Tenant</h1>
            <a href="{{ route('tenants.index') }}" class="text-orange-600 hover:text-orange-700 text-sm">
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
        <form action="{{ route('tenants.store') }}" method="POST">
            @csrf

            <!-- First Name -->
            <div class="mb-4">
                <label for="firstName" class="block text-sm font-medium text-gray-700">First Name:</label>
                <input type="text" name="firstName" value="{{ old('firstName') }}" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" />
                @error('firstName')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name:</label>
                <input type="text" name="lastName" value="{{ old('lastName') }}" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" />
                @error('lastName')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" />
                @error('email')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Room -->
            <div class="mb-4">
                <label for="room_ID" class="block text-sm font-medium text-gray-700">Room:</label>
                <select name="room_ID" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
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
                <label for="date_in" class="block text-sm font-medium text-gray-700">Date In:</label>
                <input type="date" name="date_in" value="{{ old('date_in') }}" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" />
                @error('date_in')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Guardian Name -->
            <div class="mb-4">
                <label for="guardian_name" class="block text-sm font-medium text-gray-700">Guardian Name and Contact No. (Optional):</label>
                <input type="text" name="guardian_name" value="{{ old('guardian_name') }}"
                    placeholder="e.g. Juana Dela Cruz, 09123456789"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" />
                @error('guardian_name')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>


            <!-- Guardian Contact
            <div class="mb-4">
                <label for="guardian_contact" class="block text-sm font-medium text-gray-700">Guardian Contact (Optional):</label>
                <input type="number" name="guardian_contact" value="{{ old('guardian_contact') }}" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" />
                @error('guardian_contact')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div> -->

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 focus:outline-none">
                    Add Tenant
                </button>
            </div>
        </form>
    </div>
</div>
@endsection