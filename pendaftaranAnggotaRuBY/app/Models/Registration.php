<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'business_type',
        'business_name',
        'notes',
        'umkm_category',
        'status',
        'membership_status',
        'nik',
        'place_date_birth',
        'address',
        'whatsapp_number',
        'has_business',
        'business_logo',
        'legalities',
        'legality_proofs',
        'npwp_number',
        'business_description',
        'business_start_year',
        'business_chain',
        'business_address_street',
        'business_address_district',
        'business_address_city',
        'business_address_province',
        'product_names',
        'product_descriptions',
        'product_photos',
        'employee_count',
        'monthly_turnover',
        'website',
        'social_media',
        'marketplaces',
        'events_followed',
        'has_exported',
        'export_destination',
        'bri_customer_status',
        'has_bri_cik_ditiro_account',
        'bri_cik_ditiro_account_number',
        'has_qris_bri_cik_ditiro',
        'agreement',
    ];

    protected $casts = [
        'has_business' => 'boolean',
        'has_exported' => 'boolean',
        'has_bri_cik_ditiro_account' => 'boolean',
        'has_qris_bri_cik_ditiro' => 'boolean',
        'agreement' => 'boolean',
        'legalities' => 'array',
        'legality_proofs' => 'array',
        'product_names' => 'array',
        'product_descriptions' => 'array',
        'product_photos' => 'array',
        'social_media' => 'array',
        'marketplaces' => 'array',
    ];

    /**
     * Accessor for NIK - automatically decrypts if possible
     */
    public function getNikAttribute($value)
    {
        if (!$value) return $value;
        try {
            return decrypt($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    /**
     * Mutator for NIK - automatically encrypts
     */
    public function setNikAttribute($value)
    {
        $this->attributes['nik'] = $value ? encrypt($value) : $value;
    }

    /**
     * Accessor for NPWP - automatically decrypts if possible
     */
    public function getNpwpNumberAttribute($value)
    {
        if (!$value) return $value;
        try {
            return decrypt($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    /**
     * Mutator for NPWP - automatically encrypts
     */
    public function setNpwpNumberAttribute($value)
    {
        $this->attributes['npwp_number'] = $value ? encrypt($value) : $value;
    }

    /**
     * Accessor for Account Number - automatically decrypts if possible
     */
    public function getBriCikDitiroAccountNumberAttribute($value)
    {
        if (!$value) return $value;
        try {
            return decrypt($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    /**
     * Mutator for Account Number - automatically encrypts
     */
    public function setBriCikDitiroAccountNumberAttribute($value)
    {
        $this->attributes['bri_cik_ditiro_account_number'] = $value ? encrypt($value) : $value;
    }

    /**
     * Safe getter for NIK (kept for backward compatibility with existing view changes)
     */
    public function getSafeNikAttribute()
    {
        return $this->nik;
    }

    /**
     * Safe getter for NPWP (kept for backward compatibility with existing view changes)
     */
    public function getSafeNpwpAttribute()
    {
        return $this->npwp_number;
    }

    /**
     * Safe getter for Account Number (kept for backward compatibility with existing view changes)
     */
    public function getSafeAccountNumberAttribute()
    {
        return $this->bri_cik_ditiro_account_number;
    }

    /**
     * Get the masked NIK.
     * Format: 4 digits + XXXXXXXX + 4 digits
     */
    public function getMaskedNikAttribute()
    {
        $val = $this->safe_nik;
        if (!$val) return '-';
        return substr($val, 0, 4) . 'XXXXXXXX' . substr($val, -4);
    }

    /**
     * Get the masked NPWP.
     */
    public function getMaskedNpwpAttribute()
    {
        $val = $this->safe_npwp;
        if (!$val || $val === '-') return $val ?: '-';
        return substr($val, 0, 4) . 'XXXXXXXX' . substr($val, -4);
    }

    /**
     * Get the masked Account Number.
     */
    public function getMaskedAccountNumberAttribute()
    {
        $val = $this->safe_account_number;
        if (!$val || $val === '0') return $val ?: '-';
        return substr($val, 0, 4) . 'XXXXXXXX' . substr($val, -4);
    }
}
