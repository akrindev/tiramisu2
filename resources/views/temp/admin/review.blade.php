@extends('layouts.sb-admin')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Review data contributions</h1>
  </div>

  <div class="row">
      <div class="col-md-4 mb-5">
          @livewire('temp.review')
      </div>

      <div class="col-md-8">
          @livewire('temp.review-component')
      </div>
  </div>
</div>
@endsection


@section('head')
    @livewireStyles
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />

<link rel="stylesheet" type="text/css" href="/assets/css/selectize.css">
@endsection

@section('footer')
@livewireScripts
<script src="/assets/js/vendors/selectize.min.js"></script>
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
@endsection
