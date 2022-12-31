<?php

namespace App\Http\Livewire;

use App\Helpers\Food;
use App\User;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Livewire\WithPagination;

class FoodMember extends Component
{
    use WithPagination;

    //public $foods;

    public $buff = 'all';

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
        $buff = $this->buff == 'all' ? '*' : \App\Cooking::findOrFail($this->buff)->id;

        $foods = User::with('cooking', 'secondCooking', 'contact')
             ->select('id', 'name', 'ign', 'biodata', 'cooking_id', 'cooking_level', 'second_cooking_id', 'second_cooking_level')
             ->where('visibility', 1)
             ->whereNotNull('cooking_id')
             ->when($buff != '*', function ($q) use ($buff) {
                 return $q->where('cooking_id', $buff)->orWhere('second_cooking_id', $buff);
             })
            ->orderBy('updated_at', 'desc')->paginate(12);

        $foods->map(function ($food) {
            $food->buff = (new Food)->getStatLv($food->cooking->buff, $food->cooking->stat, $food->cooking_level, true);
            $food->second_buff = $food->secondCooking == null ? '-- unknown --' : (new Food)->getStatLv($food->secondCooking->buff, $food->secondCooking->stat, $food->second_cooking_level, true);

            if (! $food->contact) {
                $food->hubungi = '-- unknown --';

                return $food;
            }

            $line = $food->contact->line != null ?
              '<a href="//line.me/ti/p/~'.$food->contact->line.'" class="mr-2 btn btn-outline-success btn-sm"><i class="mr-1 fa fa-commenting-o"></i> line</a>' : '';
            $wa = $food->contact->whatsapp != null ?
              '<a href="//wa.me/'.$food->contact->whatsapp.'" class="mr-2 btn btn-success btn-sm"><i class="mr-1 fa fa-whatsapp"></i> whatsapp</a>' : '';
            $fb = $food->contact->facebook != null ?
            '<a href="'.$food->contact->facebook.'" class="mr-2 btn btn-primary btn-sm"><i class="mr-1 fa fa-facebook"></i> facebook</a>' : '';
            $tw = $food->contact->twitter != null ?
            '<a href="'.$food->contact->twitter.'"class="btn btn-outline-primary btn-sm"><i class="mr-1 fa fa-twitter"></i> twitter</a>' : '';

            $food->hubungi = new HtmlString($wa.$line.$fb.$tw);

            return $food;
        });

        return $foods;
    }
}
