<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();

            // Hubungan dengan kategori formulir
            $table->foreignId('form_category_id')
                ->constrained('form_categories')
                ->cascadeOnDelete();

            // Identitas formulir
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();

            // Urutan tampilan formulir
            $table->unsignedInteger('sort_order')->default(0);

            // Status formulir
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Satu kode boleh digunakan beberapa kali
            // selama nama/kategorinya berbeda.
            $table->index(['code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};