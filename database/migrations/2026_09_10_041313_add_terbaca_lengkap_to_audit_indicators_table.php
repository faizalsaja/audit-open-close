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
    Schema::table('audit_indicators', function (Blueprint $table) {
        $table->string('terbaca')->nullable()->after('answer');
        $table->string('lengkap')->nullable()->after('terbaca');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('audit_indicators', function (Blueprint $table) {
        $table->dropColumn(['terbaca', 'lengkap']);
    });
}
};
