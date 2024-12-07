<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $payments = Payment::when($search, function ($query, $search) {
            return $query->whereHas('tenant', function ($query) use ($search) {
                $query->where('firstName', 'like', $search . '%');
            });
        })->get();
    
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


    // In the method where you're passing data to the view:
    public function showBalance($tenantId)
    {
        $tenant = Tenant::findOrFail($tenantId);
        $currentDate = Carbon::now();
    
        // Get the move-in date and due day
        $moveInDate = Carbon::parse($tenant->date_in);
        $dueDay = $moveInDate->day; // Due day of the month (e.g., 2nd)
        
        // Initialize months due
        $monthsDue = 0;
    
        // Loop through months from move-in date until current date
        $currentMonth = $moveInDate->copy();
        while ($currentMonth->lessThanOrEqualTo($currentDate)) {
            if ($currentMonth->day <= $dueDay && $currentMonth->copy()->endOfMonth()->day >= $dueDay) {
                $monthsDue++;
            }
            $currentMonth->addMonth(); // Move to the next month
        }
    
        // Calculate total rent due based on full months passed
        $rentPrice = $tenant->room->price;
        $totalRentDue = $monthsDue * $rentPrice;
    
        // Calculate total payments made
        $totalPaid = $tenant->payments->sum('amount'); // Sum all payments
    
        // Calculate outstanding balance
        $outstandingBalance = $totalRentDue - $totalPaid;
    
        // Pass this data to the view
        return view('tenants.balance', compact('tenant', 'monthsDue', 'totalRentDue', 'totalPaid', 'outstandingBalance'));
    }
    
}
