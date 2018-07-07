@extends('layouts.tabler')

@section('title','Marketplace')
@section('description','Jual beli barang toram online makin mudah disini')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">

<div class="container">

            <div class="page-header">
              <h1 class="page-title">
                Marketplace
              </h1>
              <div class="page-subtitle">Jual beli super simple</div>
            </div>
<div class='row'>
  @auth
  <div class="col-12 mb-5">
  <a href="/shop/jual" class="btn btn-pill btn-outline-primary">Jual item</a>
  </div>
  @endauth
  @if($data->count() > 0)
    @foreach ($data as $pos)
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
           <div class="" style=""><img src="https://graph.facebook.com/{{$pos->user->provider_id}}/picture?type=normal" class="avatar avatar-md mr-3 float-left">{{ $pos->user->name }}<br>
             <small class="text-muted"><i class="fe fe-eye"></i> {{$pos->views}}</small>
        </div>
        <hr class="my-3">

        <small class="text-{{ $pos->laku == 0 ? 'danger': 'success'}}">{{ $pos->laku == 0 ? 'Belum laku': 'Laku'}}</small><br><br>
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

  <div class="col-md-12">
    {{ $data->links() }}
  </div>
    </div>
  </div>
</div>

@endsection