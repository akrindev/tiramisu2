@extends('layouts.tabler')

@section('title','Toram Avatar list')
@section('description','Toram Online Avatar list')
@section('image',to_img())



@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Avatar Lists </h1>
    </div>

      <div class="row mb-5">
          <div class="col-md-6">
                <div class="dropdown">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
     <i class="fe fe-shopping-bag mr-2"></i>Show
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="/avatar">Avatar</a>
    <a class="dropdown-item" href="/avatar/all">Avatar List</a>
  </div>
</div>
          </div>
      </div>


      <div class="row row-cards row-deck">
          @foreach(App\Avatar::latest()->paginate(12) as $avatar)
              <div class="col-md-4">
                <div class="card">
                  <a href="/avatar/{{ $avatar->id }}"><img class="card-img-top" src="{{ $avatar->cover }}" alt="{{ $avatar->title }}"></a>
                  <div class="card-body d-flex flex-column">
                    <h4><a href="/avatar/{{ $avatar->id }}"> {{ $avatar->title }} </a> <span class="text-muted small"> <i class="ml-2 fe fe-image"></i> {{ $avatar->lists->count() }}</span></h4>
                      @if(auth()->check() && auth()->user()->isAdmin())
                      <a href="/avatar/edit/{{ $avatar->id }}">edit</a>
                      @endif

                  </div>
                </div>
              </div>
          @endforeach
      </div>
      <div class="row">
          <div class="col-md-12">
          	{{ App\Avatar::latest()->paginate(12)->links() }}
          </div>
      </div>

  </div>
</div>
@endsection
