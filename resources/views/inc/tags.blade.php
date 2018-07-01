@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();

@endphp
<div class="d-none d-sm-block">
  @if (count($tags) > 0)
  	@foreach ($tags as $tag)
  @php

$color = ['success','warning','primary','danger','secondary'];
$rand = array_rand($color,2);
$i = $color[$rand[0]];
  @endphp


<ul class="list-group list-group-flush">
  <li class="list-group-item">
      <a href="/forum/tag/{{$tag->name}}">{{ $tag->name}} </a>
    <span class="badge badge-{{$i}} float-right">{{ DB::table('forums')->where('tags','like','%'.$tag->name.'%')->whereNull('deleted_at')->count() }}</span>

  </li>
  	@endforeach
  </ul>
  @else
  <p>Belum ada tags</p>
  @endif
</div>

<div class="d-block d-sm-none">
  <div class="card-body">
    @foreach ($tags as $tag)
@php
$color = ['blue','azure','indigo','purple','success','warning','primary','danger','secondary'];
$rand = array_rand($color,2);
$i = $color[$rand[0]];
    @endphp

    <a href="/forum/tag/{{$tag->name}}" class="tag tag-{{$i}}">{{$tag->name}}</a>
    @endforeach
   </div>
</div>