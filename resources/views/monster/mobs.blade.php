@extends('layouts.tabler')

@section('title', $data->name . ' (Lv ' . $data->level . ')')
@php
    if (app()->isLocale('en')) {
        $monsterDesc = $data->name . ' (Lv ' . $data->level . ') is a monster / boss in Toram Online. Find complete drops, element, map location, and exp info for ' . $data->name . ' at Toram ID.';
    } else {
        $monsterDesc = $data->name . ' (Lv ' . $data->level . ') adalah monster / boss di Toram Online. Temukan info lengkap drop, unsur, lokasi peta, dan exp dari ' . $data->name . ' di Toram ID.';
    }
@endphp
@section('description', $monsterDesc)
@section('image', !is_null($data->picture) ? '/' . $data->picture : to_img())



@section('content')
    <div class="my-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">{{ $data->name }}</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @includeUnless(app()->isLocal(), 'inc.ads_horizontal')
                </div>
                <div class="col-md-8">
                    @include('inc.cari')
                </div>

                <div class="col-md-8">
                    @include('inc.drop.monster', $mons = $data)

                    <div class="card">
                        <div class="card-header p-3">
                            <h2 class="card-title">Related Monsters</h2>
                        </div>

                        <div class="card-body p-3">
                            @foreach ($relateds as $related)
                                <a class="text-primary"
                                    href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/monster/{{ $related->id }}">
                                    {{ $related->name }} (Lv {{ $related->level }})
                                </a>
                                @switch($related->type)
                                    @case(2)
                                        <img src="/img/f_boss.png" alt="mini boss"
                                            style="display:inline;max-width:120px;max-height:15px;">
                                    @break

                                    @case(3)
                                        <img src="/img/boss.png" class="boss"
                                            style="display:inline;max-width:120px;max-height:15px;">
                                    @break
                                @endswitch <br>
                            @endforeach
                        </div>
                    </div>

                    <div class="my-3">
                        @includeUnless(app()->isLocal(), 'inc.ads_mobile')
                    </div>
                </div>
                <div class="col-md-4">
                    @include('inc.menu')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Thing",
        "name": "{{ $data->name }}",
        "description": "{{ $monsterDesc }}",
        "image": "{{ !is_null($data->picture) ? url($data->picture) : to_img() }}",
        "mainEntityOfPage": "{{ rtrim(config('app.url'), '/') . '/' . ltrim(request()->path(), '/') }}",
        "identifier": "{{ $data->id }}"
    }
    </script>
@endsection
