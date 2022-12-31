<?php

namespace App\Http\Livewire;

use App\Registled;
use Livewire\Component;

class RegistledCard extends Component
{
    public $drop;

    public $rLv;

    public $chest;

    public $maxlv;

    public $box;

    public function mount($drop)
    {
        $this->drop = $drop;
        $this->rLv = $drop->registled->recommended_lv ?? [];
        $this->chest = $drop->registled->box ?? [];
        $this->maxlv = $drop->registled->max_level ?? null;
    }

    public function updatedChest()
    {
        Registled::updateOrCreate([
            'drop_id' => $this->drop->id,
        ], [
            'box' => collect($this->chest)->sortKeys()->all(),
        ]);
    }

    public function updatedRLv()
    {
        Registled::updateOrCreate([
            'drop_id' => $this->drop->id,
        ], [
            'recommended_lv' => collect($this->rLv)->sortKeys()->all(),
        ]);
    }

    public function updatedMaxlv()
    {
        Registled::updateOrCreate([
            'drop_id' => $this->drop->id,
        ], [
            'max_level' => empty($this->maxlv) ? null : $this->maxlv,
        ]);
    }

    public function render()
    {
        return view('livewire.registled-card');
    }
}
