@extends('layouts.tabler')

@if(request()->has('level'))
  @section('title', 'Toram list leveling level '. $lvl)
@else
  @section('title', 'Toram leveling List')
@endif
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">List leveling Level {{ $lvl }}</h1>
    </div>

    <div class="row">
      <div class="col-12">
      @include('inc.cari')
      </div>

      <div class="col-md-8">

        @includeWhen(!app()->isLocal(), 'inc.ads_article')

        <div class="card">
            <form action="/leveling" method="get" accept-charset="utf8">
          <div class="card-body p-3">
           <div class="row">
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
              <input type="number" name="level" placeholder="levelmu" class="form-control" value="{{ request('level') }}" required>
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
              <div class="input-group">
                <input type="number" class="form-control text-right" placeholder="Bonus EXP Gain %" aria-label="Bonus EXP GAIN" name="bonusexp" value="{{ request('bonusexp') }}">
                 <span class="input-group-append">
                            <span class="input-group-text">%</span>
                          </span>
              </div>
             </div>
            </div>

             <div class="col-sm-12 col-md-8">
                <div class="form-group">
                        <label class="form-label">Jarak Level</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="range" value="5" class="selectgroup-input" checked>
                      <span class="selectgroup-button">0-5</span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="range" value="6" class="selectgroup-input" {{ request('range') == 6 ? 'checked' : '' }}>
                        <span class="selectgroup-button">6</span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="range" value="7" class="selectgroup-input" {{ request('range') == 7 ? 'checked' : '' }}>
                        <span class="selectgroup-button">7</span>
                      </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="range" value="8" class="selectgroup-input" {{ request('range') == 8 ? 'checked' : '' }}>
                        <span class="selectgroup-button">8</span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="range" value="9" class="selectgroup-input" {{ request('range') == 9 ? 'checked' : '' }}>
                        <span class="selectgroup-button">9</span>
                    </label>
                  </div>
               </div>
             </div>

            <div class="col-sm-12 col-md-4">

               <label class="form-label sm-hidden">&nbsp;</label>
               <button class="btn btn-outline-primary btn-block" type="submit"> <i class="fe fe-search"></i> Cari </button>
            </div>

            <div class="col-12">
              <hr class="my-1">
              <small class="help-block"><b>Note</b> jarak bonus dari level monster telah di <a href="http://id.toram.jp/information/detail/?information_id=4580" rel="nofollow">update pada maintenance kamis, 18 juli 2019</a>, antara +/-9</small>
             </div>
           </div>
          </div>
          </form>

          <div class="p-3">
            <b>Level:</b> {{ request('level') }} ke {{ request('level', 49)+1 }}<br>
            <b>Bonus Exp:</b> {{ request('bonusexp', 0) }}%<br>
            <b>Jarak:</b> {{ request('range', 5) }}
          </div>
          <span class="text-center d-block">Butuh <b class="text-primary"><u>{{ number_format($expNeed) }}</u></b> EXP</span>
          <hr class="my-2">
          <div class="card-body p-0">
          <ul class="nav nav-tabs justify-content-center m-0" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="leveling-tab" data-toggle="tab" href="#leveling" role="tab" aria-controls="leveling" aria-selected="true">
               Leveling list</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Bonus EXP Gain %
              <span class="nav-unread"></span>
              </a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <!-- leveling list -->
          <div class="tab-pane fade show active" id="leveling" role="tabpanel" aria-labelledby="leveling-tab">

          <table class="card-table table table-striped table-hover" style="font-size:15px">
            <tr>
              <td><div><b>Note!</b>  <br> <span class="text-danger">Boss</span>  <span class="text-success ml-5">Mini Boss</span> </div></td>
            </tr>

         @foreach ($data as $mob)
          <tr class="{{ $mob->type == 2 ? 'text-success':'text-danger' }}">
            <td class="px-2 py-2"><div> <a class="{{ $mob->type == 2 ? 'text-success':'text-danger' }}" href="/monster/{{ $mob->id }}"> {{ $mob->name }} (Lv {{ $mob->level }}) </a></div>
             <small class="text-muted">
               <a href="/peta/{{ $mob->map_id }}" class="text-muted">
               {{ $mob->map->name }}
               </a>
              </small>
            @if($mob->xp && $mob->persen)
              <br>
              <small class="text-primary"><i class="fe fe-arrow-up-circle mr-1"></i> {{ number_format($mob->xp) }} exp ({{ $mob->persen }}) <i class="fe fe-refresh-cw mx-1"></i> {{ $mob->defeat }}x run</small>
           @else
              <br>
              <small class="text-primary"><i class="fe fe-arrow-up-circle mr-1"></i> --unknown--</small>
           @endif
            </td>
          </tr>
         @endforeach
          </table>
            </div>
            <!-- info exp gain -->
            <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="p-3" style="font-size:14px;font-weight:400">
              <strong class="h3">Prestasi / emblem</strong>
              <div class="my-2">

   @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
              </div>
              <b>Prestasi harian</b> <br>
              - Bermain 30 menit = <b>10%</b> EXP <br>
              - Bermain 60 menit = <b>10%</b> EXP <br>
              <br>

              - Membunuh 30 mobs yang levelnya 30 level lebih tinggi/rendah dari levelmu = <b>10%</b> EXP <br>

              - Membunuh 60 mobs yang levelnya 20 level lebih tinggi/rendah dari levelmu = <b>10%</b> EXP <br>

              - Membunuh 90 mobs yang levelnya 10 level lebih tinggi/rendah dari levelmu = <b>10%</b> EXP <br>

              <br><br>
              <strong>Level pemain</strong> <br>
              - Mencapai level 30, EXP Gain +10% &lt; levelmu <br>  - Mencapai level 60, EXP Gain +11% &lt; levelmu <br>  - Mencapai level 90, EXP Gain +12% &lt; levelmu <br>  - Mencapai level 120, EXP Gain +13% &lt; levelmu <br>  - Mencapai level 150, EXP Gain +14% &lt; levelmu <br>  - Mencapai level 180, EXP Gain +15% &lt; levelmu <br><br>
              Total dari emblem level jika telah mencapai level 180 adalah <b>75%</b>.
              <br><br>
              - Skill EXP Gain level 10 = <b>10%</b> EXP Gain. <br><br>

              <b>Total</b> jika kamu telah membuka semua emblem di atas adalah <b>125%</b> EXP Gain. jika di tmbah dengan skill EXP Gain Lv 10 adalah <b>135%</b> EXP Gain.

              <br><br>
              <b>VIP Tiket</b> <br>
              - Standar tiket = <b>50%</b> EXP Gain. <br>
              - Leveling Tiket = <b>100%</b> EXP Gain. <br><br>

              <b>Total</b> emblem di tambah full VIP Tiket adalah <b>285%</b> EXP Gain.

              <div class="my-5"></div>
              <h3>Item Spesial</h3>
              - Buku Tempa = <b>100%</b> EXP Gain untuk 60 monster. <br>
              - Buku Tempa Rahasia = <b>100%</b> EXP Gain untuk 240 monster. <br>
              - Catatan Balft = <b>50%</b> EXP Gain selama 3 jam. <br>
              - Catatan Yarn = <b>50%</b> EXP Gain selama 7 jam. <br>
              - Catatan Triel = <b>50%</b> EXP Gain selama 7 jam. <br>
              - Catatan Pino = <b>50%</b> EXP Gain selama 15 jam. <br>
              - Catatan Libera II = <b>100%</b> EXP Gain selama 1 jam. <br>
              - Catatan Tenert II = <b>100%</b> EXP Gain selama 1 jam. <br>
              - Catatan Libera III = <b>200%</b> EXP Gain selama 1 jam. <br>
              - Catatan Tenert III = <b>200%</b> EXP Gain selama 1 jam. <br>
              - Catatan Libera IV = <b>300%</b> EXP Gain selama 1 jam. <br>
              - Catatan Tenert IV = <b>300%</b> EXP Gain selama 1 jam. <br>

              <div class="my-5">

   @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

              List Leveling level
                @foreach(range(1,215) as $lv)
                  , <a href="/leveling?level={{ $lv }}"> {{ $lv }} </a>
                @endforeach
              </div>
             </div>
            </div>
          </div>
          </div>

        </div>

        @includeWhen(!app()->isLocal(), 'inc.ads_article')
      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection