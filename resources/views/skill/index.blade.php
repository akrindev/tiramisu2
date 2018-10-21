@extends('layouts.tabler')

@section('title', 'Toram Skill List')
@section('description', 'Informasi skill toram online fill skill list')
@section('image', to_img())

@section('content')

<div class="my-5">
  <div class="container">

  <div class="page-header">
    <h3 class="page-title">Toram Skills</h3>
  </div>


  <div class="row">
    <div class="col-md-8">
    <div class="card">
      <div class="card-body" style="font-size:14px;font-weight:400">

        @foreach($skills->groupBy('type') as $skill => $child)
        <div class="mb-5">
        <h4>{{ ucfirst($skill) }}</h4>

          @foreach($child as $kid)
        <div class="mb-2">
        <img src="{{ $kid->picture }}" alt="{{ $kid->name }}" class="avatar avatar-md mr-4"> <a href="/skill/{{ str_replace(' ', '-',$kid->name) }}"> {{ $kid->name }} </a> </div>


          @endforeach
        </div>

        @endforeach

      </div>
    </div>
    </div>
  </div>
  </div>
</div>

@endsection