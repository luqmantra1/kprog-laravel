<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    // Add 'user_id' to the fillable property
    protected $fillable = [
        'user_id',
        'action',
        'description',
        // Add other attributes here as needed
    ];

    // Define the relationship with the User model (assuming it's related to a User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
