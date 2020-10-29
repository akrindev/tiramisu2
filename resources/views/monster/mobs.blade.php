@extends('layouts.tabler')

@section('title', $data->name . ' (Lv '. $data->level .')')
@section('image', !is_null($data->picture) ? '/'.$data->picture : to_img())


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h1 class="page-title">{{ $data->name }}</h1>
  </div>

    <div class="row">
      <div class="col-md-8">
      @include('inc.cari')
      </div>
      <div class="col-md-8">

   @includeUnless(app()->isLocal(), 'inc.ads_article')

        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">

            <dl>
              <dt>
                <b class="h5"><a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/monster/{{$data->id}}" class="text-primary"> {{ $data->name }} (Lv {{ $data->level }})</a>
          @switch($data->type)
             @case(2)
               <img src="/img/f_boss.png" alt="mini boss" style="display:inline;max-width:120px;max-height:15px;">
               @break
             @case(3)
               <img src="/img/boss.png" class="boss" style="display:inline;max-width:120px;max-height:15px;">
          @endswitch
                 </b>
          @if(auth()->check() && auth()->user()->isAdmin())
              <a href="/monster/{{ $data->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
          @endif
              </dt>
              <dd>
                @if(!is_null($data->picture))
                <img src="/{{ $data->picture }}" class="rounded my-4 d-block">
                @endif
                <b>{{ __('Unsur') }}: </b> {{ ucfirst($data->element->name) }} <br>
              <!--  <b>Pet: </b> {{ $data->pet === 'y' ? 'bisa':'tidak' }} <br> -->
                <b>HP:</b> <span class="text-muted">{{ $data->hp ?? '-- unknown --' }} </span><br>
                <b>XP:</b> <span class="text-muted">{{ $data->xp ?? '-- unknown --' }} </span>

              @if($data->type == 3 || $data->type == 2)
                <br>
                <b>Leveling:</b> {{ $data->level-3 }} <span class="text-muted">s/d</span> {{ $data->level+3 }}
              @endif

                <div class="mb-2"></div>
                <b>Peta:</b> <a href="/peta/{{ $data->map->id }}"> {{ $data->map->name }}</a>
                <div class="my-2"></div>

             <b>Drop:</b><br>
             @foreach ($data->drops as $drop)
             <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/item/{{ $drop->id }}"> <img src="{{ $drop->dropType->url }}" class="avatar avatar-sm"> {{ $drop->name }} </a>
           @if ($drop->proses && $drop->sell)
            <small class="text-muted">({{ $drop->proses ?? '-' }}pts / {{$drop->sell ?? '-'}}s)</small>
           @endif
           <br>
             @endforeach

              </dd>
            </dl>

          </div>
        </div>
      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection