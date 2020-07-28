@extends('layouts.tabler')


@section('title','Tentang Kami')
@section('description', $data->body)
@section('image',to_img())

@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Tentang Kami</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-body body-text p-3">
          {{ toHtml($data->body) }}
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')
<link href="/assets/css/read.css" rel="stylesheet"/>
@endsection