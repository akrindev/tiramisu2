@extends('layouts.tabler')

@section('title', 'Toram Skill List')
@section('description', 'Informasi skill toram online fill skill list')
@section('image', to_img())

@push('canonical')
	@canonical
@endpush

@section('content')

<div class="my-5">
    <div class="container">

        <div class="page-header">
            <h3 class="page-title">Toram Skills</h3>
        </div>


        <div class="row">
            <div class="col-md-12">
                @includeUnless(app()->isLocal(), 'inc.ads_article')
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body p-3" style="font-size:14px;font-weight:400">

                        @foreach($skills->groupBy('type') as $skill => $child)
                        <div class="mb-5">
                        <h4>{{ ucfirst($skill) }}</h4>

                        @foreach($child as $kid)
                        <div class="mb-2">
                        <img src="{{ $kid->picture }}" alt="{{ $kid->name }}" class="avatar avatar-md mr-4"> <a href="/skill/{{ $kid->id }}"> {{ $kid->name }} </a> </div>


                        @endforeach
                        </div>

                        @endforeach

                    </div>
                </div>

                @includeUnless(app()->isLocal(), 'inc.ads_article')
            </div>
            <div class="col-md-4">
                @include('inc.menu')
            </div>
        </div>
    </div>
</div>
@endsection
