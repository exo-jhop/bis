<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayOfficialPosition extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function officials()
    {
        return $this->hasMany(BarangayOfficial::class);
    }
}
