@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();
$randartikel = DB::table('forums')->inRandomOrder()->take(5)->get();

@endphp
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.1&appId=2002599206670692&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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

<div class="my-5">
<div class="fb-page" data-href="https://www.facebook.com/memetoid/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/memetoid/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/memetoid/">Meme Toram Online Indonesia</a></blockquote></div>
</div>