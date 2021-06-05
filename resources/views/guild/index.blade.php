@extends('layouts.tabler')

@section('title', 'Guild')

@section('content')

@if (session()->has('success'))
    <div class="card-alert alert alert-success">
        <div class="container">
            {{ session('success') }}
        </div>
    </div>
@endif

    <div class="my-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Guild</h1>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="my-3">
                        <a href="/guilds/create" class="btn btn-outline-primary d-block">
                            <i class="fe fe-plus"></i>
                            Tambah Guild
                        </a>
                    </div>
                    <style>
                                .thumb {
                                    max-height: 155px;
                                    width: 100%;
                                    object-fit: cover
                                }

                                @media (min-width: 576px) {
                                    .thumb {
                                        max-height: 255px
                                    }
                                }
                            </style>
                    <div class="card">
                        <table class="card-table table">
                        @forelse ($guilds as $guild)
                        <tr>
                            <td>
                                <div class="d-block mb-1">
                                    <img src="{{ $guild->logo }}" alt="{{ $guild->name }}" class="thumb">
                                </div>
                                <div>
                                    <strong class="d-block" style="font-size: 18px">{{ $guild->name }}</strong>
                                    <small class="text-muted"><strong>Owner: </strong>{{ $guild->manager->ign }} - Level: {{ $guild->level }}</small>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>Empty</td>
                        </tr>
                        @endforelse

                        </table>
                    </div>

                    {{ $guilds->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
