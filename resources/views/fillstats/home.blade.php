@extends('layouts.tabler')


@section('title','Toram Fillstats Formula +16 +17 +18 full list')
@section('description','Toram Fillstats Formula full list, Armor, senjata +17, +18, dst')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">
  <div class="container">
     @include('inc.cari')
    <div class="row">
      <div class="col-12">
                <div class="alert alert-info">
                  <b>New!!</b> Fill stats calculator <a href="/fill_stats/calculator">Klik disini</a>
                </div>
              </div>
      <div class="col-12 my-5">
 @foreach($fills as $fo)
         <a href="/fill_stats/{{ $fo->type == 1 ? 'Armor':'Weapon'  }}/{{ $fo->plus }}" class="btn btn-sm btn-pill btn-secondary" onclick="event.preventDefault();document.getElementById('{{ $fo->type == 1 ? 'armor':'weapon'  }}{{ "+$fo->plus" }}').scrollIntoView();">
                  {{ $fo->type == 1 ? 'Armor':'Weapon'  }}{{ " (+$fo->plus)" }}</a>
 @endforeach

        <div class="m-3 text-center">
          <small class="text-muted">Terdapat {{ $data->count() }} formula </small>
        </div>
       </div>
      <div id="filload" class="col-12 text-center">
        <span class="h1 text-center">
      	<i class="fa fa-spinner fa-spin"></i> loading...
        </span>
      </div>
      <div id="filler" class="d-none">
  @foreach($fills as $fl)
      <div class="col-12">
        <h1 class="page-title" id="{{ $fl->type == 1 ? 'armor':'weapon'  }}{{ "+$fl->plus" }}">
          {{ $fl->type == 1 ? 'Armor':'Weapon'  }}{{ " (+$fl->plus)" }}
        </h1>
      </div>

   	@foreach($data as $pos)
         @if($pos->type == $fl->type && $pos->plus == $fl->plus)
              <div class="col-md-6 col-xl-4">
                <div class="card card-collapsed">
                  <div class="card-status card-status-left bg-blue"></div>
                  <div class="card-header">
                    <h6 class="card-title">{{ e($pos->stats) }}</h6>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>

                    </div>
                  </div>
                  <div class="card-body">
                 {!! nl2br(e($pos->steps)) !!}
                  </div>

			@if(Auth::check() && Auth::user()->isAdmin())
                  <div class="card-footer">
                    <a href="/edit/{{ $pos->id }}/fillstats" class="btn btn-primary">edit</a>
                  </div>
            @endif

                </div>
              </div>
           @if($loop->index % 7 === 0)
              <div class="col-md-6 col-xl-4">
                @includeWhen(!app()->isLocal(), 'inc.ads_mobile')
              </div>
           @endif
    	 @endif
	@endforeach

   @endforeach
    </div>
    </div>
  </div>
</div>

@endsection

@section('head')
<script>
  $('#filler').ready(function() {
 	$("#filload").remove();
    $("#filler").removeClass('d-none');
  });
</script>
@endsection