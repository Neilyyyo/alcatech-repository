<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tenant;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('tenant')->get();  // Eager load the tenant data
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $tenants = Tenant::all();  // Get all tenants for the payment form
        return view('payments.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_ID' => 'required|exists:tenants,id',
            'amount' => 'required|numeric',
            'mod_of_payment' => 'required|string',
            'invoice' => 'required|string',
        ]);

        Payment::create($request->all());
        return redirect()->route('payments.index')->with('success', 'Payment added successfully!');
    }

    public function edit(Payment $payment)
    {
        $tenants = Tenant::all();  // Get all tenants for editing the payment
        return view('payments.edit', compact('payment', 'tenants'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'tenant_ID' => 'required|exists:tenants,id',
            'amount' => 'required|numeric',
            'mod_of_payment' => 'required|string',
            'invoice' => 'required|string',
        ]);

        $payment->update($request->all());
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    }

    public function printReceipt(Payment $payment)
    {
        // Generate and print the receipt (you can customize this method)
        return view('payments.receipt', compact('payment'));
    }
}
