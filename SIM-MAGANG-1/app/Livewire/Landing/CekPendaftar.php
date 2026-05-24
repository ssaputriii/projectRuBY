<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use App\Models\Batch;
use App\Models\Peserta;

class CekPendaftar extends Component
{
    public $limit = null; // Default to null for full page

    public function mount($limit = null)
    {
        $this->limit = $limit;
    }

    public function render()
    {
        $activeBatch = Batch::active()->first();
        
        $peserta = collect();
        if ($activeBatch) {
            $query = Peserta::where('batch_id', $activeBatch->id)
                ->orderBy('created_at', 'desc');
            
            if ($this->limit) {
                $peserta = $query->limit($this->limit)->get();
            } else {
                $peserta = $query->get();
            }
        }

        return view('livewire.landing.cek-pendaftar', [
            'activeBatch' => $activeBatch,
            'peserta' => $peserta
        ])->layout('layouts.landing');
    }
}
