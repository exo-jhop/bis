<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class City extends Model
{
    protected $fillable = [
        'name',
        'province_id',
    ];

    public function barangays()
    {
        return $this->hasMany(Barangay::class);
    }
    public function residents(): HasManyThrough
    {
        return $this->hasManyThrough(Resident::class, Barangay::class);
    }
}
