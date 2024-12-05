<?php

// app/Models/Room.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['roomName', 'house_id', 'description', 'price', 'max_tenants'];

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id'); // Ensure the foreign key is 'house_id'
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'room_ID');
    }
}


