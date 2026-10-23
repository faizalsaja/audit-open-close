<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // Data identitas dari API SIMRS
            $table->string('no_rm')->index();
            $table->string('registrasi_id')->index();
            $table->string('nama');

            // Data pelayanan
            $table->string('jenis_layanan')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_pulang')->nullable();

            // Data ruangan
            $table->string('ruang_deskripsi')->nullable();

            // Data diagnosis
            $table->string('diagnosis_id')->nullable();
            $table->text('deskripsi_diagnosa')->nullable();

            // Data dokter / DPJP
            $table->string('dokter_id')->nullable();
            $table->string('nama_dokter')->nullable();

            // Keadaan pasien saat pulang
            $table->string('keadaan_pulang')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};