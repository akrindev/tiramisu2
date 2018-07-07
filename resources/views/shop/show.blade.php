@extends('layouts.tabler')

@section('title',$data->nama_barang)
@section('description','Jual '. $data->nama_barang)
@section('image',$data->gambar)

@section('content')
<div class="my-3 my-md-5">

<div class="container">

            <div class="page-header">
              <h1 class="page-title">
                Marketplace
              </h1>
              <div class="page-subtitle">Jual beli super simple </div>
            </div>
  <a href="/shop" class="btn btn-pill btn-outline-secondary btn-sm mb-4"><i class="fe fe-chevron-left"></i> Go back shop</a>
<div class='row'>
  <div class="col">
    <div class="card">
      <div class="row">
        <div class="col-md-6">
      <img class="card-img-top" src="{{$data->gambar}}">
        </div>
        <div class="col-md-6">
      <div class="card-header">

        <h3 class="card-title">{{$data->nama_barang}} </h3>
      </div>

      <div class="card-body p-4">

           <div class="" style=""><img src="https://graph.facebook.com/{{$data->user->provider_id}}/picture?type=normal" class="avatar avatar-md mr-3 float-left">{{ $data->user->name }}<br>
             <i class="fe fe-eye"></i> {{ $data->views }}
        </div>
        <strong class="text-success">{{ number_format($data->harga) }} Spina</strong><br><br>
        <small class="text-{{ $data->laku == 0 ? 'danger': 'success'}}">{{ $data->laku == 0 ? 'Belum laku': 'Laku'}}</small><br><br>
       {{$data->deskripsi}}

        @auth
        @if(auth()->user()->role == 'admin')
{!! form_open('/shop/delete') !!}
@csrf
 @method("DELETE")
        <input type="hidden" name="id" value="{{$data->id}}">
        <button type="submit" class="btn btn-danger float-right">Hapus</button>
 {!! form_close() !!}
        @endif
        @endauth
        <hr class="my-3">
        <b>Hubungi </b> <br>
        <b>Line: </b> <a href="#">@ {{ $data->user->contact->line}}</a> <br>
        <b>Whatsapp: </b> <a href="https://api.whatsapp.com/send?phone={{$data->user->contact->whatsapp}}&text=https://toram-id.info/shop/show/{{$data->slug}}">{{$data->user->contact->whatsapp}}</a>
      </div>
  </div>
      </div>
    </div>
</div>

    </div>
  </div>


<div class="container">

            <div class="page-header">
              <h1 class="page-title">
                Mungkin kamu juga minat
              </h1>

            </div>
<div class='row'>
  @if($rand->count() > 0)
    @foreach ($rand as $pos)
  <div class="col-md-6">

    <div class="card">
      <div class="row">
        <div class="col-md-6">
      <img class="card-img-top" src="{{$pos->gambar}}">
        </div>
        <div class="col-md-6">
      <div class="card-header">

        <h3 class="card-title">{{$pos->nama_barang}} </h3>
          </div>

      <div class="card-body p-2">
        <strong class="text-success">{{number_format($pos->harga)}} Spina</strong><br >
           <div class="" style=""><img src="https://graph.facebook.com/{{$pos->user->provider_id}}/picture?type=normal" class="avatar avatar-md mr-3 float-left">{{ $pos->user->name }}</div>
        <hr class="mt-5">
       {{str_limit($pos->deskripsi,140)}}
        <br>

      </div>

        <a href="/shop/show/{{$pos->slug}}" class="btn btn-block btn-outline-primary btn-flat">Beli</a>
  </div>
      </div>
    </div>

  </div>
    @endforeach
  @else
  <div class="col">
    kuy jual barang
  </div>
  @endif

    </div>
  </div>
</div>

@endsection