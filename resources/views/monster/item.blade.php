@extends('layouts.tabler')

@section('title', 'Toram ' . $item->name)
@section('description', $item->name . '')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">{{ $item->name }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">

        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">

            <dl>
              <dt>
              <b class="h6"> <img src="{{$item->dropType->url}}" class="avatar avatar-sm mr-3"> <a href="/monster/{{$item->id}}" class="text-primary">{{ $item->name }}</a></b>
              </dt>
              <dd>
                @if(!is_null($item->picture))
                <img src="/{{$item->picture}}" class="rounded my-2">
                @endif

                @parsedown(e($item->note))
              </dd>
            </dl>
            <div class="my-5"></div>
            <hr class="mb-3">
            <dl> <!-- dl start -->
          @foreach ($data as $mons)

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
               <span class="text-muted">Element: {{$mons->element->name}}</span>
             </dd>
             <b>Drop:</b><br>
             @foreach ($mons->drops as $drop)
             <a href="/item/{{$drop->id}}"> <img src="{{$drop->dropType->url}}" alt="" class="avatar avatar-sm"> {{$drop->name}} </a> <small class="text-muted">({{ $drop->proses ?? '-' }}pts / {{$drop->sell ?? '-'}}s)</small> <br>
             @endforeach
            </div>
          @endforeach
          </dl> <!-- // dl end -->
          </div>
        </div>

        <div class="my-5">
        {{ $data->links() }}
        </div>

      </div>
    </div>
  </div>
</div>
@endsection