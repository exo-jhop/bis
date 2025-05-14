<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = [
        'city_id',
        'name',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function puroks()
    {
        return $this->hasMany(Purok::class);
    }
}
