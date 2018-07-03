<?php

if( ! function_exists('to_img'))
{
  function to_img($text = null)
  {
    if(preg_match('/!\[(.*?)][(]\s*+((?:[^ ()]++|[(][^ )]+[)])++)(?:[ ]+("[^"]*"|\'[^\']*\'))?\s*[)]/', $text, $matches))
    {
      return end($matches);
    }

    return url('/img/potum.gif');
  }
}