@extends('layouts.tabler')

@section('title','Exp Calculator (Quest Calculator)')
@section('description','Kalkulasi jumlah exp yang di butuhkan dari Nc, bnut sampai Quest. kuy cek disini')
@section('image','https://i.ibb.co/k1zFdBv/Level-CAP.png')



@section('content')
  <div class="my-3 my-md-5">
    <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Exp Calculator (Quest Calculator)</h1>
    </div>

      <div class="row">

        <div class="col-12">
          @includeWhen(!app()->isLocal(), 'inc.ads_article')

   @include('inc.cari')
              <div class="card" id="vue-root">
                  <div class="card-header">
                  <h3 class="card-title">Toram Exp calculator termasuk quest</h3>
                  </div>
                  <div class="card-alert alert alert-info">
                    <b>New!!</b> Main Quest (MQ) Calculator <a href="/mq_exp"> Click here </a><br>
                    <b>Hot!!</b> Have you try? <a href="/leveling">Toram Leveling Finder</a> <br>
                    <b><a href="/forum/toram-online-level-c-7726be94">LEVEL CAP UPDATE</a></b>
                  </div>

  <div class="card-body p-3">
  <div class="row">
    <div class="h2 mb-5 col-12">Price / harga</div>
    <div class="form-group form-group-sm col-md-4 col-xs-12">
      <label>Nightmare Cystal (Kristal teror)</label>
      <input type="number" id="nc" class="form-control" v-model="hnc">
      <div class="help-block">Harga NC per stk</div>
    </div>

    <div class="form-group form-group-sm col-md-4 col-xs-12">
      <label>Bitter Nut (Kacang Pahit)</label>
      <input type="number" id="bnut" class="form-control" v-model="hbnut">
      <div class="help-block">Harga BNut perstk </div>
    </div>


    <div class="form-group form-group-sm col-md-4 col-xs-12">
      <label>Nisel Wood (Kayu Nisel)</label>
      <input type="number" id="nwood" class="form-control" v-model="hnwood">
      <div class="help-block">Harga NWood perstk</div>
    </div>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')


    <div class="h2 mb-5 col-12">Level</div>
    <div class="form-group form-group-sm col-md-4 col-xs-6">
      <label>Level Sekarang</label>
      <input type="number" id="lvnow" class="form-control" v-model="lvnow">
      <div class="help-block"></div>
    </div>

    <div class="form-group form-group-sm col-md-4 col-xs-6">
      <label>Level Persen sekarang (%) </label>
      <input type="number" id="lvperc" class="form-control" v-model="lvperc">
      <div class="help-block"> <small class="text-muted">(0-100%)</small></div>
    </div>

    <div class="form-group form-group-sm col-md-4 col-xs-6">
      <label>Target Level</label>
      <input type="number" id="lvtarget" class="form-control" v-model="lvtarget">
      <div class="help-block"></div>
    </div>

    <div class="col-md-12 mb-6 col-xs-6">
      <label>Mulai hitung ? </label><br>
      <button @click="kalkulasi" class="btn btn-primary">Kalkulasi</button>
    </div>

	<div class="col-md-6 col-xs-12">
    <h2>Hasil Akhir</h2>
  <b>Leveling:</b> <span class="text-primary">@{{ lvnow }} - @{{ lvtarget }}</span> <br>
    <b>Exp yang di butuhkan:</b> <span class="text-success">@{{ lastExp | numberFormat }}</span><br /><br />
    <b>Stack yang di butuhkan:</b>
    <ol>
      <li><b>NC: </b>  <span class="text-danger">@{{ lastNc }}</span></li>
      <li><b>Bnut: </b>  <span class="text-danger">@{{ lastBnut }}</span></li>
      <li><b>Nwood: </b>  <span class="text-danger">@{{ lastNwood }}</span></li>
    </ol>

    <b>Spina yang di butuhkan:</b>
    <ol>
      <li><b>NC: </b>  <span class="text-primary">@{{ spinaNc | numberFormat }}</span></li>
      <li><b>Bnut: </b>  <span class="text-primary">@{{ spinaBnut | numberFormat }}</span></li>
      <li><b>Nwood: </b>  <span class="text-primary">@{{ spinaNwood | numberFormat }}</span></li>
    </ol>
    </div>

    <div class="col-md-6 col-xs-12">
      <h3> Hasil Kalkulasi Quest </h3>

      <h6> Quest NPC: Arwah Peneliti </h6>
      <ol>
        <li>
          <strong><a href="/npc/quest/1">Bebas Dari si Penggerogot!</a> <span class="text-muted">(150.000 EXP)</span> </strong> <span class="text-danger">@{{ q1 }}</span></li>
        <li><strong><a href="/npc/quest/2">Mencari Air Bersih</a><span class="text-muted">(55.200 EXP)</span> </strong> <span class="text-danger">@{{ q2 }}</span></li>
        <li><strong> <a href="/npc/quest/3">Buku Mestinya di Rak Buku</a> <span class="text-muted">(50.600 EXP)</span> </strong> <span class="text-danger">@{{ q3 }}</span></li>
        <li><strong> <a href="/npc/quest/4">Secercah Harapan</a> <span class="text-muted">(62.800 EXP)</span> </strong> <span class="text-danger">@{{ q4 }}</span></li>
           <li><strong> <a href="/npc/quest/5">Pengejaran si Biang Kerok!</a><span class="text-muted">(41.800 EXP)</span>  </strong> <span class="text-danger">@{{ q5 }}</span></li>
      </ol>

      <hr class="my-2">


      <h6> Quest NPC: Arwah Ningrat </h6>
      <ol>
        <li>
      <strong><a href="/npc/quest/6">Kelinci di Alam Kegelapan?!</a> <span class="text-muted">(344.000 EXP)</span> </strong> <span class="text-danger">@{{ q6 }}</span></li>
        <li><strong><a href="/npc/quest/7">Hidup Nyaman Terus</a><span class="text-muted">(175.000 EXP)</span> </strong> <span class="text-danger">@{{ q7 }}</span> </li>
        <li><strong> <a href="/npc/quest/8">Si Aneh Imut</a> <span class="text-muted">(133.000 EXP)</span> </strong> <span class="text-danger">@{{ q8 }}</span></li>
      </ol>

    </div>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
  </div>
</div>
            </div>

        </div>
      </div>

          </div>
</div>
@endsection

@section('head')
<script src="https://unpkg.com/vue@2.7.8/dist/vue.min.js"></script>
@endsection

@section('footer')

<script src="/assets/js/calc.js"></script>
@endsection
