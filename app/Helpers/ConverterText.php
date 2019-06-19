<?php

namespace App\Helpers;

use Illuminate\Support\HtmlString;

class ConverterText
{
  // text tobe convert
  private $in = [
  	'#\[details=(.*)\](.*)\[/details\]#Usi',
  	'#\[spoiler=(.*)\](.*)\[/spoiler\]#Usi'
  ];

  // converted to
  private $out = [
  	'<details><summary class="text-danger">$1</summary>$2</details>',
  	'<details><summary><span class="btn btn-sm btn-outline-primary mr-2">spoiler</span> $1 </summary><p>$2</p></details>'
  ];

  /*
  * convert to html
  */
  public function text($text, $nl2br = false)
  {
    $text = e($text);

    if($nl2br) {
      $text = nl2br($text);
    }

    $markdowned = parsedown($text);

    $out = $this->parse($markdowned);

    return new HtmlString($out);
  }

  private function parse($text)
  {
    $in = count($this->in)-1;

    for($i = 0;$i <= $in;$i++) {
      $text = preg_replace($this->in[$i], $this->out[$i],$text);
    }

    return $text;
  }
}