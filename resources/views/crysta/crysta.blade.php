@extends('layouts.tabler')

@section('content')
        <div class="my-3 my-md-5">
          <div class="container">
  @include('inc.cari')
            <div class="row row-cards">

  @if(count($data) > 0)
      @foreach($data as $pos)
	<div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class='h3 text-primary'><a href="/crysta/{{ $pos->slug }}">{{ $pos->nama }}</a></div>
                      <br />

                    </div>

                    <div class="row">
                      <div class="col-12 mb-6">

                        <h5 class="mb-1">Stats</h5>
                        <div class="text-muted-dark">{{ $pos->stats }}</div>
                      </div>
                      <div class="col-12">
                        <h5 class="mb-1">Type</h5>
                        <div class="text-muted-dark">{{ $pos->type }}</div>
                      </div>
                   <br/>
@auth
     @if(Auth::user()->role == 'admin')
                    <a href="/edit/{{ $pos->id }}/crysta" class="btn btn-primary">edit</a>
     @endif
@endauth

                    </div>
                  </div>

                  </div>
                </div>


      @endforeach
   @endif
              </div>
    </div>

  </div>

@endsection