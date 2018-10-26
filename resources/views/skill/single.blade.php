@extends('layouts.tabler')

@section('title', 'Toram skill ' . $name)
@section('description', 'Informasi skill '. $name .' toram online full skill list')
@section('image', to_img())

@section('content')

<div class="my-5">
  <div class="container">

  <div class="page-header">
    <h3 class="page-title">Toram skill {{ $name }}</h3>
  </div>


  <div class="row">
    <div class="col-md-8">

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

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

      @foreach($skill->comment as $comment)
		<div class="card p-0">
          <div class="card-body p-3">
            <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="https://graph.facebook.com/{{$comment->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4 lazyload">
            <b><a href="/profile/{{$comment->user->provider_id }}" data-author="{{ $comment->user->name }}">  {{ $comment->user->name }}</a> </b> <br>
            <small class="text-muted">{{ waktu($comment->created_at) }}</small>
            <hr class="my-2">
            <div class="body-text" style="font-size:14px">
            @parsedown(e($comment->body))

            </div>
            @auth
            <div class="form-group">
              @if(auth()->user()->role == 'admin')
              <button onclick="event.preventDefault(); dcm({{$comment->id}});" class="btn btn-sm btn-pill btn-outline-danger">hapus</button>
              {!! form_open('/forum/delete-comment',['id'=>'cid-'.$comment->id]) !!}
              @csrf
              @method("DELETE")
              <input type="hidden" name="cid" value="{{$comment->id}}">
              {!! form_close() !!}
              @endif
            </div>

            @endauth
          </div>

   		</div>
      @endforeach

      @include('inc.skill_comment')
    </div>

    @include('inc.menu_skill')
  </div>
  </div>
</div>

@endsection