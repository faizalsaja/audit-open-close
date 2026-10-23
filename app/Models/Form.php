<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Form extends Model
{
    protected $fillable = [
        'form_category_id',
        'code',
        'name',
        'description',
         'keterangan_dokumen',
        'sort_order',
        'is_active',
    ];

    /**
     * Form dimiliki oleh satu kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(FormCategory::class, 'form_category_id');
    }

    /**
     * Form memiliki banyak indikator.
     */
    public function indicators(): HasMany
    {
        return $this->hasMany(Indicator::class)
            ->orderBy('sort_order');
    }
    public function auditForms(): HasMany
{
    return $this->hasMany(AuditForm::class);
}
public function rules(): HasMany
{
    return $this->hasMany(FormRule::class);
}
}