<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Mail\TenantBalanceMail;
use Illuminate\Support\Facades\Mail;
use Exception;

class EmailController extends Controller
{
    public function sendTenantBalanceEmail($tenantId)
    {
        $tenant = Tenant::find($tenantId);

        // Check if tenant exists
        if (!$tenant) {
            return back()->with('error', 'Tenant not found.');
        }

        // Ensure tenant has an email
        if (!$tenant->email) {
            return back()->with('error', 'Tenant does not have an email address.');
        }

        // Calculate balance details
        $balanceDetails = [
            'rentPrice' => $tenant->room->price ?? 0,
            'totalRentDue' => $tenant->room->price * $tenant->months_due,
            'totalPaid' => $tenant->payments->sum('amount'),
            'outstandingBalance' => ($tenant->room->price * $tenant->months_due) - $tenant->payments->sum('amount')
        ];

        try {
            // Send the email
            Mail::to($tenant->email)->send(new TenantBalanceMail($tenant, $balanceDetails));

            // Return success response
            return back();
        } catch (Exception $e) {
            // Return error response if email fails to send
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
