<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('form_rules', function (Blueprint $table) {
        $table->id();

        $table->foreignId('form_id')
            ->constrained('forms')
            ->cascadeOnDelete();

        $table->string('audit_type');
        // OPEN / CLOSE

        $table->string('case_type');
        // BEDAH / NON-BEDAH / ANAK / KEBIDANAN / NEONATUS

        $table->string('service_type')->nullable();
        // RAJAL / IGD / RAWAT INAP / VK

        $table->boolean('is_required')->default(false);

        $table->string('condition')->nullable();
        /*
         * Kondisi khusus:
         *
         * surgery
         * anesthesia
         * transfusion
         * icu
         * chemotherapy
         * hd
         * death
         * delivery
         * external_transfer
         * critical
         */

        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->index([
            'audit_type',
            'case_type',
            'service_type',
        ]);
    });
}

    public function down(): void
    {
        Schema::dropIfExists('form_rules');
    }
};