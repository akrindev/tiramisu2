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

      {{-- trakteer --}}
      <div class="col-md-4">
          <div class="card">
              <div class="card-header">
                  <h2 class="card-title">Merasa terbantu dengan website ini?</h2>
              </div>
              <div class="card-body">
                  <script type='text/javascript' src='https://cdn.trakteer.id/js/embed/trbtn.min.js'></script><script type='text/javascript'>(function(){var trbtnId=trbtn.init('Dukung Saya di Trakteer','#be1e2d','https://trakteer.id/akrindev/tip','https://cdn.trakteer.id/images/embed/trbtn-icon.png','40');trbtn.draw(trbtnId);})();</script>
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
