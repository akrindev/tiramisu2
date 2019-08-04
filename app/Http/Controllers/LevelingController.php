<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;

class LevelingController extends Controller
{
  // exp gain
  protected $experience;

  // the exp needed to lv up
  protected $exp;

  public function show()
  {
    $lvl = (int) request()->input('level', 50);
    $bonusExp = (int) request()->input('bonusexp', 0);
    $range = (int) request()->input('range', 5);

    $min = $lvl-$range;
    $max = $lvl+$range;

    $expNeed = $this->expNeed($lvl);

    $data = Monster::whereIn('type',[2,3])
        			->whereBetween('level', [$min,$max])
      				->orderByDesc('type')
        			->orderBy('level')
        			->get();

    $data->map(function ($item) use ($lvl, $bonusExp) {
      if(!is_null($item->xp)){
        $exp = $this->exp($lvl, $item->level, $item->xp, $bonusExp);

        $item->xp = number_format($exp);
        $item->persen = $this->percentage($exp).'%';
        $item->defeat = ceil($this->exp/$exp);

        return $item;
      }
    });

    return view('monster.leveling', compact('lvl','data','expNeed'));
  }

  protected function expNeed($lvl)
  {
    $total = pow($lvl,4) / 40 + ($lvl + $lvl);

    $this->exp = $total;

    return $total;
  }

  protected function exp($lvl, $mobsLv, $mobsExp, $bonusExp)
  {
    $exp = $this->diffLevelExp($lvl, $mobsLv, $mobsExp)*$this->bonusExp($bonusExp);

    $total = $this->experience + $exp;

    return intval($total);
  }

  protected function percentage($expMob)
  {
    $total = ($expMob/$this->exp)*100;

    return number_format($total,2);
  }

  protected function diffLevelExp($lvl, $mobsLv, $mobsExp)
  {
    $diff = abs($mobsLv - $lvl);

    switch($diff){
      case 0:
      case 1:
      case 2:
      case 3:
      case 4:
      case 5:
        $multiplier = 11;
        break;
      case 6:
        $multiplier = 10;
        break;
      case 7:
        $multiplier = 9;
        break;
      case 8:
        $multiplier = 7;
        break;
      default:
        $multiplier = 3;
    }

    $total = $mobsExp*$multiplier;

    $this->experience = $total;

    return $total;
  }

  protected function bonusExp($expBonus = 0)
  {
    $total = $expBonus/100;

    return $total;
  }
}