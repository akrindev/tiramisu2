@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();
$randartikel = DB::table('forums')->inRandomOrder()->take(5)->get();

@endphp
<div class="d-none d-sm-block">

  @if (count($tags) > 0)

<ul class="list-group list-group-flush">
  	@foreach ($tags as $tag)
  @php

$color = ['success','warning','primary','danger','secondary'];
$rand = array_rand($color,2);
$i = $color[$rand[0]];
  @endphp
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

<hr class="m-0 p-0">
<div class="p-3">
@foreach ($randartikel as $artikel)

<i class="fe fe-plus"></i> <a href="/forum/{{$artikel->slug}}">{{ $artikel->judul }}</a> <small class="text-muted">({{ time_ago($artikel->created_at) }}) </small>
  <br>

@endforeach
</div>