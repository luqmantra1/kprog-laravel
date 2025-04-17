<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'file_path',
        'proposal_path',
        'quotation_path',
        'policy_path'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function proposal()
{
    return $this->belongsTo(\App\Models\Proposal::class);
}

public function quotation()
{
    return $this->belongsTo(\App\Models\Quotation::class);
}

public function policy()
{
    return $this->belongsTo(\App\Models\Policy::class);
}


public function client()
{
    return $this->belongsTo(\App\Models\Client::class);
}






}
