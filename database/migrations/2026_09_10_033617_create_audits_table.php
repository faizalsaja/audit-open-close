<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('audits', function (Blueprint $table) {
        $table->id();

        $table->foreignId('patient_id')
            ->constrained('patients')
            ->cascadeOnDelete();

        $table->foreignId('room_id')
            ->constrained('rooms')
            ->cascadeOnDelete();

        $table->foreignId('auditor_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->string('audit_no')->nullable();
        $table->string('telaah_no')->nullable();

        $table->date('audit_date');

        $table->string('case_type')->nullable();

        $table->string('diagnosis_id')->nullable();
        $table->text('diagnosis_description')->nullable();

        $table->string('doctor_id')->nullable();
        $table->string('doctor_name')->nullable();

        $table->string('status')->default('draft');

        $table->decimal('overall_score', 5, 2)->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
