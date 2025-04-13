<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposal'; // important: use singular 'proposal'

    protected $fillable = [
        'client_id',
        'proposal_title',
        'submission_date',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
