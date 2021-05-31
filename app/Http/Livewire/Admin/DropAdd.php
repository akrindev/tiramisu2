<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Helpers\SaveAsImage as Image;

use App\Drop;
use App\DropType;

class DropAdd extends Component
{
    use WithFileUploads;

    public $name;
    public $name_en;
    public $monster;
    public $tipe;
    public $npc;
    public $picture;
    public $fullimage;
    public $released;

    protected $listeners = ['changeTipe'];

    public function mount()
    {
      $this->tipe= 1;
    }

    public function render()
    {
        return view('livewire.admin.drop-add');
    }

    public function changeTipe($value)
    {
      $this->tipe = $value;
    }

    public function save()
    {
      $same = Drop::where('name', $this->name)
        		->get();

      if($same->count() > 0)
      {
        return $this->emit('success', 0);
      }

      $type = $this->tipe;
      $dropType = DropType::find($type);

      if($this->picture)
      {
        $file = $this->picture->getRealPath();

        $nama = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

        $save = (new Image)->file($file)->name($nama)->save();
      }

      if($this->fullimage)
      {
        $file = $this->fullimage->getRealPath();

        $fullimage = 'imgs/mobs/'.str_slug(strtolower(request('name'))).'-'.rand(00000,99999).'.png';

        $save = (new Image)->file($file)->name($fullimage)->save();
      }

      $note = null;

      if(! is_null($this->monster) || ! is_null($this->npc)) {
        $note = [
          'monster' => $this->monster ?? null,
          'npc'     => $this->npc ?? null,
        ];
      }

      $dropType->drop()->create([
      	'name'		=> $this->name,
        'name_en'	=> $this->name_en ?? $this->name,
        'proses'	=> null,
        'sell'		=> null,
        'note'		=> $note,
        'picture'	=> $nama ?? null,
        'fullimage'	=> $fullimage ?? null,
        'released'  => $this->released
      ]);

      $this->resetForm();
      $this->emit('success', 1);
    }

    public function resetForm()
    {
      $this->name = null;
      $this->name_en = null;
      $this->tipe = 1;
      $this->monster = null;
      $this->npc = null;
      $this->picture = null;
      $this->fullimage = null;
      $this->released = null;
    }
}
