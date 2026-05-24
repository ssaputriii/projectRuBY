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
        Schema::table('registrations', function (Blueprint $table) {
            $table->text('nik')->nullable()->change();
            $table->text('npwp_number')->nullable()->change();
            $table->text('bri_cik_ditiro_account_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('nik')->nullable()->change();
            $table->string('npwp_number')->nullable()->change();
            $table->string('bri_cik_ditiro_account_number')->nullable()->change();
        });
    }
};
