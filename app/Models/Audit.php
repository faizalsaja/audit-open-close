<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Doctor;
class Audit extends Model
{
    protected $fillable = [
        'patient_id',
        'room_id',
        'auditor_id',
        'audit_no',
        'telaah_no',
        'audit_date',
        'case_type',
        'diagnosis_id',
        'diagnosis_description',
        'doctor_id',
        'doctor_name',
        'status',
        'audit_type',
        'overall_score',
        
    ];

    protected $casts = [
        'audit_date' => 'date',
        'overall_score' => 'decimal:2',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function auditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }
    public function auditForms(): HasMany
{
    return $this->hasMany(AuditForm::class);
}
public function conditions(): HasMany
{
    return $this->hasMany(AuditCondition::class);
}
public function doctor()
{
    return $this->belongsTo(
        Doctor::class,
        'doctor_id',
        'kode_dokter'
    );
}
}