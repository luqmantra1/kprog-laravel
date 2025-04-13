<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quotation';

    protected $fillable = [
        'client_id',
        'proposal_id',
        'insurance_company',
        'quotation_number',
        'amount',
        'quotation_file',
        'status',
        'acceptance_status',
        'policy_status',
    ];

    // Assuming each quotation belongs to a proposal
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
}
