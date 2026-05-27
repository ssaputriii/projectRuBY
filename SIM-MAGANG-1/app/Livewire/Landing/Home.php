<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use App\Models\Batch;
use Carbon\Carbon;

class Home extends Component
{
    public $activeBatch;
    public $currentBatch;
    public $upcomingBatch;
    public $expiredBatch;
    public $registrationStatus = 'closed';

    public function mount()
    {
        $today = Carbon::today();
        $this->currentBatch = Batch::with('divisi')->withCount('peserta')->active()->first();
        $this->activeBatch = $this->currentBatch && !$this->currentBatch->isQuotaFull() 
            ? $this->currentBatch 
            : null;

        if ($this->activeBatch) {
            $this->registrationStatus = 'open';
        } elseif ($this->currentBatch && $this->currentBatch->isQuotaFull()) {
            $this->registrationStatus = 'quota_full';
        } elseif ($this->currentBatch) {
            $this->registrationStatus = 'closed';
        } else {
            $this->upcomingBatch = Batch::where('tanggal_mulai', '>', $today)
                ->orderBy('tanggal_mulai', 'asc')
                ->first();
            if ($this->upcomingBatch) {
                $this->registrationStatus = 'upcoming';
            }
            // expiredBatch dihapus — tidak perlu ditampilkan
        }
    }

    public function render()
    {
        // Jangan tampilkan expiredBatch ke view home
        $batch = $this->activeBatch ?? $this->currentBatch ?? $this->upcomingBatch ?? null;

        return view('livewire.landing.home', [
            'batch' => $batch,
            'status' => $this->registrationStatus,
        ])->layout('layouts.landing');
    }
}