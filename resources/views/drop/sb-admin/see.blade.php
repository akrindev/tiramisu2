@extends('layouts.sb-admin')

@section('content')
  <livewire:admin.drop-see />
@endsection

@section('head')
    @livewireStyles
@endsection

@section('footer')
    @livewireScripts
@endsection
