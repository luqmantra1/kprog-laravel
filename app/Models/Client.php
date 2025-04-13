<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client'; // table name

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
    ];

    // Relationship: One Client has many Proposals
    // public function proposals()
    // {
    //     return $this->hasMany(Proposal::class, 'client_id');
    // }
}
