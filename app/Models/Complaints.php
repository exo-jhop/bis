<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $fillable = [
        'resident_id',
        'type',
        'description',
        'status',
        'priority',
        'created_at',
        'updated_at',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
