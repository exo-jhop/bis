<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayOfficial extends Model
{
    protected $fillable = [
        'resident_id',
        'position_id',
        'contact_number',
        'email',
        'photo',
    ];
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }
    public function position()
    {
        return $this->belongsTo(BarangayOfficialPosition::class);
    }
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
