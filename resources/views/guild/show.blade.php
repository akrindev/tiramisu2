@extends('layouts.tabler')

@section('title', $guild->name . ' Guild')
@section('description', strip_tags(toHtml($guild->description, true)))
@section('image', asset($guild->logo))


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
                                    object-fit: cover;
                                }

                                @media (min-width: 576px) {
                                    .thumb {
                                        max-height: 255px;
                                    }
                                }
                            </style>
                    <div class="card">
                        <table class="card-table table">
                        <tr>
                            <td class="p-3">
                                <div class="d-block mb-1">
                                    <img src="{{ $guild->logo }}" alt="{{ $guild->name }}" class="thumb">
                                </div>
                                <div>
									<img src="/img/guild.jpg" class="avatar avatar-md float-left mr-4"/>
                                    <strong class="d-block" style="font-size: 18px"><a href="/guilds/{{ $guild->id }}">{{ $guild->name }}</a></strong>
                                    <small class="text-muted"><strong>Owner: </strong>{{ $guild->manager->ign }} | <strong>Level:</strong> {{ $guild->level }} | <strong>Total Contribution: </strong>  <span class="text-primary">{{ $guild->users->sum('contribution.point') }}</span>
                                    </small>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3">
								<div class="text-wrap">
									{{ toHtml($guild->description, true) }}
								</div>
						</td>
                        </tr>
                        </table>
                        <div class="mt-5 px-5">
                            @can('update', $guild)
                            <form action="{{ route('guilds.destroy', $guild->id) }}" method="post" onsubmit="return confirm('guild tidak akan kembali setelah di bubarkan');">
                            <div class="form-group">

                                    @can('manager', $guild)
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger ">bubarkan guild</button>
                                    @endcan

                                    <a href="{{ route('guilds.edit', $guild->id) }}" class="float-right btn btn-outline-primary mb-3">edit</a>
                                </div>
                            </form>
                            @endcan

                        </div>
                    </div>

                    @can('add-member', $guild)

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Tambah Anggota</h2>
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
									@can('update', $guild)
                                    <option value="wakil">Wakil Ketua</option>
                                    <option value="inviter">Pengundang</option>
									@endcan
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
                            <h2 class="card-title">Anggota Guild</h2>
                        </div>
						<div class="table-responsive">
                        <table class="card-table table responsive table-striped text-nowrap">
                            <thead>
                                <tr>
                                        <th>Nama</th>
                                        <th>Cooking</th>
                                        <th>Contribution</th>
                                        @can('update', $guild)
                                        <th>Action</th>
                                        @endcan
                                </tr>
                            </thead>
                            <tbody>

                            @foreach (collect($guild->users)->sortByDesc('contribution') as $member)
                                <tr>
                                    <td>
                                        <div>
                                            @if($member->pivot->role != 'member')
                                            <img width="20px" height="20px" src="/img/guild_{{ $member->pivot->role }}.png"/>
											@endif
											 {{ $member->ign }} {!! !$member->pivot->accept ? "<span class='badge badge-warning'>waiting</span>" : '' !!} <br>
                                            <span class="text-muted">{{ $member->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @if (!empty($member->cooking))

                                            <span class="text-muted">
                                                {{ (new \App\Helpers\Food)->getStatLv($member->cooking->buff, $member->cooking->stat, $member->cooking_level, true) }}
                                            </span> <span>(Lv {{ $member->cooking_level }})</span> <br>

                                            @endif

                                            @if (!empty($member->secondCooking))

                                            <span class="text-muted">
                                                 {{ (new \App\Helpers\Food)->getStatLv($member->secondCooking->buff, $member->secondCooking->stat, $member->second_cooking_level, true) }}
                                            </span> <span>(Lv {{ $member->second_cooking_level }})</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-primary">
                                            {{ optional($member->contribution)->point }}
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
    </div>
    @endsection

    @section('head')
<style>
.text-wrap {
   overflow-wrap: break-word;
   display: inline-block;
   word-break: break-word;
}
</style>
   @endsection
