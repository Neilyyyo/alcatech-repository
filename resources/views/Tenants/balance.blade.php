@extends('layout')

@section('content')
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <!-- Header Section with Back Button -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('tenants.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700">
                &larr; Back
            </a>
            <h1 class="text-4xl font-bold text-white">Tenant Balance</h1>
        </div>

        <!-- Tenant Balance Section -->
        <div class="bg-white p-8 rounded-lg shadow-lg relative border-2 border-purple-600">
            <h2 class="text-3xl font-semibold text-black">{{ $tenant->firstName }} {{ $tenant->lastName }}</h2>
            <p class="text-black mt-2">Room: <span class="font-medium">{{ $tenant->room->roomName ?? 'N/A' }}</span></p>
            <p class="text-black">Date In: <span class="font-medium">{{ $tenant->date_in->format('F j, Y') }}</span></p>

            <!-- Payment Summary Section -->
            <div class="mt-4 bg-white border-2 border-purple-600 p-6 rounded-lg">
                <h3 class="text-xl font-semibold text-white">Payment Summary</h3>
                <div class="">
                    <p class="text-black"><strong>Rent Price per Month:</strong> {{ number_format($tenant->room->price, 0) }}</p>
                    <p class="text-black"><strong>Months Due:</strong> {{ number_format($monthsDue, 0) }}</p>
                    <p class="text-black"><strong>Total Rent Due:</strong> {{ number_format($totalRentDue, 0) }}</p>
                    <p class="text-black"><strong>Total Paid:</strong> {{ number_format($totalPaid, 0) }}</p>
                    <p class="text-black"><strong>Outstanding Balance:</strong> {{ number_format($outstandingBalance, 0) }}</p>
                </div>
            </div>

            <!-- Action Buttons Section (Positioned to the lower right) -->
            <div class="absolute bottom-10 right-10 flex space-x-3">
                <!-- Edit Button -->
                <a href="{{ route('tenants.edit', $tenant->id) }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700 transition">
                    Edit
                </a>

                <!-- Delete Button -->
                <button onclick="openDeleteModal({{ $tenant->id }})" 
                        class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
                    Delete
                </button>

                <!-- Send Email Button -->
                <a href="{{ route('sendTenantBalanceEmail', $tenant->id) }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                    Send Email
                </a>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Tenant -->
    <div id="deleteModal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold">Are you sure you want to delete this tenant?</h2>
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

    <script>
        // Open Modal Function (Delete)
        function openDeleteModal(tenantId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = '/tenants/' + tenantId;
        }

        // Close Modal Function
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
@endsection
