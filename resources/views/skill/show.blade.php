@extends('layouts.tabler')

@section('title', 'Toram ' . $name)
@section('description', 'Informasi skill '. $name .' toram online full skill list')
@section('image', to_img())

@push('canonical')
	@canonical
@endpush

@section('content')

<div class="my-5">
  <div class="container">

  <div class="page-header">
    <h3 class="page-title">Toram {{ $name }}</h3>
  </div>


  <div class="row">
    @if(!is_null($skills->description))
    <div class="col-md-8">
      <div class="card">
        <div class="card-body text-wrap p-3" style="font-size:14px;font-weight:400">
          <div class="body-text">
            {{ toHtml($skills->description, true) }}
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="col-md-8">

  @includeUnless(app()->isLocal(), 'inc.ads_article')

    @foreach(collect($skills->child)->sortBy('level') as $skill)

      <div class="card" id="child-{{ $skill->id }}">
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

@section('head')

<link href="/assets/css/read.css" rel="stylesheet">
@endsection