@extends('layouts.tabler')

@section('title','Toram Avatar Showcase')
@section('description','Toram Online Avatar Showcase')
@section('image',to_img())

@push('canonical')
	@canonical
@endpush

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
          @foreach(App\AvatarList::with('avatars')->latest()->paginate(12) as $list)
              <div class="col-sm-4">
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
                     <div><a href="/avatar/{{ $list->avatars[0]->id }}"> {{ $list->avatars[0]->title }} </a></div>
                      @if(auth()->check() && auth()->user()->isAdmin())
                      <a href="/avatar/edit/list/{{ $list->id }}">edit</a>
                      @endif

                  </div>
                </div>
              </div>
          @endforeach
      </div>
      <div class="row">
          <div class="col-md-12">
          	{{ App\AvatarList::latest()->paginate(12)->links() }}
          </div>
      </div>

  </div>
</div>
@endsection