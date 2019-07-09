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
        <div class="card-body p-3" style="font-size:13px;font-weight:400">
          @parsedown(e($data->body))
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection