@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();
$randartikel = DB::table('forums')->where('deleted_at', null)->inRandomOrder()->take(5)->get();

@endphp
<div class="d-block">
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

    @includeWhen(env('APP_ENV') == 'production', 'inc.ads_matched')

</div>