<?php

namespace App\Http\Livewire\Temp\Review;

use Illuminate\Support\Str;
use Livewire\Component;

use App\Monster;
use App\TempMonster;
use App\User;

class NewMonsterCard extends Component
{
    public $monster;

    public $name;
    public $name_en;
    public $type;
    public $mapid;
    public $pet;
    public $level;
    public $hp;
    public $xp;
    public $drops;
    public $element;
    public $picture;

    public function mount($monster)
    {
        $this->monster = $monster;
        $this->name     = $monster->name;
        $this->name_en  = $monster->name_en;
        $this->type     = $monster->type;
        $this->mapid    = $monster->map_id;
        $this->pet      = $monster->pet;
        $this->level    = $monster->level;
        $this->hp       = $monster->hp;
        $this->xp       = $monster->xp;
        $this->drops    = $monster->drops;
        $this->element  = $monster->element_id;
        $this->picture  = $monster->picture;
    }

    public function accept()
    {
        $temp = TempMonster::findOrFail($this->monster->id);

        $monster = Monster::create([
            'name'	=> $this->name,
            'name_en'	=> $this->name_en ?? $this->name,
            'map_id'	=> $this->mapid,
            'element_id'	=> $this->element,
            'level'	=> $this->level,
            'type'	=> $this->type,
            'hp'	=> $this->hp,
            'xp'	=> $this->xp,
            'pet'	=> $this->pet ? 'y' : 'n'
        ]);

        $rename = Str::slug($this->name).\str_random(5).'png';

        if ($this->picture) {
            (new Filesystem)->move(\public_path($this->picture), \public_path('imgs/mobs/'.$rename));

            $monster->picture = 'imgs/mobs/'.$rename;
            $monster->save();
        }

        $temp->approved = 1;
        $temp->save();

        if(! is_null($this->monster->user_id)) {
            $user = User::findOrFail($this->monster->user_id);
            $user->contribution->increment('point');
            $user->save();
        }

        $this->emitUp('done');
    }

    public function declined()
    {
        $temp = TempMonster::findOrFail($this->monster->id);
        $temp->approved = 2;
        $temp->save();
    }

    public function render()
    {
        return view('livewire.temp.review.new-monster-card');
    }
}
