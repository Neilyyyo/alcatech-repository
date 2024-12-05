@extends('layout')

@section('content')
<div class="min-h-screen bg-orange-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600">Add New Payment</h1>
            <a href="{{ route('payments.index') }}" class="text-orange-600 hover:text-orange-700 text-sm">
                Back
            </a>
        </div>

        <!-- Add New Payment Form -->
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <!-- Tenant Selection -->
            <div class="mb-4">
                <label for="tenant_ID" class="block text-sm font-medium text-gray-700">Tenant:</label>
                <select name="tenant_ID" id="tenant_ID" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
                    <option value="">Select Tenant</option>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}" data-room-price="{{ $tenant->room->price }}">
                            {{ $tenant->firstName }} {{ $tenant->lastName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount:</label>
                <input type="number" name="amount" id="amount" step="0.01" required readonly
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Mode of Payment -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Mode of Payment:</label>
                <div class="flex items-center space-x-4">
                    <label>
                        <input type="radio" name="mod_of_payment" value="cash" required class="mr-2">
                        Cash
                    </label>
                    <label>
                        <input type="radio" name="mod_of_payment" value="gcash" required class="mr-2">
                        GCash
                    </label>
                </div>
            </div>

            <!-- Invoice Number -->
            <div class="mb-4">
                <label for="invoice" class="block text-sm font-medium text-gray-700">Invoice Number:</label>
                <input type="text" name="invoice" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 focus:outline-none">
                    Add Payment
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Event listener to update the amount based on the selected tenant's room price
    document.getElementById('tenant_ID').addEventListener('change', function() {
        // Get selected tenant's room price
        var selectedOption = this.options[this.selectedIndex];
        var roomPrice = selectedOption.getAttribute('data-room-price');

        // Set the amount input field to the room price
        document.getElementById('amount').value = roomPrice;
    });
</script>
@endsection