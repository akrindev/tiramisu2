@extends('layouts.tabler')

@section('title', $data->name . ' (Lv '. $data->level .')')
@section('image', !is_null($data->picture) ? '/'.$data->picture : to_img())

@push('canonical')
	@canonical
@endpush

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
                            <a class="text-primary" href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/monster/{{$related->id}}">
                                {{ $related->name }} (Lv {{$related->level}})
                            </a>
                        @switch($related->type)
                            @case(2)
                                <img src="/img/f_boss.png" alt="mini boss" style="display:inline;max-width:120px;max-height:15px;">
                            @break
                            @case(3)
                                <img src="/img/boss.png" class="boss" style="display:inline;max-width:120px;max-height:15px;">
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
