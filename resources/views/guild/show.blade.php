@extends('layouts.tabler')

@section('title', $guild->name . ' Guild')

@section('content')

@if (session()->has('success'))
    <div class="card-alert alert alert-success">
        <div class="container">
            {{ session('success') }}
        </div>
    </div>
@endif
@if(session()->has('failed'))
    <div class="card-alert alert alert-danger">
        <div class="container">
            {{ session('failed') }}
        </div>
    </div>
@endif

    <div class="my-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">{{ $guild->name }}</h1>
            </div>


            <div class="row">
                <div class="col-md-5">
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
                        <tr>
                            <td>
                                <div class="d-block mb-1">
                                    <img src="{{ $guild->logo }}" alt="{{ $guild->name }}" class="thumb">
                                </div>
                                <div>
                                    <strong class="d-block" style="font-size: 18px"><a href="/guilds/{{ $guild->id }}">{{ $guild->name }}</a></strong>
                                    <small class="text-muted"><strong>Owner: </strong>{{ $guild->manager->ign }} - Level: {{ $guild->level }}</small>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ toHtml($guild->description) }}</td>
                        </tr>
                        </table>
                        @can('update', $guild)

                        <div class="mt-5 px-5">
                            <form action="{{ route('guilds.destroy', $guild->id) }}" method="post" onsubmit="return confirm('guild tidak akan kembali setelah di bubarkan');">
                            @csrf
                            @method('delete')
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-danger ">bubarkan guild</button>

                                <a href="{{ route('guilds.edit', $guild->id) }}" class="float-right btn btn-outline-primary">edit</a>
                            </div>
                            </form>

                        </div>
                        @endcan
                    </div>

                    @can('add-member', $guild)

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">tambah member</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('guilds.member', $guild->id) }}" method="post">
                            <div class="form-group">
                                <label class="form-label">Username</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="username" required>
                                <span class="text-muted">masukkan username tanpa @</span>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jabatan</label>
                                <select name="role" id="" class="form-control form-select @error('role') is-invalid @enderror">
                                    <option value="wakil">Wakil Ketua</option>
                                    <option value="inviter">Inviter</option>
                                    <option value="member">Member</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-footer">
                                <button class="btn btn-outline-primary" type="submit">Add</button>
                            </div>
                            @csrf
                            </form>
                        </div>
                    </div>
                    @endcan

                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Members</h2>
                        </div>
                        <table class="card-table table">
                            <thead>
                                <tr>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Cooking</th>
                                        @can('update', $guild)
                                        <th>Action</th>
                                        @endcan
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($guild->users as $member)
                                <tr>
                                    <td>
                                        <div>
                                            {{ $member->name }} <br>
                                            <span class="text-muted">{{ $member->ign }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $member->pivot->role }} {!! !$member->pivot->accept ? "<span class='badge badge-warning'>waiting</span>" : '' !!} <br>
                                            <span class="text-muted">
                                                <strong>Invited by:</strong>
                                                {{ optional($member->pivot->manager)->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="text-muted">
                                                {{ optional($member->cooking)->buff }} {{ $member->cooking_level ?? '' }}
                                            </span> <br>
                                            <span class="text-muted">
                                                {{ optional($member->secondCooking)->buff }} {{ $member->second_cooking_level ?? ''}}
                                            </span>
                                        </div>
                                    </td>
                                    @can('update', $guild)
                                    <td>
                                        @if ($guild->manager_id != $member->pivot->user_id)

                                        <div>
                                            <form action="{{ route('guilds.remove.member', $guild->id) }}" method="POST" onsubmit="return confirm('yakin mau hapus member ini?')">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="memid" value="{{ $member->id }}">
                                                <div class="form-group">
                                                    <button class="btn btn-outline-danger btn-sm">hapus</button>
                                                </div>
                                            </form>

                                            @if ($member->pivot->accept && $guild->manager_id == auth()->id())

                                            <form action="{{ route('guilds.ketua', $guild->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="memid" value="{{ $member->id }}">
                                            <div class="form-group">
                                                <button class="btn btn-sm btn-outline-primary">jadikan ketua</button>
                                            </div>
                                            </form>
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
