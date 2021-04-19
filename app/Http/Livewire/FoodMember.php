<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class FoodMember extends Component
{
    use WithPagination;

    //public $foods;

    public $buff = "all";
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // $this->foods = $this->showFoods();
    }

    public function updatingBuff()
    {
        $this->resetPage();
    }

    public function render()
    {
        $foods = $this->showFoods();

        return view('livewire.food-member', \compact('foods'));
    }

    protected function showFoods()
    {
        $buff = $this->buff == "all" ? "*" : \App\Cooking::findOrFail($this->buff)->id;

        $foods = User::with('cooking', 'secondCooking','contact')
             ->select('id', 'name', 'ign', 'biodata', 'cooking_id', 'cooking_level', 'second_cooking_id', 'second_cooking_level')
             ->where('visibility', 1)
             ->whereNotNull('cooking_id')
             ->when($buff != '*', function ($q) use ($buff) {
                return $q->where('cooking_id', $buff)->orWhere('second_cooking_id', $buff);
            })
            ->orderBy('updated_at', 'desc')->paginate(12);

        $foods->map(function ($food) {
            $food->buff = $this->getStatLv($food->cooking->buff, $food->cooking->stat, $food->cooking_level, true);
            $food->second_buff = $food->secondCooking == null ? "-- unknown --" : $this->getStatLv($food->secondCooking->buff, $food->secondCooking->stat, $food->second_cooking_level, true);

            if(! $food->contact) {
                $food->hubungi =  "-- unknown --";
                return $food;
              }

              $line = $food->contact->line != null ?
                '<a href="//line.me/ti/p/~'.$food->contact->line .'" class="mr-2 btn btn-outline-success btn-sm"><i class="mr-1 fa fa-commenting-o"></i> line</a>' : '';
              $wa =  $food->contact->whatsapp != null ?
                '<a href="//wa.me/'.$food->contact->whatsapp.'" class="mr-2 btn btn-success btn-sm"><i class="mr-1 fa fa-whatsapp"></i> whatsapp</a>' : '';
              $fb = $food->contact->facebook != null ?
              '<a href="'. $food->contact->facebook .'" class="mr-2 btn btn-primary btn-sm"><i class="mr-1 fa fa-facebook"></i> facebook</a>' : '';
              $tw = $food->contact->twitter != null ?
              '<a href="'. $food->contact->twitter .'"class="btn btn-outline-primary btn-sm"><i class="mr-1 fa fa-twitter"></i> twitter</a>' : '';

            $food->hubungi =  new HtmlString($wa . $line .$fb . $tw);

            return $food;
        });

        return $foods;
    }

    public function getStatLv($buff, $stat, $lv, $parse = false) {
        $out = 0;
        for($i = 1;$i <= $lv;$i++){
          if($i <= 5) {
            $out += $stat;
          } else {
            $out = $out+$this->getPoint($stat);
          }
        }

        if($parse) {
            return $this->parse($buff, $out);
        }

        return $out;
      }


      private function getPoint($stat){

        $out = $stat;

        switch($stat) {
          case 2:
            $out = 4;
            break;
          case 4:
            $out = 6;
            break;
          case 6:
            $out = 14;
            break;
          case 60:
            $out = 140;
            break;
          case 400:
            $out = 600;
            break;
          case 20:
            $out = 40;
            break;
          default:
            $out = 2;
        }

        return $out;
      }

      private function parse($buff, $out)
      {
        if(Str::contains($buff, '%')) {
          $replaced = Str::replaceLast('%', '', $buff);

          return $replaced . ' ' . $out . '%';
        }

        return $buff . ' ' . $out;
      }
}
