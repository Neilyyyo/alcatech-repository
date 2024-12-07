<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Payment;
use App\Models\Tenant;  // Add this to get tenant data
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Calculate the total sum of all payments for the current month
        $totalPaymentsMonthly = Payment::whereMonth('date_of_payment', Carbon::now()->month)->sum('amount');
    
        // Calculate the total number of tenants
        $totalTenants = Tenant::count();
    
        // Calculate the total number of rooms
        $totalRooms = Room::count();
    
        // Get room names and their respective tenant counts
        $rooms = Room::withCount('tenants')->get();
        $roomNames = $rooms->pluck('roomName'); // Ensure you're using the correct column name
        $tenantCounts = $rooms->pluck('tenants_count'); // This will contain the tenant counts
    
        // Get total payments by month for the last 6 months (or more depending on your requirement)
        $paymentsByMonth = Payment::selectRaw('SUM(amount) as total, MONTH(date_of_payment) as month')
            ->whereYear('date_of_payment', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        // Prepare data for the chart
        $months = [];
        $totalPaymentsPerMonth = [];
        foreach ($paymentsByMonth as $payment) {
            $months[] = Carbon::createFromFormat('m', $payment->month)->format('F'); // Month name
            $totalPaymentsPerMonth[] = $payment->total; // Total payment for the month
        }
    
        // Return data to the view
        return view('dashboard', compact('totalPaymentsMonthly', 'totalTenants', 'totalRooms', 'roomNames', 'tenantCounts', 'months', 'totalPaymentsPerMonth'));
    }
    

}
