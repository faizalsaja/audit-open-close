<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
class Patient extends Model
{
    protected $fillable = [
        'no_rm',
        'registrasi_id',
        'nama',
        'jenis_layanan',
        'tanggal_masuk',
        'tanggal_pulang',
        'ruang_deskripsi',
        'diagnosis_id',
        'deskripsi_diagnosa',
        'dokter_id',
        'nama_dokter',
        'keadaan_pulang',
    ];
    public function doctor()
{
    return $this->belongsTo(
        Doctor::class,
        'dokter_id',
        'kode_dokter'
    );
}
}