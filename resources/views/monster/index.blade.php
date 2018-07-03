@extends('layouts.tabler')


@section('title','Toram list Monsters')

@section('description','Toram database monster, dan hidden monster dan boss')

@section('image',to_img())

@section('content')
        <div class="my-3 my-md-5">
          <div class="container">
    @include('inc.cari')
            <div class="row row-cards">
                     <!-- loop -->

  @if(count($data) > 0)

	<div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      Monster pada peta
                    </h3>
                  </div>
                  <div class="card-body">


      @foreach ($data as $pos)
                    <b><i class="fe fe-github"></i></b>
                    <a href="/peta/{{$pos->mapslug}}">{{$pos->map}}</a> <br />
     @endforeach

                  <div>
                    </div>
                  </div>

                  </div>
                </div>

   @endif

              </div>
    </div>

  </div>
@endsection