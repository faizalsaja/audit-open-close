<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_conditions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('audit_id')
                ->constrained('audits')
                ->cascadeOnDelete();

            $table->string('condition');

            $table->timestamps();

            $table->unique([
                'audit_id',
                'condition',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_conditions');
    }
};