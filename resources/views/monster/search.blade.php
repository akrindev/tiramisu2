@extends('layouts.tabler')

@section('title', 'Hasil pencarian: ' . $q)
@section('image', to_img())

@section('content')
    <div class="my-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Hasil pencarian: {{ $q }}</h1>
            </div>

            <div class="row">

                @includeUnless(app()->isLocal(), 'inc.ads_mobile')

                <livewire:search-form :q="$q" />
                <livewire:search :q="$q" />

                <div class="col-md-4">
                    @include('inc.menu')
                </div>
            </div>
        </div>

    </div>
@endsection

@section('head')
    @livewireStyles
@endsection

@section('footer')
    @livewireScripts
@endsection
