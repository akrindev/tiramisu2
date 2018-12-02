@extends('layouts.webview')

@section('title', 'Toram leveling Finder')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Toram Leveling Lv {{ $lvl }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
      @include('webview.cari')
      </div>
      <div class="col-md-8">

        <div class="card">
          <div class="p-3" style="font-size:12px">
          {!! form_open('/webview/leveling',['method'=>'get']) !!}
            <div class="form-group">
              <div class="input-group">

              <input type="number" class="form-control" name="level" placeholder="Levelmu" required>

    <span class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit"> <i class="fe fe-search"></i> Cari </button>
                   </span>
              </div>
              <small class="text-muted"><b>Note</b> jarak 3x dari level monster</small>
            </div>

          {!! form_close() !!}
          </div>
  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
          <table class="card-table table table-striped table-hover" style="font-size:12px">
            <tr>
              <td><div><b>Note!</b>  <br> <span class="text-danger">Boss</span>  <span class="text-success ml-5">Mini Boss</span> </div></td>
            </tr>

         @foreach ($data as $mob)
          <tr class="{{ $mob->type == 2 ? 'text-success':'text-danger' }}">
            <td class="px-2 py-2"><div> <a class="{{ $mob->type == 2 ? 'text-success':'text-danger' }}" href="/webview/monster/{{ $mob->id }}"> {{ $mob->name }} (Lv {{ $mob->level }}) </a></div>
             <small class="text-muted">
               <a href="/webview/peta/{{ $mob->map_id }}" class="text-muted">
               {{ $mob->map->name }}
               </a>
              </small>
            </td>
            <td class="px-2 py-2">
              <div>HP</div> <small class="text-muted">{{ number_format($mob->hp) }}</small>
            </td>
          </tr>
         @endforeach
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection