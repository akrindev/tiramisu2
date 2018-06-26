@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();

@endphp
<div class="d-none d-sm-block">
<table class="table card-table">
  @if (count($tags) > 0)
  	@foreach ($tags as $tag)
  @php

$color = ['success','warning','primary','danger','secondary'];
$rand = array_rand($color,2);
$i = $color[$rand[0]];

  @endphp
  <tr>
    <td>{{ $tag->name}} </td>
    <td class="text-right"><span class="badge badge-{{$i}}">{{ rand(00,99) }}</span></td>
  </tr>
  	@endforeach
  @else
  <p>Belum ada tags</p>
  @endif
</table>
</div>

<div class="d-block d-sm-none">
  <div class="card-body">
    @foreach ($tags as $tag)
@php
$color = ['blue','azure','indigo','purple','success','warning','primary','danger','secondary'];
$rand = array_rand($color,2);
$i = $color[$rand[0]];
    @endphp

    <a href="#" class="tag tag-{{$i}}">{{$tag->name}}</a>
    @endforeach
   </div>
</div>