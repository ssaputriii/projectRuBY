@extends('admin.layouts.app')

@section('title', 'Data Pendaftaran')

@section('content')
<div class="row g-4 mb-4 align-items-end">
    <div class="col-md-auto me-auto">
        <h4 class="mb-0 fw-bold text-dark">
            @if(request('category'))
                Data Anggota {{ ucfirst(strtolower(request('category'))) }}
            @else
                Semua Data Pendaftaran
            @endif
        </h4>
        <a href="javascript:void(0)" onclick="confirmExport('{{ route('admin.registrations.export', request()->all()) }}')" class="btn btn-sm btn-outline-success mt-2">
            <i class="bi bi-file-earmark-excel me-1"></i> Export ke Excel
        </a>
    </div>
    <div class="col-md-auto">
        <form class="row g-2" method="GET">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @else
                <div class="col-auto">
                    <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <option value="UMUM" {{ request('category') == 'UMUM' ? 'selected' : '' }}>UMUM</option>
                        <option value="UTAMA" {{ request('category') == 'UTAMA' ? 'selected' : '' }}>UTAMA</option>
                        <option value="PRIORITAS" {{ request('category') == 'PRIORITAS' ? 'selected' : '' }}>PRIORITAS</option>
                    </select>
                </div>
            @endif
            <div class="col-auto">
                <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Jenis Usaha</option>
                    @foreach(['FnB (Makanan & Minuman)', 'Home Decor / Craft', 'Fashion', 'Jasa', 'Lainnya'] as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <input type="search" class="form-control" name="q" placeholder="Cari nama/email..." value="{{ request('q') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
            <tr>
                <th class="ps-4">Nama</th>
                <th>NIK</th>
                <th>Email</th>
                <th>Kontak</th>
                <th>Jenis Usaha</th>
                <th>Kategori UMKM</th>
                <th>Tanggal</th>
                <th class="text-end pe-4">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($registrations as $r)
                <tr>
                    <td class="ps-4 fw-bold">{{ $r->name }}</td>
                    <td class="small text-muted font-monospace">
                        {{ $r->masked_nik }}
                    </td>
                    <td>{{ $r->email }}</td>
                    <td>
                        <div class="small">
                            @if($r->whatsapp_number)
                                <div class="text-success mb-1">
                                    <i class="bi bi-whatsapp"></i> {{ $r->whatsapp_number }}
                                </div>
                            @endif
                            @if($r->phone && $r->phone != $r->whatsapp_number)
                                <div class="text-muted">
                                    <i class="bi bi-telephone"></i> {{ $r->phone }}
                                </div>
                            @endif
                        </div>
                    </td>
                    <td>{{ $r->business_type ?? '-' }}</td>
                    <td>
                        @php
                            $badgeClass = [
                                'UMUM' => 'text-bg-success',
                                'UTAMA' => 'text-bg-primary',
                                'PRIORITAS' => 'text-bg-warning',
                            ][$r->umkm_category] ?? 'text-bg-secondary';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $r->umkm_category }}</span>
                    </td>
                    <td>{{ $r->created_at?->format('d M Y') }}</td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            @php
                                $waPhone = $r->whatsapp_number ?: $r->phone;
                                $waPhone = preg_replace('/\D+/', '', $waPhone ?? '');
                                if (str_starts_with($waPhone, '0')) { $waPhone = '62'.substr($waPhone, 1); }
                                $waUrl = $waPhone ? 'https://wa.me/'.$waPhone : null;
                            @endphp
                            
                            @if($waUrl)
                                <a target="_blank" href="{{ $waUrl }}" class="btn btn-sm btn-outline-success rounded-3" title="Hubungi via WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            @endif
                            <a href="{{ route('admin.registrations.show', $r) }}" class="btn btn-sm btn-outline-primary rounded-3" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.registrations.edit', $r) }}" class="btn btn-sm btn-outline-warning rounded-3" title="Edit Data">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.registrations.destroy', $r) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-3" title="Hapus Data">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted p-4">Belum ada data.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $registrations->links() }}
    </div>
  </div>
@endsection
