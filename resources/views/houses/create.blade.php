@extends('layout')

@section('content')
<div class="min-h-screen bg-orange-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Add New House</h1>
            <a href="{{ route('houses.index') }}" class="text-orange-600 hover:text-orange-700 text-sm">
                Back
            </a>
        </div>

        <!-- Add New House Form -->
        <form action="{{ route('houses.store') }}" method="POST">
            @csrf

            <!-- House Name -->
            <div class="mb-4">
                <label for="houseName" class="block text-sm font-medium text-gray-700">House Name:</label>
                <input type="text" name="houseName" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 focus:outline-none">
                    Add House
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
