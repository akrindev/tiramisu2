@extends('layouts.tabler')

@section('title', 'Toram ' . $item->name)
@section('description', $item->name . '')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram {{ $item->name }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
        @include('inc.cari')
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">

            <dl>
              <dt>
              <b class="h5"> <img src="{{$item->dropType->url}}" class="avatar avatar-sm mr-2"> <a href="/item/{{$item->id}}" class="text-primary">{{ $item->name }}</a></b>
                @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif
                <br>
              </dt>
              <dd>
                @if(!is_null($item->picture))
                <img src="/{{$item->picture}}" class="rounded my-2">
                @endif
                <div class="my-2" style="font-size:12px;font-weight:350">
                @parsedown(e($item->note))
                </div>

                <div class="mt-3">
                <b>Peta: </b> <a href="/peta/{{$item->monsters[0]->map->id ?? '#'}}">{{ $item->monsters[0]->map->name ??'-' }}</a>
        @if($item->resep->count() > 0)
                  <br><br>
              <strong>Resep</strong><br>
                  @foreach($item->resep as $resep)
                  <b>Fee:</b> {{ $resep->fee ?? '-' }}s <span class="ml-5"></span>
                  <b>Level:</b> {{ $resep->level ?? '-' }} <br>
                  <b>diff:</b> {{ $resep->diff ?? '-' }} <span class="ml-5"></span>
                  <b>Set:</b> {{ $resep->set ?? '-'}}pcs <br><br>
                    @foreach (explode(',',$resep->material) as $mat)
          @php $x = $loop->index;
               $y = $x@endphp
        @if(is_null(App\Drop::find($mat)))
          @php $x = $loop->index+1;
               $y = $loop->index-1;
          @endphp
        @else
             Bahan {{ $y == 0 ? 1: $y }}: <img src="{{ App\Drop::find($mat)->dropType->url }}" class="avatar avatar-sm" style="max-width:16px;max-height:16px"> <a href="/item/{{ App\Drop::find($mat)->id }}"> {{ App\Drop::find($mat)->name }}</a> x{{ explode(',',$resep->jumlah)[$x] }}<br>
        @endif
                    @endforeach
                  @endforeach
         @endif
                </div>
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