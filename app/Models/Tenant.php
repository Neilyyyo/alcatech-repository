<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tenant extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'room_ID',
        'date_in',
        'due_date',
        'image', // Add 'image' field to fillable
    ];

    // Ensure that 'date_in' is treated as a Carbon instance
    protected $casts = [
        'date_in' => 'datetime',
    ];

    /**
     * Get the room that the tenant belongs to.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_ID');
    }

    /**
     * One-to-one relationship with Balance.
     */
    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    /**
     * One-to-many relationship with Payment.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope to filter overdue tenants based on due_date.
     * Overdue is calculated by checking if the tenant has passed the due date
     * and has not fully paid.
     */
    public function scopeOverdue($query)
    {
        return $query->where(function ($query) {
            $query->where('due_date', '<', Carbon::now()->subDays(30)) // Overdue if due_date is 30 days past
                  ->whereNull('payment_received') // No payment made yet
                  ->orWhere('payment_received', '<', $this->room->price); // Payment is less than the rent
        });
    }

    /**
     * Calculate total rent due for the tenant based on room price and the months rented.
     */
    public function calculateTotalRentDue()
    {
        $roomPrice = $this->room->price;  // Get the price of the room the tenant is renting
        $startDate = Carbon::parse($this->date_in);  // Assuming date_in is the start date
        $monthsRented = $startDate->diffInMonths(Carbon::now());

        return $roomPrice * $monthsRented;  // Total rent due is the room price * number of months rented
    }

    /**
     * Calculate the total amount paid by the tenant.
     */
    public function calculateTotalPaid()
    {
        return $this->payments->sum('amount');
    }

    /**
     * Calculate the outstanding balance for the tenant.
     */
    public function calculateOutstandingBalance()
    {
        $totalRentDue = $this->calculateTotalRentDue();  // Get the total rent due
        $totalPaid = $this->calculateTotalPaid();  // Get the total amount paid

        return $totalRentDue - $totalPaid;  // Return the balance
    }
}
