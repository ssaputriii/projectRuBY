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
        if (!Schema::hasTable('registration_logs')) {
            Schema::create('registration_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('registration_id')->constrained()->onDelete('cascade');
                $table->string('activity');
                $table->text('details')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('registration_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('registration_logs', 'registration_id')) {
                $table->foreignId('registration_id')->after('id')->constrained()->onDelete('cascade');
            }

            if (!Schema::hasColumn('registration_logs', 'activity')) {
                $table->string('activity')->after('registration_id')->default('updated');
            }

            if (!Schema::hasColumn('registration_logs', 'details')) {
                $table->text('details')->nullable()->after('activity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_logs');
    }
};
