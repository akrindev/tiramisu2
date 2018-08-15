@extends('layouts.tabler')


@section('title','Toram database Monsters')

@section('description','Toram database monster, hidden monster dan boss')

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
                  <div class="card-body p-3">


      @foreach ($data as $pos)
                    <b><i class="fe fe-github mr-2"></i></b>
                    <a href="/peta/{{$pos->id}}">{{$pos->name}}</a> <br />
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