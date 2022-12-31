<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Food
{
    public function getStatLv($buff, $stat, $lv, $parse = false)
    {
        $out = 0;
        for ($i = 1; $i <= $lv; $i++) {
            if ($i <= 5) {
                $out += $stat;
            } else {
                $out = $out + $this->getPoint($stat);
            }
        }

        if ($parse) {
            return $this->parse($buff, $out);
        }

        return $out;
    }

      private function getPoint($stat)
      {
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
          if (Str::contains($buff, '%')) {
              $replaced = Str::replaceLast('%', '', $buff);

              return $replaced.' '.$out.'%';
          }

          return $buff.' '.$out;
      }
}
