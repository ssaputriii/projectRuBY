<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, auth()->user()->password)) {
            session(['export_verified_at' => now()]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Password salah.'], 422);
    }

    private function isExportVerified()
    {
        if (!session()->has('export_verified_at')) return false;
        
        // Verifikasi berlaku selama 5 menit
        $verifiedAt = session('export_verified_at');
        if (now()->diffInMinutes($verifiedAt) > 5) {
            session()->forget('export_verified_at');
            return false;
        }
        
        return true;
    }

    public function index(Request $request)
    {
        $query = Registration::query();

        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('umkm_category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('business_type', $request->type);
        }

        $registrations = $query->latest()->paginate(10)->withQueryString();
        return view('admin.registrations.index', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function edit(Registration $registration)
    {
        return view('admin.registrations.edit', compact('registration'));
    }

    public function update(Request $request, Registration $registration)
    {
        $category = $registration->umkm_category;

        $rules = [
            'membership_status' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'regex:/^[0-9]+$/', 'size:16'],
            'place_date_birth' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'whatsapp_number' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
        ];

        if ($category === 'UMUM') {
            $rules['has_business'] = ['required', 'boolean'];
        } else {
            $rules['business_name'] = ['required', 'string', 'max:255'];
            $rules['business_logo'] = ['nullable', 'image', 'max:10240'];
            $rules['legalities'] = ['required', 'array'];
            $rules['npwp_number'] = ['required', 'string', 'max:50'];
            $rules['business_type'] = ['required', 'string'];
            $rules['business_description'] = ['required', 'string'];
            $rules['business_start_year'] = ['required', 'integer'];
            $rules['business_chain'] = ['required', 'string'];
            $rules['business_address_street'] = ['required', 'string'];
            $rules['business_address_district'] = ['required', 'string'];
            $rules['business_address_city'] = ['required', 'string'];
            $rules['business_address_province'] = ['required', 'string'];
            $rules['employee_count'] = ['required', 'integer'];
            $rules['monthly_turnover'] = ['required', 'string'];
            $rules['website'] = ['nullable', 'string', 'max:255'];
            $rules['social_media'] = ['required', 'array'];
            $rules['marketplaces'] = ['required', 'array'];
            $rules['events_followed'] = ['nullable', 'string'];
            $rules['has_exported'] = ['required', 'boolean'];
            $rules['export_destination'] = ['nullable', 'string'];
            $rules['bri_customer_status'] = ['required', 'string'];
            $rules['has_bri_cik_ditiro_account'] = ['required', 'boolean'];
            $rules['bri_cik_ditiro_account_number'] = ['required', 'string'];
            $rules['has_qris_bri_cik_ditiro'] = ['required', 'boolean'];
            
            // Arrays
            $rules['product_names'] = ['required', 'array'];
            $rules['product_descriptions'] = ['required', 'array'];
            $rules['social_media'] = ['required', 'array'];
            $rules['marketplaces'] = ['required', 'array'];
        }

        $validated = $request->validate($rules);

        // Track Changes
        $fieldLabels = [
            'membership_status' => 'Status Keanggotaan',
            'name' => 'Nama Lengkap',
            'nik' => 'NIK',
            'place_date_birth' => 'Tempat Tanggal Lahir',
            'address' => 'Alamat',
            'whatsapp_number' => 'Nomor WhatsApp',
            'phone' => 'Nomor Telepon',
            'email' => 'Email',
            'has_business' => 'Status Usaha',
            'business_name' => 'Nama Usaha',
            'business_logo' => 'Logo Usaha',
            'legalities' => 'Legalitas',
            'npwp_number' => 'NPWP',
            'business_type' => 'Jenis Usaha',
            'business_description' => 'Deskripsi Usaha',
            'business_start_year' => 'Tahun Mulai Usaha',
            'business_chain' => 'Rantai Usaha',
            'business_address_street' => 'Alamat Usaha (Jalan)',
            'business_address_district' => 'Alamat Usaha (Kecamatan)',
            'business_address_city' => 'Alamat Usaha (Kota)',
            'business_address_province' => 'Alamat Usaha (Provinsi)',
            'employee_count' => 'Jumlah Karyawan',
            'monthly_turnover' => 'Omset Per Bulan',
            'website' => 'Website',
            'social_media' => 'Media Sosial',
            'marketplaces' => 'Marketplace',
            'events_followed' => 'Event Diikuti',
            'has_exported' => 'Status Ekspor',
            'export_destination' => 'Negara Tujuan Ekspor',
            'bri_customer_status' => 'Status Nasabah BRI',
            'has_bri_cik_ditiro_account' => 'Rekening BRI Cik Ditiro',
            'bri_cik_ditiro_account_number' => 'No Rekening BRI',
            'has_qris_bri_cik_ditiro' => 'QRIS BRI',
            'product_names' => 'Daftar Produk',
            'product_descriptions' => 'Deskripsi Produk',
        ];

        $changedFields = [];
        foreach ($validated as $key => $value) {
            // Skip tracking if it's an array (like product_names) or file for simple comparison
            if (is_array($value)) {
                if (json_encode($registration->$key) !== json_encode($value)) {
                    $changedFields[] = $fieldLabels[$key] ?? $key;
                }
                continue;
            }

            if ($registration->$key != $value && isset($fieldLabels[$key])) {
                $changedFields[] = $fieldLabels[$key];
            }
        }

        // Handle File Uploads
        if ($request->hasFile('business_logo')) {
            if ($registration->business_logo) {
                Storage::disk('public')->delete($registration->business_logo);
            }
            $validated['business_logo'] = $request->file('business_logo')->store('business_logos', 'public');
            if (!in_array('Logo Usaha', $changedFields)) {
                $changedFields[] = 'Logo Usaha';
            }
        }

        $registration->update($validated);

        $successMsg = 'Data anggota berhasil diperbarui.';
        if (!empty($changedFields)) {
            $successMsg .= ' Perubahan: ' . implode(', ', $changedFields);
        }

        return redirect()->route('admin.registrations.edit', $registration->id)
            ->with('success', $successMsg);
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('admin.registrations.index')->with('success', 'Data pendaftar dihapus.');
    }

    public function export(Request $request)
    {
        $query = Registration::query();

        if ($request->filled('category')) {
            $query->where('umkm_category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('business_type', $request->type);
        }

        $filename = 'registrations_'.($request->category ? strtolower($request->category).'_' : 'full_').now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $columns = [
            'ID', 'Kategori', 'Status Keanggotaan', 'Nama Lengkap', 'NIK', 'Tempat Tanggal Lahir', 
            'Email', 'No WA', 'No Telp', 'Alamat', 'Sudah Punya Usaha (Umum)',
            'Nama Usaha', 'Jenis Usaha', 'Legalitas', 'NPWP', 'Tahun Mulai', 'Rantai Usaha',
            'Alamat Usaha', 'Kecamatan Usaha', 'Kota Usaha', 'Provinsi Usaha',
            'Daftar Produk', 'Jumlah Karyawan', 'Omset Per Bulan', 'Website', 'Sosial Media', 'Marketplace',
            'Event Diikuti', 'Pernah Ekspor', 'Negara Tujuan',
            'Status Nasabah BRI', 'Memiliki Rekening BRI', 'No Rekening BRI', 'QRIS BRI',
            'Tanggal Daftar'
        ];

        $isVerified = $this->isExportVerified();

        $callback = function () use ($columns, $query, $isVerified) {
            $handle = fopen('php://output', 'w');
            
            // Tambahkan BOM (Byte Order Mark) agar Excel langsung mengenali format UTF-8 (Rapi)
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Gunakan titik koma (;) sebagai pemisah karena Excel di Indonesia seringkali 
            // menganggap koma sebagai pemisah desimal, bukan pemisah kolom.
            fputcsv($handle, $columns, ';');
            
            $query->orderBy('created_at','desc')->chunk(200, function ($chunk) use ($handle, $isVerified) {
                foreach ($chunk as $r) {
                    $nik = $isVerified ? $r->nik : $r->masked_nik;
                    $npwp = $isVerified ? $r->npwp_number : $r->masked_npwp;
                    $acc = $isVerified ? $r->bri_cik_ditiro_account_number : $r->masked_account_number;

                    // Force Excel to treat long numbers as text using ="value" format
                    // only if it's the full unmasked value (contains many digits)
                    if ($isVerified) {
                        $nik = '="' . $nik . '"';
                        if ($npwp && $npwp !== '-') $npwp = '="' . $npwp . '"';
                        if ($acc && $acc !== '0') $acc = '="' . $acc . '"';
                    }

                    fputcsv($handle, [
                        $r->id,
                        $r->umkm_category,
                        $r->membership_status,
                        $r->name,
                        $nik,
                        $r->place_date_birth,
                        $r->email,
                        $r->whatsapp_number,
                        $r->phone,
                        $r->address,
                        $r->has_business ? 'Sudah' : 'Belum',
                        $r->business_name,
                        $r->business_type,
                        is_array($r->legalities) ? implode(', ', $r->legalities) : $r->legalities,
                        $npwp,
                        $r->business_start_year,
                        $r->business_chain,
                        $r->business_address_street,
                        $r->business_address_district,
                        $r->business_address_city,
                        $r->business_address_province,
                        is_array($r->product_names) ? implode(', ', $r->product_names) : $r->product_names,
                        $r->employee_count,
                        $r->monthly_turnover,
                        $r->website,
                        is_array($r->social_media) ? implode(', ', $r->social_media) : $r->social_media,
                        is_array($r->marketplaces) ? implode(', ', $r->marketplaces) : $r->marketplaces,
                        $r->events_followed,
                        $r->has_exported ? 'Sudah' : 'Belum',
                        $r->export_destination,
                        $r->bri_customer_status,
                        $r->has_bri_cik_ditiro_account ? 'Sudah' : 'Belum',
                        $acc,
                        $r->has_qris_bri_cik_ditiro ? 'Sudah' : 'Belum',
                        optional($r->created_at)->format('Y-m-d H:i:s'),
                    ], ';');
                }
            });
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Registration $registration)
    {
        $isVerified = $this->isExportVerified();
        $pdf = Pdf::loadView('admin.registrations.pdf', compact('registration', 'isVerified'));
        return $pdf->download('Data_Pendaftar_'.$registration->name.'.pdf');
    }
}
