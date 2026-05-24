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
        $this->activeBatch = $this->currentBatch && !$this->currentBatch->isQuotaFull() ? $this->currentBatch : null;

        if ($this->activeBatch) {
            $this->registrationStatus = 'open';
        } elseif ($this->currentBatch && $this->currentBatch->isQuotaFull()) {
            $this->registrationStatus = 'quota_full';
        } elseif ($this->currentBatch) {
            $this->registrationStatus = 'closed';
        } else {
            $this->upcomingBatch = Batch::where('tanggal_mulai', '>', $today)->orderBy('tanggal_mulai', 'asc')->first();
            if ($this->upcomingBatch) {
                $this->registrationStatus = 'upcoming';
            } else {
                $this->expiredBatch = Batch::where('tanggal_selesai', '<', $today)->orderBy('tanggal_selesai', 'desc')->first();
            }
        }
    }

    public function render()
    {
        return view('livewire.landing.home', [
            'batch' => $this->activeBatch ?? $this->currentBatch ?? $this->upcomingBatch ?? $this->expiredBatch,
            'status' => $this->registrationStatus,
        ])->layout('layouts.landing');
    }
}