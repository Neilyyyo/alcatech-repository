@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
    <!-- Header Section (Hidden in Print) -->
    <div class="text-center mb-8" id="header">
        <h1 class="text-4xl font-bold text-gray-600">Payment Receipt</h1>
        <p class="text-xl text-gray-600">Thank you for your payment!</p>
    </div>

    <!-- Payment Receipt Content -->
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border receipt-content">
        <div class="mb-6">
            <p><strong>Tenant:</strong> {{ $payment->tenant->firstName }} {{ $payment->tenant->lastName }}</p>
            <p><strong>Amount:</strong> ₱{{ number_format($payment->amount, 2) }}</p>
            <p><strong>Mode of Payment:</strong> {{ ucfirst($payment->mod_of_payment) }}</p>
            <p><strong>Invoice:</strong> {{ $payment->invoice }}</p>
            <p><strong>Date of Payment:</strong> {{ \Carbon\Carbon::parse($payment->date_of_payment)->format('F j, Y') }}</p>
        </div>

        <!-- Footer Section (Hidden in Print) -->
        <div class="mt-6 text-center" id="footer">
            <p class="text-gray-500 text-sm">This is a receipt for the payment made for your room rental. Thank you for choosing us!</p>
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex justify-center mt-6 space-x-4">
    <!-- Back Button -->
    <a href="{{ route('payments.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
        Back to Payments
    </a>

    <!-- Print Button -->
    <button onclick="window.print()" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
        Print Receipt
    </button>
</div>

    <!-- Print Button (Hidden in Print) -->
    <div class="flex justify-center mt-6" id="print-button">
        
    </div>
</div>

@endsection

@section('styles')
<style>
    @media print {
        /* Hide non-relevant parts during printing */
        #header, #footer, #print-button {
            display: none;
        }

        /* Make the receipt content visible and ready for print */
        .receipt-content {
            visibility: visible;
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
        }

        /* Optional: Adjust the font size for printing */
        .receipt-content p {
            font-size: 16px;
        }
    }
</style>
@endsection
