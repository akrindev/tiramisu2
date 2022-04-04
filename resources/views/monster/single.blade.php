@extends('layouts.tabler')

@section('title', $data->name . ' Map')
@section('description', $data->name . ' adalah peta yang berada di toram')
@section('image', to_img())

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
                @if($data->npc->count() > 0)
                <div class="card">
                    <div class="card-body p-3" style="font-size:14px;font-weight:400">
                        <strong class="h6">NPC</strong> <br>
                        @foreach($data->npc as $npc)
                    - <b>NPC:</b> <a href="/npc/npc-{{ $npc->id }}"> {{ $npc->name }} </a> <br />
                    @endforeach
                    </div>
                </div>
                @endif

                @foreach ($data->monster as $mons)
                    @if(($loop->index + 1) % 5 == 0)
                        @includeUnless(app()->isLocal(), 'inc.ads_article')
                    @endif
                    @include('inc.drop.monster', $mons)
                @endforeach
            </div>

            <div class="col-md-4">
            @include('inc.menu')
            </div>
        </div>
    </div>
</div>
@endsection
