@extends('layouts.webview')

@section('title','Exp Calculator')
@section('description','Toram exp calculator, Nc, bnut, dan lainnya. kuy cek disini')
@section('image',to_img())

@section('content')
        <div class="my-3 my-md-5">
          <div class="container">
   @include('inc.cari')
           <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">Toram Exp calculator</h3>
                  </div>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
                <div class="card-body">
  <div class="row">

    <div class="h3 mb-5 col-12">Harga</div>

    <div class="form-group form-group-sm col-md-4 col-xs-12">
      <label>Nightmare Cystal (Kristal teror)</label>
      <input type="number" id="nc" class="form-control" value="7500">
      <div class="help-block">Harga NC per stk</div>
    </div>


    <div class="form-group form-group-sm col-md-4 col-xs-12">
      <label>Bitter Nut (Kacang Pahit)</label>
      <input type="number" id="bnut" class="form-control" value=5000>
      <div class="help-block">Harga BNut perstk </div>
    </div>


    <div class="form-group form-group-sm col-md-4 col-xs-12">
      <label>Nisel Wood (Kayu Nisel)</label>
      <input type="number" id="nwood" class="form-control" value="2000">
      <div class="help-block">Harga NWood perstk</div>
    </div>



  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')


    <div class="h2 mb-5 col-12">Level</div>
    <div class="form-group form-group-sm col-md-4 col-xs-6">
      <label>Level Sekarang</label>
      <input type="number" id="lvnow" class="form-control" value="1">
      <div class="help-block"></div>
    </div>

    <div class="form-group form-group-sm col-md-4 col-xs-6">
      <label>Level Persen sekarang (%) <small class="text-muted">(1-99%)</small> </label>
      <input type="number" id="lvperc" class="form-control" value="1">
      <div class="help-block"></div>
    </div>

    <div class="form-group form-group-sm col-md-4 col-xs-6">
      <label>Target Level</label>
      <input type="number" id="lvtarget" class="form-control" value="170">
      <div class="help-block"></div>
    </div>

    <div class="col-md-4 mb-6 col-xs-6">
      <label>Mulai hitung ? </label><br>
      <button onClick="calc()" class="btn btn-primary">Kalkulasi</button>
    </div>

<div class="col-md-12 col-xs-12">
    <h2>Hasil Akhir</h2>
    <b>Exp yang di butuhkan:</b> <span class="last_xp"></span><br /><br />
    <b>Stock yang di butuhkan:</b>
    <div class="container-fluid">
      <b>NC: </b>  <span class="last_nc"></span><br />
         <b>Bnut: </b>  <span class="last_bnut"></span><br />
         <b>Nwood: </b>  <span class="last_nwood"></span><br /><br /><br />
    </div>

    <b>Spina yang di butuhkan:</b>
    <div class="container-fluid">
      <b>NC: </b>  <span class="spina_last_nc"></span><br />
         <b>Bnut: </b>  <span class="spina_last_bnut"></span><br />
         <b>Nwood: </b>  <span class="spina_last_nwood"></span><br />
    </div>
    </div>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
<div class="col-xs-12">
</div>
  </div>
</div>
</div>
          </div>
</div>
<script src="/assets/js/calc.js"></script>

@endsection