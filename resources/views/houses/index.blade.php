@extends('layout')

@section('content')
    <x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-purple">Houses</h1>
                <!-- Add New House Button -->
                <a href="{{ route('houses.create') }}" 
                   class="bg-purple-600 text-white px-5 py-2 rounded-lg shadow hover:bg-purple-500 transition">
                    Add New House
                </a>
            </div>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($houses as $house)
                    <div class="card border border-purple-600 rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-2xl transition-all duration-300 ease-in-out">
                        <!-- House Name in Header -->
                        <div class="card-header bg-white text-black px-4 py-3">
                            <h5 class="text-lg font-semibold">{{ $house->houseName }}</h5>
                        </div>
                        <div class="card-body p-4 bg-white border-purple">
                            <!-- House Image -->
                            <div class="h-48 mb-4">
                                <img class="w-full h-full object-fill rounded-lg" 
                                     src="{{ $house->image ? asset('storage/' . $house->image) : 'https://via.placeholder.com/300' }}" 
                                     alt="House Image">
                            </div>

                            <div class="flex justify-end items-center space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('houses.edit', $house->id) }}" 
                                   class="bg-gray-700 text-white px-3 py-2 rounded-md shadow hover:bg-gray-800 transition">
                                    Edit
                                </a>
                                <!-- Delete Button (Triggers Modal) -->
                                <button onclick="openDeleteModal({{ $house->id }})" 
                                        class="bg-red-600 text-white px-3 py-2 rounded-md shadow hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Houses Found -->
            @if($houses->isEmpty())
                <p class="text-center text-gray-500 mt-8">No houses found.</p>
            @endif
        </div>
    </div>

    <!-- Modal for Delete House -->
    <div id="deleteModal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold">Are you sure you want to delete this house?</h2>
            <div class="mt-4 flex justify-end space-x-4">
                <button onclick="closeModal()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Cancel</button>
                <form id="deleteForm" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>

    </x-app-layout>

    <script>
        // Open Modal Function (Delete)
        function openDeleteModal(houseId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = '/houses/' + houseId;
        }

        // Close Modal Function
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection
