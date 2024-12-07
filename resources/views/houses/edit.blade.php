@extends('layout')

@section('content')
<div class="min-h-screen bg-purple-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-black">Edit House</h1>
            <a href="{{ route('houses.index') }}" class="text-purple-600 hover:text-purple-800 text-sm">
                Back
            </a>
        </div>

        <!-- Edit House Form -->
        <form action="{{ route('houses.update', $house->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- House Name -->
            <div class="mb-4">
                <label for="houseName" class="block text-sm font-medium text-black">House Name:</label>
                <input type="text" name="houseName" value="{{ old('houseName', $house->houseName) }}" required
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300">
            </div>

            <!-- House Image -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-black">House Image:</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300" accept="image/*">
            </div>

            <!-- Display Existing Image if available -->
            @if($house->image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-black">Current Image:</label>
                    <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="w-32 h-32 object-cover rounded-lg shadow-md">
                </div>
            @endif

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 focus:outline-none transition-all duration-300">
                    Update House
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
