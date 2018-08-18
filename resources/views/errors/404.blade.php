@extends('layouts.tabler')

@section('title','Halaman tidak di temukan')

@section('content')
<div class="page-content mt-5">
       <div class="container text-center">
          <div class="display-1 text-muted mb-5"><i class="si si-exclamation"></i> 404</div>
          <h1 class="h2 mb-3">Oops.. Halaman tidak di temukan</h1>
          <p class="h4 text-muted font-weight-normal mb-7">Periksa kembali alamat halaman&hellip;</p>
          <a class="btn btn-outline-primary" href="/">
            <i class="fe fe-arrow-left"></i>
            Go home
          </a>
        </div>
  </div>
@endsection