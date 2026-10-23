<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_indicators', function (Blueprint $table) {
            $table->id();

            $table->foreignId('audit_form_id')
                ->constrained('audit_forms')
                ->cascadeOnDelete();

            $table->foreignId('indicator_id')
                ->constrained('indicators')
                ->cascadeOnDelete();

            $table->string('answer')->nullable();

            $table->unsignedInteger('score')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['audit_form_id', 'indicator_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_indicators');
    }
};