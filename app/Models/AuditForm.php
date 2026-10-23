<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditForm extends Model
{
    protected $fillable = [
        'audit_id',
        'form_id',
        'score',
    ];

    public function audit(): BelongsTo
    {
        return $this->belongsTo(Audit::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function indicators(): HasMany
    {
        return $this->hasMany(AuditIndicator::class);
    }
    public function calculateScore(): float
{
    $total = $this->indicators()->count();

    if ($total === 0) {
        return 0;
    }

    $score = $this->indicators()->sum('score');

    return round(($score / $total) * 100, 2);
}
}