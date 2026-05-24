@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Dashboard</h3>
        <div class="text-muted">Overview pendaftaran dan statistik anggota</div>
    </div>
    <a href="{{ route('admin.registrations.index') }}" class="btn btn-primary"><i class="bi bi-list-check me-1"></i> Lihat Semua Anggota</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon bg-primary-subtle text-primary"><i class="bi bi-people"></i></div>
                <div>
                    <div class="small text-muted">Total Anggota</div>
                    <div class="fs-3 fw-semibold">{{ $total }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon bg-success-subtle text-success"><i class="bi bi-person-check"></i></div>
                <div>
                    <div class="small text-muted">Anggota UMUM</div>
                    <div class="fs-3 fw-semibold">{{ $byCategory['UMUM'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon bg-primary-subtle text-primary"><i class="bi bi-building"></i></div>
                <div>
                    <div class="small text-muted">Anggota UTAMA</div>
                    <div class="fs-3 fw-semibold">{{ $byCategory['UTAMA'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon bg-warning-subtle text-warning"><i class="bi bi-star"></i></div>
                <div>
                    <div class="small text-muted">Anggota PRIORITAS</div>
                    <div class="fs-3 fw-semibold">{{ $byCategory['PRIORITAS'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="list-card p-3 mb-4">
    <div class="d-flex justify-content-between align-items-center px-1 mb-2">
        <div class="fw-semibold">Anggota Terbaru</div>
        <div class="text-muted small">5 pendaftaran terbaru</div>
    </div>
    <div class="list-group list-group-flush">
        @forelse($latest as $reg)
            @php
                $badge = [
                    'UMUM' => 'badge-soft badge-umum',
                    'UTAMA' => 'badge-soft badge-utama',
                    'PRIORITAS' => 'badge-soft badge-prioritas',
                ][$reg->umkm_category] ?? 'badge-soft';
                $waPhone = $reg->whatsapp_number ?: $reg->phone;
                $phone = preg_replace('/\\D+/', '', $waPhone ?? '');
                if (str_starts_with($phone, '0')) { $phone = '62'.substr($phone,1); }
                $wa = $phone ? 'https://wa.me/'.$phone : null;
                $statusMap = ['pending'=>'warning','accepted'=>'success','rejected'=>'danger'];
            @endphp
            <div class="list-group-item d-flex align-items-center">
                <div class="d-inline-flex justify-content-center align-items-center bg-light rounded-circle me-3" style="width:40px;height:40px">
                    <i class="bi bi-person"></i>
                </div>
                <div class="flex-fill">
                    <div class="fw-semibold">{{ $reg->name }}</div>
                    <div class="small text-muted">{{ $reg->email }}</div>
                </div>
                <div class="me-3">
                    <span class="{{ $badge }}">{{ $reg->umkm_category }}</span>
                </div>
                <div class="me-3 text-muted small">{{ $reg->created_at?->translatedFormat('j F Y') }}</div>
                <div class="ms-auto">
                    @if($wa)
                        <a target="_blank" href="{{ $wa }}" class="btn btn-success btn-sm"><i class="bi bi-whatsapp me-1"></i> WhatsApp</a>
                    @endif
                    <a href="{{ route('admin.registrations.show', $reg) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                </div>
            </div>
        @empty
            <div class="text-center text-muted p-4">Belum ada pendaftaran.</div>
        @endforelse
    </div>
</div>


@endsection
