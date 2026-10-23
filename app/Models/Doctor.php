<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'kode_dokter',
        'nama_dokter',
        'bagian',
        'kode_plg',
        'keterangan',
    ];
}