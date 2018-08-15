@extends('layouts.tabler')

@section('title', 'Peta ' . $data->name)
@section('description', $data->name . ' adalah peta yang berada di toram')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">{{ $data->name }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">

        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <dl> <!-- dl start -->
          @foreach ($data->monster as $mons)

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

      </div>
    </div>
  </div>
</div>
@endsection