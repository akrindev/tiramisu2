@extends('layouts.tabler')

@section('title', 'Toram '. $q )
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram {{ $q }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
      @include('inc.cari')
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">

          @if($drops->count() > 0)
            @foreach($drops as $item)
            <div class="mb-5">
              <img src="{{ $item->dropType->url }}" alt="{{ $item->dropType->name }}" class="avatar avatar-sm mr-1" style="max-width:21px;max-height:21px">
              <b class="h6"><a class="text-primary" href="/item/{{ $item->id }}">{{ $item->name }}</a></b>
           @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif

            @if(! is_null($item->note))
              <div class="my-1 ml-5" style="font-size:11px;font-weight:350">
                @parsedown(nl2br(e($item->note)))
              </div>
            @endif
            </div>
            @endforeach
          @endif


          @if($monsters->count() > 0)
            <div class="mt-5"></div>

            <dl> <!-- dl start -->
          @foreach ($monsters as $mons)

           <div class="mb-5">
           <dt class="mb-1">
           <b class="h6"> <a class="text-primary" href="/monster/{{$mons->id}}">{{ $mons->name }} (Lv {{$mons->level}})
             @switch($mons->type)
             @case(1)
               [Normal monster]
               @break
             @case(2)
               [Mini boss]
               @break
             @case(3)
               [Boss]
          @endswitch
             </a> </b>
           </dt>
             <dd>
               <span class="text-muted">Element: {{$mons->element->name}}</span> <br>
               <b>Peta: </b> <a href="/peta/{{ $mons->map->id }}">{{ $mons->map->name }}</a>
             </dd>
            </div>
             @endforeach
          </dl> <!-- // dl end -->
          @endif
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
@endsection