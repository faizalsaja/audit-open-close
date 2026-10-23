<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    /**
     * Satu kategori memiliki banyak formulir.
     */
    public function forms(): HasMany
    {
        return $this->hasMany(Form::class, 'form_category_id');
    }
}