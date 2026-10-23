<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Indicator extends Model
{
    protected $fillable = [
        'form_id',
        'name',
        'type',
        'sort_order',
        'is_required',
        'is_active',
    ];

    /**
     * Indikator dimiliki oleh satu formulir.
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}