<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = ['firstName', 'lastName', 'email', 'room_ID', 'date_in'];

    /**
     * Get the room that the tenant belongs to.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_ID');
    }
    
}
