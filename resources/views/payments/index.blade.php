@extends('layout')

@section('content')
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-4xl font-bold text-black">Payments</h1>
                <input type="text" id="search" name="search" placeholder="Search by tenant's name"
                    class="px-4 py-2 border border-purple-600 rounded-lg focus:ring-purple-600 focus:border-purple-600 w-1/2 bg-white text-black"
                    value="{{ request()->get('search') }}">

                <a href="{{ route('payments.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-500">
                    Add New Payment
                </a>
            </div>

            <!-- Payments Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="table-auto w-full text-left border border-purple-600">
                    <thead class="bg-purple-500 text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Tenant</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Mode of Payment</th>
                            <th class="px-4 py-2">Invoice</th>
                            <th class="px-4 py-2">Date of Payment</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="payments-list">
                        @foreach($payments as $payment)
                        <tr class="border-b border-purple-600 hover:bg-purple-100 payment-row">
                            <td class="px-4 py-2 text-black">{{ $payment->id }}</td>  
                            <td class="px-4 py-2 text-black">{{ $payment->tenant->firstName }} {{ $payment->tenant->lastName }}</td>
                            <td class="px-4 py-2 text-black">{{ number_format($payment->amount, 2) }}</td>
                            <td class="px-4 py-2 text-black">{{ $payment->mod_of_payment }}</td>      
                            <td class="px-4 py-2 text-black">{{ $payment->invoice }}</td>
                            <td class="px-4 py-2 text-black">{{ \Carbon\Carbon::parse($payment->date_of_payment)->format('F j, Y') }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('payments.edit', $payment->id) }}"
                                        class="bg-gray-600 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <button onclick="openDeleteModal({{ $payment->id }})"
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                        Delete
                                    </button>

                                    <!-- Print Receipt Button -->
                                    <a href="{{ route('payments.receipt', $payment->id) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600">
                                        Print Receipt
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- No Payments Found -->
            @if($payments->isEmpty())
            <p class="text-center text-gray-500 mt-6">No payments found.</p>
            @endif
        </div>
    </div>

    <!-- Modal for Delete Payment -->
    <div id="deleteModal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold">Are you sure you want to delete this payment?</h2>
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
        function openDeleteModal(paymentId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = '/payments/' + paymentId;
        }

        // Close Modal Function
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // JavaScript for real-time search filtering
        document.getElementById('search').addEventListener('input', function() {
            let searchQuery = this.value.toLowerCase();
            let paymentRows = document.querySelectorAll('.payment-row');

            paymentRows.forEach(row => {
                // Get the tenant's full name from the row (first column)
                let tenantName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                let tenantFirstName = tenantName.split(' ')[0]; // Get the first name

                if (tenantFirstName.startsWith(searchQuery)) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        });
    </script>
</x-app-layout>
@endsection
