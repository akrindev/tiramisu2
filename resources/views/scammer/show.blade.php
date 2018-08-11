@extends('layouts.tabler')

@section('title', $title)
@section('description', $description)

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Scammer toram</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
                        <a href="/scammer/tambah" class="float-right btn btn-primary btn-pill mb-3">Tambah data scammer</a>

            <div id="cari-kan">
              {!! form_open('/scammer/cari',["method"=>"GET"]) !!}

              <div class="form-group">
                <div class="input-group">
                <input type="search" name="q" class="form-control" placeholder="cari judul, fb, line, ign , dll..." required pattern="{2,}" value="{{ request()->q ?? ''}}">    <span class="input-group-append">
                              <button class="btn btn-outline-primary" type="button"><i class="fe fe-search"></i> Cari!</button>
                            </span>
                </div>
              </div>

              {!! form_close() !!}
            </div>

        <div class="card" style="word-wrap:break-word;">
          <table class="card-table table table-striped m-0">
            @forelse ($data as $list)
            <tr>
              <td class="p-3" style="word-wrap:break-word">
                <a style="word-wrap:break-word;" href="/scammer/r/{{$list->slug}}">{{$list->judul}} </a> <br>
                <strong>Facebook: </strong> <span class="text-muted"> {{ $list->facebook}} </span> <br>
                <strong>ID Line: </strong> <span class="text-muted"> {{ $list->line }} </span><br>
                <strong>Ign Toram:</strong> <span class="text-muted"> {{ $list->ign }}</span> <br>
                <strong>kerugian: </strong> <span class="text-danger"> {{ number_format($list->spina) }}s </span> <br>
                <strong><i class="fe fe-tag"></i> </strong> <a href="/scammer/kategori/{{$list->kategori->id}}">{{ $list->kategori->name }}</a> <small class="text-muted float-right"><i class="fe fe-clock"></i> {{ $list->created_at->diffForHumans() }}</small>
                </td>

              <td style="width:30%" class="p-3">
                <img src="{{$list->picture()->first()->url}}" alt="" class="img rounded">
              </td>
            </tr>
            @empty
            <tr><td class="p-5">Tidak ada</td></tr>
            @endforelse
          </table>
        </div>

      <div class="my-3">

        {{ $data->appends(request()->q)->links() }}

        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
          <h3 class="card-title">Kategori</h3>
          </div>
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            @forelse ((new App\CatScammer)->distinct()->get() as $sc)
            <i class="fe fe-tag"></i> <a href="/scammer/kategori/{{$sc->id}}">{{ $sc->name }}</a> <small class="text-muted">( {{ $sc->scammer->count() }} )</small> <br>
            @empty
            <div class="p-5">nothing</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection