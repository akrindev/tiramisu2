@extends('layouts.tabler')

@section('content')
        <div class="my-3 my-md-5">
          <div class="container">
  @include('inc.cari')
            <div class="row">

              <!-- loop -->
@php

 $fill = DB::table('fill_stats')->select('type','plus')->distinct()->get();
  $fills = collect($fill)->sortBy('plus')->sortBy('type');

@endphp

              <div class="col-12 mb-6">
 @foreach($fills as $fo)
                <a href="/fill_stats/{{ $fo->type == 1 ? 'Armor':'Weapon'  }}/{{ $fo->plus }}" class="btn btn-sm btn-pill btn-secondary">
                  {{ $fo->type == 1 ? 'Armor':'Weapon'  }}{{ " (+$fo->plus)" }}</a>
 @endforeach
              </div>

  @foreach($fills as $fl)
              <div class="col-12">
              <h1 class="page-title">
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
                 {!! nl2br((new Parsedown)->text(e($pos->steps))) !!}
                  </div>

@if(Auth::check() && Auth::user()->role == 'admin')
                  <div class="card-footer">
                    <a href="/edit/{{ $pos->id }}/fillstats" class="btn btn-primary">edit</a>
                  </div>
 @endif

                </div>
              </div>
    @endif
@endforeach


   @endforeach

              <!-- yeyy -->
            </div>
          </div>
</div>

@endsection