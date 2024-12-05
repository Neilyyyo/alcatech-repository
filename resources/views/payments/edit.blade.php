@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-orange-600">Edit Payment</h1>
        <a href="{{ route('payments.index') }}" class="text-orange-600 hover:text-orange-700 text-sm">
            Back to Payments
        </a>
    </div>

    <!-- Edit Payment Form -->
    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tenant -->
        <div class="mb-4">
            <label for="tenant_ID" class="block text-sm font-medium text-gray-700">Tenant:</label>
            <select name="tenant_ID" id="tenant_ID" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
                @foreach($tenants as $tenant)
                <option value="{{ $tenant->id }}" data-room-price="{{ $tenant->room->price }}" 
                    {{ $tenant->id == $payment->tenant_ID ? 'selected' : '' }}>
                    {{ $tenant->firstName }} {{ $tenant->lastName }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Amount -->
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount:</label>
            <input type="number" name="amount" id="amount" step="0.01" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" value="{{ $payment->amount }}" readonly>
        </div>

        <!-- Mode of Payment -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Mode of Payment:</label>
            <div class="flex items-center space-x-4">
                <label>
                    <input type="radio" name="mod_of_payment" value="cash" class="mr-2" {{ $payment->mod_of_payment == 'cash' ? 'checked' : '' }}> Cash
                </label>
                <label>
                    <input type="radio" name="mod_of_payment" value="gcash" class="mr-2" {{ $payment->mod_of_payment == 'gcash' ? 'checked' : '' }}> GCash
                </label>
            </div>
        </div>

        <!-- Invoice Number -->
        <div class="mb-4">
            <label for="invoice" class="block text-sm font-medium text-gray-700">Invoice Number:</label>
            <input type="text" name="invoice" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500" value="{{ $payment->invoice }}" required>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 focus:outline-none">
                Update Payment
            </button>
        </div>
    </form>
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
