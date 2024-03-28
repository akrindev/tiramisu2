@extends('layouts.tabler')

@section('title', __(ucfirst($type)))
@section('description', 'Drop list ' . __(ucfirst($type)))
@section('image', to_img())

@section('content')
    <div class="my-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">{{ __(ucfirst($type)) }}</h1>
            </div>

            <div class="row">
                <div class="col-md-8 -mb-5">
                    @include('inc.cari')
                    @includeUnless(app()->isLocal(), 'inc.ads_horizontal')
                </div>

                <div class="col-md-8">
                    @forelse($data as $item)
                        @if (($loop->index + 1) % 5 == 0)
                            @includeUnless(app()->isLocal(), 'inc.ads_mobile')
                        @endif

                        @include('inc.drop.item', $item)
                    @empty
                        <div class="h5">Tidak di temukan</div>
                    @endforelse

                    @includeUnless(app()->isLocal(), 'inc.ads_mobile')

                    {{ $data->links() }}
                </div>

                <div class="col-md-4">
                    @include('inc.menu')
                </div>
            </div>
        </div>
    </div>
@endsection
