@extends('layouts.tabler')

@section('title', 'Hadiah Prestasi: ' . $rewardName)
@section('description', 'List of emblems Toram Online, Daftar Prestasi ' . $rewardName )
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Hadiah Prestasi: <i>{{ $rewardName }} ({{ $emblems->count() }} prestasi)</i></h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      @forelse($emblems as $emblem)
        <div class="card">
          <div class="card-body p-3">
          <img src="/img/prestasi.png" class="avatar avatar-sm"> <b class="text-primary h5 ml-2">{{ ucfirst($emblem->name) }}</b>
            @if(auth()->check() && auth()->user()->isAdmin())
            <a href="/prestasi/{{ $emblem->id }}/edit" class="btn btn-outline-secondary ml-5 btn-sm">edit</a>
            @endif
            <br>
           <span> {{ $emblem->body }} </span> <br>
           <b>Reward:</b> <i class="text-success"> {{ $emblem->reward }} </i> <br>
            <b>Kategori Prestasi: </b> <a href="/prestasi/{{ $emblem->emblem->id }}">{{ $emblem->emblem->name }}</a>
           @if(!is_null($emblem->update))
            <br>
            <b>Update: </b> {{ $emblem->update }}
           @endif

           @auth
            @if(auth()->user()->isAdmin())
            <br>
            Dibuat/Diubah: <small class="text-muted">{{ $emblem->created_at ?? '-' }} / {{ $emblem->updated_at ?? '-' }} </small>
            @endif
           @endauth
          </div>
        </div>
      @empty
        <div class="card">
          <div class="card-body">
            -- Tidak di temukan --
          </div>
        </div>
      @endforelse
      </div>
      <div class="col-md-4">
      <div class="card">
        <div class="card-alert alert alert-info">
Cara melihat prestasi. <br> "Menu" &gt; "Karakter" &gt; "Prestasi"
        </div>
        <div class="card-body p-3">
          <div class="mb-5">
          <b>Tampilkan reward: </b> <a href="/prestasi/reward/orb">Orb</a>, <a href="/prestasi/reward/karcis kostum">Karcis Kostum</a>, <a href="/prestasi/reward/poin status">Poin Status</a>, <a href="/prestasi/reward/poin skill">Poin Skill</a>, <a href="/prestasi/reward/exp gain">EXP Gain</a>, <a href="/prestasi/reward/spina">Spina</a>, <a href="/prestasi/reward/ruang tokoh">Ruang Tokoh</a>
          </div>
          @foreach((new App\Emblem)->orderBy('id')->get() as $emb)
          <div class="mb-1">
          <img src="/img/prestasi.png" class="avatar avatar-sm"> <a href="/prestasi/{{ $emb->id }}" class="ml-2">{{ $emb->name }}</a>
          </div>
          @endforeach
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection