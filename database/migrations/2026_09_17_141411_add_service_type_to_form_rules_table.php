<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_rules', function (Blueprint $table) {
            $table->string('service_type')
                ->nullable()
                ->after('case_type');

            $table->index([
                'audit_type',
                'case_type',
                'service_type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('form_rules', function (Blueprint $table) {
            $table->dropIndex([
                'form_rules_audit_type_case_type_service_type_index'
            ]);

            $table->dropColumn('service_type');
        });
    }
};