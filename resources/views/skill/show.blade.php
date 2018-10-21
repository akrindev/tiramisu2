@extends('layouts.tabler')

@section('title', 'Toram ' . $name)
@section('description', 'Informasi skill '. $name .' toram online full skill list')
@section('image', to_img())

@section('content')

<div class="my-5">
  <div class="container">

  <div class="page-header">
    <h3 class="page-title">Toram Skill {{ $name }}</h3>
  </div>


  <div class="row">
    <div class="col-md-8">
    @foreach($skills->child as $skill)
      <div class="card">
      <div class="card-body p-3" style="font-size:14px;font-weight:400">

        <img src="{{ $skill->picture }}" alt="{{ $skill->name }}" class="avatar avatar-md float-left mr-4 avatar-blue"> <a href="/skill/{{ str_replace(' ', '-',$name) }}/{{ $skill->name }}"> <b> {{ $skill->name }} </b></a><br>
        <small class="text-muted">
        Skill level {{ $skill->level }}
        </small>
        @if(auth()->check() && auth()->user()->isAdmin())
        {!! form_open('/skill/edit') !!}
        @csrf
        @method('post')
        <input type="hidden" name="id" value="{{ $skill->id }}">
        <button type="submit" class="btn btn-sm btn-secondary float-right">edit</button>
        {!! form_close() !!}
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

        <div class="mt-5">
        <strong>Deskripsi:</strong> <br>
          <div class="text-muted">
            @parsedown($skill->description)
          </div>
        </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>
  </div>
</div>

@endsection