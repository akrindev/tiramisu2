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
                <h1 class="page-title">Guild List</h1>
            </div>


            <div class="row">
                <div class="col-md-8">

<form action="#" method="get">

    <div class="form-group">
        <div class="input-group">
            <input type="search" name="search" class="form-control" placeholder="cari guild. . ." required pattern="{2,}">    <span class="input-group-append">
                <button class="btn btn-outline-primary" type="submit"><i class="fe fe-search"></i> Cari!</button>
            </span>
        </div>
    </div>
</form>

                    @auth
                    <div class="my-3">
                        <a href="/guilds/create" class="btn btn-outline-primary d-block">
                            <i class="fe fe-plus"></i>
                            Tambah Guild
                        </a>
                    </div>
                    @endauth
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
                            <td class="p-3">
                                <div class="d-block mb-1">
                                    <img src="{{ $guild->logo }}" alt="{{ $guild->name }}" class="thumb">
                                </div>
                                <div>
                                    <strong class="d-block" style="font-size: 18px"><a href="/guilds/{{ $guild->id }}">{{ $guild->name }}</a></strong>
                                    <small class="text-muted"><strong>Owner: </strong>{{ $guild->manager->ign }} | <strong>Level:</strong> {{ $guild->level }} | <strong>Total Contribution: </strong> {{ $guild->users->sum('contribution.point') }} </small>
                                    @if(auth()->user()->isAdmin())
                                        <form action="{{ route('guilds.destroy', $guild->id) }}" method="post" onsubmit="return confirm('guild tidak akan kembali setelah di bubarkan');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">hapus</button>
                                        </form>
                                    @endif
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
