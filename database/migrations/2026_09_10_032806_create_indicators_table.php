<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();

            // Formulir yang memiliki indikator ini
            $table->foreignId('form_id')
                ->constrained('forms')
                ->cascadeOnDelete();

            // Nama indikator
            $table->string('name');

            // Kelompok indikator:
            // identity, readability, authentication, correction,
            // atau specific
            $table->string('type')->default('specific');

            // Urutan indikator pada formulir
            $table->unsignedInteger('sort_order')->default(0);

            // Apakah indikator wajib diperiksa
            $table->boolean('is_required')->default(true);

            // Status indikator
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicators');
    }
};