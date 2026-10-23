<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditIndicator extends Model
{
    protected $fillable = [
    'audit_form_id',
    'indicator_id',
    'answer',
    'terbaca',
    'lengkap',
    'score',
    'notes',
];

    public function auditForm(): BelongsTo
    {
        return $this->belongsTo(AuditForm::class);
    }

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class);
    }
}