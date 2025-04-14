<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $table = 'policy';  // Explicitly specify the table name

    protected $fillable = [
        'quotation_id',
        'policy_number',
        'status',
        'policy_file',
        'start_date',
        'end_date',
    ];

    // Relationship with Quotation
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
    // Relationship with Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
