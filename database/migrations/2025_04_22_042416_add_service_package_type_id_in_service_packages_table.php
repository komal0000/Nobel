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
        Schema::table('service_packages', function (Blueprint $table) {
            $table->foreignId('service_package_type_id')->nullable()->constrained('service_package_types')->after('type');
            $table->string('type_name')->nullable()->after('service_package_type_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_packages', function (Blueprint $table) {
            $table->dropForeign(['service_package_type_id']);
            $table->dropColumn('service_package_type_id');
            $table->dropColumn('type_name');
        });
    }
};
