@extends('layouts.webview')

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Menu Perlengkapan &amp; Crysta</h3>
  </div>

    @include('webview.cari')

   @include('inc.wv.menu_eq')
  </div>
</div>
@endsection