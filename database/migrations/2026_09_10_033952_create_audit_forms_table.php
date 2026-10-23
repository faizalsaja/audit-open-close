<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_forms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('audit_id')
                ->constrained('audits')
                ->cascadeOnDelete();

            $table->foreignId('form_id')
                ->constrained('forms')
                ->cascadeOnDelete();

            $table->unsignedInteger('score')->nullable();

            $table->timestamps();

            $table->unique(['audit_id', 'form_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_forms');
    }
};