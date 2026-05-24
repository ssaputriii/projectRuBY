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
            // Data Diri
            $table->string('membership_status')->nullable(); // Anggota Lama / Anggota Baru
            $table->string('nik')->nullable();
            $table->string('place_date_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->boolean('has_business')->default(false); // Untuk kategori UMUM

            // Data Usaha
            $table->string('business_logo')->nullable();
            $table->string('legalities')->nullable(); // NPWP, NIB, HALAL, IRT, dll (comma separated or JSON)
            $table->text('legality_proofs')->nullable(); // JSON paths
            $table->string('npwp_number')->nullable();
            $table->text('business_description')->nullable();
            $table->integer('business_start_year')->nullable();
            $table->string('business_chain')->nullable(); // Produksi, Reseller, Supplier, dll
            
            // Alamat Usaha
            $table->string('business_address_street')->nullable();
            $table->string('business_address_district')->nullable();
            $table->string('business_address_city')->nullable();
            $table->string('business_address_province')->nullable();

            // Data Produk
            $table->text('product_names')->nullable(); // JSON
            $table->text('product_descriptions')->nullable(); // JSON
            $table->text('product_photos')->nullable(); // JSON paths
            
            $table->integer('employee_count')->nullable();
            $table->string('monthly_turnover')->nullable(); // < 300 JT, 300 JT - 1 M, > 1 M
            $table->string('website')->nullable();
            $table->text('social_media')->nullable(); // JSON
            $table->text('marketplaces')->nullable(); // JSON
            $table->text('events_followed')->nullable();

            // Data Ekspor
            $table->boolean('has_exported')->default(false);
            $table->string('export_destination')->nullable();

            // Data Rekening
            $table->string('bri_customer_status')->nullable(); // Simpanan, Pinjaman, Tidak
            $table->boolean('has_bri_cik_ditiro_account')->default(false);
            $table->string('bri_cik_ditiro_account_number')->nullable();
            $table->boolean('has_qris_bri_cik_ditiro')->default(false);

            // Persetujuan
            $table->boolean('agreement')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'membership_status', 'nik', 'place_date_birth', 'address', 'whatsapp_number', 'has_business',
                'business_logo', 'legalities', 'legality_proofs', 'npwp_number', 'business_description',
                'business_start_year', 'business_chain', 'business_address_street', 'business_address_district',
                'business_address_city', 'business_address_province', 'product_names', 'product_descriptions',
                'product_photos', 'employee_count', 'monthly_turnover', 'website', 'social_media', 'marketplaces',
                'events_followed', 'has_exported', 'export_destination', 'bri_customer_status',
                'has_bri_cik_ditiro_account', 'bri_cik_ditiro_account_number', 'has_qris_bri_cik_ditiro', 'agreement'
            ]);
        });
    }
};
