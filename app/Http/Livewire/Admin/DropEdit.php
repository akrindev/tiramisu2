<?php

namespace App\Http\Livewire\Admin;

use App\Drop;
use App\DropType;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Helpers\SaveAsImage as Image;

class DropEdit extends Component
{
    use WithFileUploads;

    public $kunci;
    public $name;
    public $name_en;
    public $tipe;
    public $monster;
    public $npc;
    public $picture;
    public $fullimage;
    public $newPicture;
    public $newFullimage;

    protected $listeners = [
        'getData',
        'delete',
        'changeTipe' => 'updatedTipe',
    ];

    public function getData($data)
    {
        $this->kunci = $data['id'];
        $this->name = $data['name'];
        $this->name_en = $data['name_en'];
        $this->tipe = $data['drop_type']['id'];
        $this->monster = optional($data['note'])['monster'];
        $this->npc = optional($data['note'])['npc'];
        $this->picture = $data['picture'];
        $this->fullimage = $data['fullimage'];
    }

    public function cancel()
    {
        $this->emitUp('onCancel', 1);
        $this->resetForm();
    }

    public function delete($value)
    {
        $item = Drop::findOrFail($this->kunci);

        $item->delete();

        $this->emitUp('deleted', 1);
    }

    public function deletePicture()
    {
        $this->picture = null;
    }

    public function deleteFullimage()
    {
        $this->fullimage = null;
    }

    public function save()
    {
        $item = Drop::findOrFail($this->kunci);

        $item->picture = $this->picture;
        $item->fullimage = $this->fullimage;

        if($this->newPicture) {
            $file = $this->newPicture->getRealPath();

            $nama = 'imgs/mobs/'.str_slug(strtolower($this->name)).'-'.rand(00000,99999).'.png';

            $save = (new Image)->file($file)->name($nama)->save();

            $item->picture = $nama;
        }

        if($this->newFullimage) {
            $file = $this->newFullimage->getRealPath();

            $fullimage = 'imgs/mobs/'.str_slug(strtolower($this->name)).'-'.rand(00000,99999).'.png';

            $save = (new Image)->file($file)->name($fullimage)->save();

            $item->fullimage = $fullimage;
        }

        $item->name		= $this->name;
        $item->name_en	= $this->name_en ?? $this->name;
        $item->drop_type_id = $this->tipe;

        if(! is_null($this->monster) || ! is_null($this->npc)) {
            $item->note = [
                'monster' => $this->monster ?? null,
                'npc'     => $this->npc ?? null,
            ];
        }

        $item->save();

        $this->emitUp('saved', 1);
        $this->emit('saved', 1);
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.admin.drop-edit');
    }

    public function updatedTipe($value)
    {
        $this->tipe = $value;
    }

    public function resetForm()
    {
        $this->kunci = null;
        $this->name = null;
        $this->name_en = null;
        $this->tipe = 1;
        $this->monster = null;
        $this->npc = null;
        $this->picture = null;
        $this->fullimage = null;
        $this->newPicture = null;
        $this->newFullimage = null;
    }
}
