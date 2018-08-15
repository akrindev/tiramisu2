@extends('layouts.tabler')

@section('title', 'Toram '. $data->name)
@section('image', $data->picture ?? url('/img/potum.gif'))

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h1 class="page-title">{{$data->name}}</h1>
  </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">

            <dl>
              <dt>
                <b class="h5"><a href="/monster/{{$data->id}}" class="text-primary"> {{ $data->name }} (Lv {{$data->level}})
          @switch($data->type)
             @case(1)
               [Normal monster]
               @break
             @case(2)
               [Mini boss]
               @break
             @case(3)
               [Boss]
          @endswitch
                  </a></b>
              </dt>
              <dd>
                @if(!is_null($data->picture))
                <img src="/{{$data->picture}}" alt="" class="rounded my-4">
                @endif
                <b>Element: </b> {{$data->element->name}} <br>
                <b>Pet: </b> {{ $data->pet === 'y' ? 'bisa':'tidak'}} <br>
                <b>HP:</b> {{ $data->hp ?? '-'}}
                <div class="mb-2"></div>
                <b>Peta:</b> <a href="/peta/{{$data->map->id}}"> {{ $data->map->name }}</a>
                <div class="my-2"></div>

             <b>Drop:</b><br>
             @foreach ($data->drops as $drop)
             <a href="/item/{{$drop->id}}"> <img src="{{$drop->dropType->url}}" alt="" class="avatar avatar-sm"> {{$drop->name}} </a> <small class="text-muted">({{ $drop->proses ?? '-' }}pts / {{$drop->sell ?? '-'}}s)</small> <br>
             @endforeach

              </dd>
            </dl>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection