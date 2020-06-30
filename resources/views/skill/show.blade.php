@extends('layouts.tabler')

@section('title', 'Toram ' . $name)
@section('description', 'Informasi skill '. $name .' toram online full skill list')
@section('image', to_img())

@push('canonical')
	@canonical
@endpush

@section('content')

<style>

  .body-text p, div.body-text {
     -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size:14px;
    font-family:'Source Sans Pro';
    font-weight:400;
  }
  .body-text > ul{
    margin: 0 0 0 0px;
    padding 0;
    list-style-type: circle;
  }
  .body-text > ol > li, .body-text > ul > li{
    position: relative;
    margin: 0;
    padding: 2px;
  }

  summary{
    padding:-8px;
    font-size:14px;
    z-index:1;
    cursor:pointer;
    font-weight:bold
  }
  details{
    border:1px solid #467fcf;
    margin:0;
    font-size:12.5px;
    text-align:left;
    z-index:3;
    padding:8px;
    border-radius:5px;
  }

  details > table {
    margin-top:5px;
  }
  details > table > tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.02);
  }

  details > table > tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.04);
  }


  details[open]{
    animation:det .6s
  }

  @keyframes det{
    0%{
      opacity:0
    50%{
      opacity:0.5
    }
    100%{
      opacity:1
    }
  }
</style>
<div class="my-5">
  <div class="container">

  <div class="page-header">
    <h3 class="page-title">Toram {{ $name }}</h3>
  </div>


  <div class="row">
    <div class="col-md-8">

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')

    @foreach(collect($skills->child)->sortBy('level') as $skill)

      <div class="card">
      <div class="card-body text-wrap p-3" style="font-size:14px;font-weight:400">

        <img src="{{ $skill->picture }}" alt="{{ $skill->name }}" class="avatar avatar-md float-left mr-4 avatar-blue"> <a href="/skill/child/{{ $skill->id }}"> <b> {{ $skill->name }} </b></a><br>
        <small class="text-muted">
        Skill level {{ $skill->level }}  <a href="/skill/child/{{ $skill->id }}" class="text-right ml-5"> <i class="fe fe-message-square"></i> {{ $skill->comment->count() }} diskusi </a>
        </small>
        @if(auth()->check() && auth()->user()->isAdmin())

        <a href="/skill/e/{{ $skill->id }}/edit" class="btn btn-sm btn-secondary float-right">edit</a>
        @endif
        <hr class="my-2">

        <div class="row">
          @if(!is_null($skill->for) && !is_numeric($skill->for))
          <div class="col-12 mb-3">
            @foreach(explode(',', $skill->for) as $for)
            <span class="image">
            <img src="/img/skill/ico/{{ $for }}.png">
            </span>
            @endforeach

          </div>
          @endif
          <div class="col-6 col-sm-3">
          <strong>Type: </strong> <span class="text-muted">{{ $skill->type }}</span>
          </div>

          @if(!is_null($skill->mp))
          <div class="col-6 col-sm-3">
          <strong>MP Cost:</strong> <span class="text-muted"> {{ $skill->mp }} </span>
          </div>
          @endif

          @if(!is_null($skill->element))
          <div class="col-6 col-sm-3">
          <strong>Unsur:</strong> <span class="text-muted">{{ $skill->element->name }}</span>
          </div>
          @endif

          @if(!is_null($skill->range))
          <div class="col-6 col-sm-3">
          <strong>Jarak:</strong> <span class="text-muted">{{ $skill->range }}m</span>
          </div>
          @endif
        </div>

        @if($skill->combo_awal != 0 && $skill->combo_tengah != 0)
        <div class="row">
          <div class="col-6 col-sm-3">
          <strong>Combo Awal:</strong> <span class="text-muted"> {{ $skill->combo_awal == 1 ? 'ya' : 'tidak' }} </span>
          </div>
          <div class="col-6 col-sm-3">
          <strong>Combo Tengah:</strong> <span class="text-muted"> {{ $skill->combo_tengah == 1 ? 'ya' : 'tidak' }} </span>
          </div>
        </div>
        @endif

        <hr class="my-2">
        <div class="mt-1">
        <strong style="font-size:15px;display:inline;border-bottom:1px solid #00f;color:#00a">Deskripsi:</strong> <br>
          <div class="body-text">
            {{ toHtml($skill->description, true) }}
          </div>
        </div>
      </div>
    </div>
    @endforeach
    </div>

    @include('inc.menu_skill')
  </div>
  </div>
</div>

@endsection