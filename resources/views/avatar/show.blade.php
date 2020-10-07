@extends('layouts.tabler')

@section('title', $avatar->title . ' Avatar list')
@section('description','Toram Online Avatar list ' . $avatar->title)
@section('image',to_img())

@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> {{ $avatar->title }} </h1>
    </div>


      <div class="row row-cards row-deck">


          <div class="col-12">
          <div class="my-5 p5">
              <a href="/avatar" class="btn btn-outline-primary btn-pill"> Go back </a>
          </div>
              <div class="card">

                  <a href="/avatar/{{ $avatar->id }}"><img class="card-img-top" src="{{ $avatar->cover }}" alt="{{ $avatar->title }}"></a>
                  <div class="card-body d-flex flex-column">
                    <h2 class="text-center"><a href="/avatar/{{ $avatar->id }}"> {{ $avatar->title }} </a></h2>
                  </div>

              </div>
          </div>
          <div class="my-5">
        	@includeUnless(app()->isLocal(), 'inc.ads_article')
          </div>
          @foreach($avatar->lists as $list)
              <div class="col-md-6">
                <div class="card">
                  <a href="#"><img class="card-img-top" src="{{ $list->image }}" alt="{{ $list->title }}"></a>
                  <div class="card-body d-flex flex-column p-3">
                    <h4>@switch($list->type)
                        	@case(1)
                        		<img src="/img/ava_top.png" class="avatar avatar-sm mr-2"/>
                        		@break
                        	@case(2)
                        <img src="/img/ava_bottom.png" class="avatar avatar-sm mr-2"/>
                        		@break
                        	@case(3)
                        <img src="/img/ava_add.png" class="avatar avatar-sm mr-2"/>
                        		@break
                        @endswitch

                        <a href="/avatar/{{ $list->id }}"> {{ $list->title }} </a></h4>
                      <div>
                      <span>@switch($list->rate)
                          		@case(1)
                          			⭐
                          			@break
                          		@case(2)
                          			⭐⭐
                          			@break
                          		@case(3)
                          			⭐⭐⭐
                          			@break
                          		@case(4)
                          			⭐⭐⭐⭐
                          			@break
                          		@default
                          			⭐

                            @endswitch

                          </span><span class="ml-2">{{ $list->value }}%</span></div>
                      @if(auth()->check() && auth()->user()->isAdmin())
                      <a href="/avatar/edit/list/{{ $list->id }}">edit</a>
                      @endif

                  </div>
                </div>
              </div>
          @endforeach
      </div>

  </div>
</div>
@endsection