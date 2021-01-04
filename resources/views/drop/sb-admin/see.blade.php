@extends('layouts.sb-admin')

@section('content')
  <livewire:admin.drop-see />
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
