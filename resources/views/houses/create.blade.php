@extends('layout')

@section('content')
<div class="min-h-screen bg-purple-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-black">Add New House</h1>
            <a href="{{ route('houses.index') }}" class="text-purple-600 hover:text-purple-800 text-sm">
                Back
            </a>
        </div>

        <!-- Success Message Section -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New House Form -->
        <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- House Name -->
            <div class="mb-4">
                <label for="houseName" class="block text-sm font-medium text-black">House Name:</label>
                <input type="text" name="houseName" required
                    class="mt-2 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300">
            </div>

            <!-- House Image -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-black">House Image:</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full px-4 py-2 border border-purple-300 rounded-lg text-purple-900 bg-white focus:ring-purple-500 focus:border-purple-500 hover:border-purple-400 transition-all duration-300" accept="image/*">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 focus:outline-none transition-all duration-300">
                    Add House
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
