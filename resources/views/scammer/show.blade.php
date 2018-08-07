@extends('layouts.tabler')

@section('title', 'Daftar scammer toram online')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Scammer toram</h1>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <table class="card-table table table-striped m-0">
            @forelse ($data as $list)
            <tr>
              <td class="p-3">
                <a href="/scammer/r/{{$list->slug}}">{{$list->judul}} </a> <br>
                <strong>Facebook: </strong> <span class="text-muted"> {{ $list->facebook}} </span> <br>
                <strong>ID Line: </strong> <span class="text-muted"> {{ $list->line }} </span><br>
                <strong>Ign Toram:</strong> <span class="text-muted"> {{ $list->ign }}</span> <br>
                <strong>kerugian: </strong> <span class="text-danger"> {{ number_format($list->spina) }}s </span> <br>
                <strong><i class="fe fe-tag"></i> </strong> <a href="/scammer/k/{{$list->kategori->id}}">{{ $list->kategori->name }}</a>
              </td>
              <td style="width:30%" class="p-3">
                <img src="{{$list->picture()->first()->url}}" alt="" class="img-thumbnail">
              </td>
            </tr>
            @empty
            <tr class="p-5">No posts</tr>
            @endforelse
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection