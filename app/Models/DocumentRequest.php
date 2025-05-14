<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentRequest extends Model
{
    protected $fillable = ['resident_id', 'document_type_id', 'purpose', 'status'];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
