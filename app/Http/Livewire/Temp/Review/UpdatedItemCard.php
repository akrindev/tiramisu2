<?php

namespace App\Http\Livewire\Temp\Review;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

use Livewire\Component;
use App\User;
use App\Drop;
use App\TempDrop;
use App\Contribution;

class UpdatedItemCard extends Component
{
    public $item;

    public $name;
    public $name_en;
    public $monster;
    public $npc;
    public $picture;
    public $fullimage;
    public $withpic;

    public function mount($item)
    {
        $this->item = $item;
        $this->name = $item->name;
        $this->name_en = $item->name_en;
        $this->monster = $item->note['monster'] ?? null;
        $this->npc = $item->note['npc'] ?? null;
        $this->picture = $item->picture;
        $this->fullimage = $item->fullimage;
        $this->withpic = false;
    }

    public function accept()
    {
        $rename = Str::slug($this->name.\str_random(5)) . '.png';
        $renameFull = Str::slug($this->name.\str_random(5)) . '.png';

        $temp = TempDrop::findOrFail($this->item->id);
        $drop = Drop::findOrFail($temp->drop->id);
        $drop->name = $this->name;
        $drop->name_en = $this->name_en;
        $drop->drop_type_id = $this->item->drop_type_id;

        if(! is_null($this->monster) || ! is_null($this->npc)) {

            $drop->note = [
                'monster' => $this->monster,
                'npc'   => $this->npc
            ];
        }

        if($this->withpic === 'true') {

            if($this->picture) {

                (new Filesystem)->move(\public_path($this->picture), \public_path('imgs/mobs/'.$rename));

                $drop->picture = 'imgs/mobs/'.$rename;
                $temp->picture = 'imgs/mobs/'.$rename;
            }

            if($this->fullimage) {

                (new Filesystem)->move(\public_path($this->fullimage), \public_path('imgs/mobs/'.$renameFull));

                $drop->fullimage = 'imgs/mobs/'.$renameFull;
                $temp->fullimage = 'imgs/mobs/'.$renameFull;
            }
        }

        $drop->save();

        $temp->approved = 1;
        $temp->save();

        if(! \is_null($this->item->user_id)) {
            tap(Contribution::updateOrCreate([ 'user_id' => $this->item->user_id ]), function ($contribution) {
				$contribution->increment('point');
			});
        }

        $this->emitUp('done', 'updated');
    }

    public function declined()
    {
        $temp = TempDrop::findOrFail($this->item->id);
        $temp->approved = 2;

        if(! $temp->user_id && $temp->picture) {

            (new Filesystem)->delete(\public_path($temp->picture));

            $temp->picture = null;
        }

        $temp->save();

        $this->emitUp('done', 'declined');
    }

    public function render()
    {
        return view('livewire.temp.review.updated-item-card');
    }
}