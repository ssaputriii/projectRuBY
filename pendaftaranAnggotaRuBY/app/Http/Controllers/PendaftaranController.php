<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function showUmumForm()
    {
        return view('pages.pendaftaran.umum');
    }

    public function showUtamaForm()
    {
        return view('pages.pendaftaran.utama');
    }

    public function showPrioritasForm()
    {
        return view('pages.pendaftaran.prioritas');
    }

    public function store(Request $request)
    {
        $category = $request->input('umkm_category');

        $rules = [
            'umkm_category' => ['required', 'in:UMUM,UTAMA,PRIORITAS'],
            'membership_status' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'regex:/^[0-9]+$/', 'size:16'],
            'place_date_birth' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'whatsapp_number' => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
            'phone' => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
            'email' => ['required', 'email', 'max:255'],
        ];

        if ($category === 'UMUM') {
            $rules['has_business'] = ['required', 'string'];
        } else {
            // Data Usaha
            $rules['business_name'] = ['required', 'string', 'max:255'];
            $rules['business_logo'] = ['nullable', 'image', 'max:10240'];
            $rules['legalities'] = ['required', 'array'];
            $rules['legality_proofs.*'] = ['nullable', 'file', 'max:10240'];
            $rules['npwp_number'] = ['required', 'string', 'max:50'];
            $rules['business_type'] = ['required', 'string'];
            $rules['other_business_type'] = ['nullable', 'string', 'max:255'];
            $rules['business_description'] = ['required', 'string'];
            $rules['business_start_year'] = ['required', 'integer'];
            $rules['business_chain'] = ['required', 'string'];
            $rules['other_business_chain'] = ['nullable', 'string', 'max:255'];
            $rules['business_address_street'] = ['required', 'string'];
            $rules['business_address_district'] = ['required', 'string'];
            $rules['business_address_city'] = ['required', 'string'];
            $rules['business_address_province'] = ['required', 'string'];

            // Data Produk
            $rules['product_names'] = ['required', 'array'];
            $rules['product_descriptions'] = ['required', 'array'];
            $rules['product_photos.*'] = ['nullable', 'image', 'max:10240'];

            $rules['employee_count'] = ['required', 'integer'];
            $rules['monthly_turnover'] = ['required', 'string'];
            $rules['website'] = ['nullable', 'string', 'max:255'];
            $rules['social_media'] = ['required', 'array'];
            $rules['marketplaces'] = ['required', 'array'];
            $rules['events_followed'] = ['nullable', 'string'];

            // Data Ekspor
            $rules['has_exported'] = ['required', 'string'];
            $rules['export_destination'] = ['nullable', 'string'];

            // Data Rekening
            $rules['bri_customer_status'] = ['required', 'string'];
            $rules['has_bri_cik_ditiro_account'] = ['required', 'string'];
            $rules['bri_cik_ditiro_account_number'] = ['required', 'regex:/^[0-9]+$/'],
            $rules['has_qris_bri_cik_ditiro'] = ['required', 'string'];

            // Persetujuan
            $rules['agreement'] = ['required', 'accepted'];
        }

        $messages = [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.regex' => 'NIK harus berupa angka',
            'nik.size' => 'NIK harus terdiri dari 16 digit',
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi',
            'whatsapp_number.regex' => 'Nomor WhatsApp harus berupa angka',
            'whatsapp_number.min' => 'Nomor WhatsApp minimal 10 digit',
            'whatsapp_number.max' => 'Nomor WhatsApp maksimal 15 digit',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.regex' => 'Nomor telepon harus berupa angka',
            'phone.min' => 'Nomor telepon minimal 10 digit',
            'phone.max' => 'Nomor telepon maksimal 15 digit',
            'bri_cik_ditiro_account_number.regex' => 'Nomor rekening harus berupa angka',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'agreement.accepted' => 'Anda harus menyetujui pernyataan yang berlaku.',
            'business_logo.image' => 'Logo usaha harus berupa gambar.',
            'business_logo.max' => 'Ukuran logo usaha maksimal 10 MB.',
            'legality_proofs.*.file' => 'Bukti legalitas harus berupa file.',
            'legality_proofs.*.max' => 'Ukuran file bukti legalitas maksimal 10 MB.',
            'product_photos.*.image' => 'Foto produk harus berupa gambar.',
            'product_photos.*.max' => 'Ukuran foto produk maksimal 10 MB.',
        ];

        $validated = $request->validate($rules, $messages);

        // Handle "Lainnya" business type
        if (($category === 'UTAMA' || $category === 'PRIORITAS') && $validated['business_type'] === 'Lainnya') {
            $validated['business_type'] = $validated['other_business_type'] ?? 'Lainnya';
        }
        unset($validated['other_business_type']);

        // Handle "Lainnya" business chain
        if (($category === 'UTAMA' || $category === 'PRIORITAS') && isset($validated['business_chain']) && $validated['business_chain'] === 'Lainnya') {
            $validated['business_chain'] = $validated['other_business_chain'] ?? 'Lainnya';
        }
        unset($validated['other_business_chain']);

        // Map radio buttons to boolean
        if ($category === 'UMUM') {
            $validated['has_business'] = $validated['has_business'] === 'Sudah';
        } else {
            $validated['has_exported'] = $validated['has_exported'] === 'Sudah';
            $validated['has_bri_cik_ditiro_account'] = $validated['has_bri_cik_ditiro_account'] === 'Sudah';
            $validated['has_qris_bri_cik_ditiro'] = $validated['has_qris_bri_cik_ditiro'] === 'Sudah';
            $validated['agreement'] = true;
        }

        // Handle File Uploads
        if ($request->hasFile('business_logo')) {
            $validated['business_logo'] = $request->file('business_logo')->store('business_logos', 'public');
        }

        if ($request->hasFile('legality_proofs')) {
            $proofs = [];
            foreach ($request->file('legality_proofs') as $file) {
                $proofs[] = $file->store('legality_proofs', 'public');
            }
            $validated['legality_proofs'] = $proofs;
        }

        if ($request->hasFile('product_photos')) {
            $photos = [];
            foreach ($request->file('product_photos') as $file) {
                $photos[] = $file->store('product_photos', 'public');
            }
            $validated['product_photos'] = $photos;
        }

        $validated['status'] = 'accepted';

        Registration::create($validated);

        return redirect()->route('pendaftaran.sukses')->with('registered_category', $category);
    }

    public function success()
    {
        return view('pages.pendaftaran-sukses');
    }
}
