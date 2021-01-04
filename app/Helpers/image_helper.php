<?php

if( ! function_exists('to_img'))
{
  function to_img($text = null, $cover = true)
  {
      if($match = preg_match('/!\[(.*?)][(]\s*+((?:[^ ()]++|[(][^ )]+[)])++)(?:[ ]+("[^"]*"|\'[^\']*\'))?\s*[)]/', $text, $matches)) {
        return end($matches);
      }

      return $cover ? url('/img/potum.png') : false;
  }
}
