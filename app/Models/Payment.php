<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_ID', 'amount', 'mod_of_payment', 'invoice', 'date_of_payment'
    ];

    /**
     * Get the tenant associated with the payment.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_ID');
    }
}
