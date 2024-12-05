
@extends('layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-600 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-orange-600">Payments</h1>
                <a href="{{ route('payments.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-700">
                    Add New Payment
                </a>
            </div>

            <!-- Payments Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="bg-orange-500 text-white">
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
                    <tbody>
                        @foreach($payments as $payment)
                            <tr class="border-b hover:bg-orange-100">
                                <td class="px-4 py-2 text-gray-800">{{ $payment->id }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $payment->tenant->firstName }} {{ $payment->tenant->lastName }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $payment->amount }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $payment->mod_of_payment }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $payment->invoice }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $payment->date_of_payment }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('payments.edit', $payment->id) }}" 
                                           class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" 
                                                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>

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
</x-app-layout>
@endsection
