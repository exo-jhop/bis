<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrgyID extends Model
{
    protected $table = 'brgy_ids';
    protected $fillable = [
        'resident_id',
        'id_number',
        'photo_path',
        'signature_path',
        'issue_date',
        'expiry_date',
        'remarks'
    ];
    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
}
