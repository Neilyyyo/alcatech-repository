<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'balance'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
