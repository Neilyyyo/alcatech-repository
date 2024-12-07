<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Models\Payment;
use App\Models\Tenant;
use App\Models\Room;
use App\Http\Controllers\EmailController;

Route::get('send-tenant-balance-email/{tenantId}', [EmailController::class, 'sendTenantBalanceEmail'])->name('sendTenantBalanceEmail');

Route::get('tenants/{tenantId}/balance', [PaymentController::class, 'showBalance'])->name('tenants.balance');



Route::get('/dashboard', function () {
    // Calculate total payments for the current month
    $totalPaymentsMonthly = Payment::whereMonth('date_of_payment', now()->month)
        ->whereYear('date_of_payment', now()->year)
        ->sum('amount');

    // Count the total number of tenants
    $totalTenants = Tenant::count();

    // Count the total number of rooms
    $totalRooms = Room::count();

    // Get room names and their respective tenant counts
    $rooms = Room::withCount('tenants')->get();
    $roomNames = $rooms->pluck('roomName'); // Adjust this if the column is named differently
    $tenantCounts = $rooms->pluck('tenants_count'); // Tenant count for each room

    // Get total payments by month for the current year
    $paymentsByMonth = Payment::selectRaw('SUM(amount) as total, MONTH(date_of_payment) as month')
        ->whereYear('date_of_payment', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Prepare data for the monthly payments chart
    $months = [];
    $totalPaymentsPerMonth = [];
    foreach ($paymentsByMonth as $payment) {
        $months[] = Carbon\Carbon::createFromFormat('m', $payment->month)->format('F'); // Convert month number to month name
        $totalPaymentsPerMonth[] = $payment->total; // Total payment for each month
    }

    // Return the view with all necessary data, including the new chart data
    return view('dashboard', compact('totalPaymentsMonthly', 'totalTenants', 'totalRooms', 'roomNames', 'tenantCounts', 'months', 'totalPaymentsPerMonth'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('payments', PaymentController::class);
Route::get('payments/{payment}/receipt', [PaymentController::class, 'printReceipt'])->name('payments.receipt');
Route::resource('tenants', TenantController::class);
Route::resource('rooms', RoomController::class);
Route::resource('houses', HouseController::class);

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
