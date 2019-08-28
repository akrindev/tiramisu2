@extends('layouts.tabler')

@section('title', 'Potensi Kalkulator')
@section('description', 'Kalkulasi perhitungan potensi pada char blacksmith toram berdasarkan status / potential calculator toram online')

@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5" id="app">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Toram Online Potensi Kalkulator </h1>
    </div>

    @include('inc.cari')

    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              Status pemain
            </div>
          </div>
          <table class="card-table table table-striped">
            <tr>
              <th> STR </th>
              <td> <input class="form-control col-4" type="number" id="STR" v-model="str" > </td>
            </tr>
            <tr>
              <th> INT </th>
              <td> <input class="form-control col-4" type="number" id="INT" v-model="int" > </td>
            </tr>
            <tr>
              <th> VIT </th>
              <td> <input class="form-control col-4" type="number" id="VIT" v-model="vit" > </td>
            </tr>
            <tr>
              <th> AGI </th>
              <td> <input class="form-control col-4" type="number" id="AGI" v-model="agi" > </td>
            </tr>
            <tr>
              <th> DEX </th>
              <td> <input class="form-control col-4" type="number" id="DEX" v-model="dex" > </td>
            </tr>

            <tr>
              <th> TECH </th>
              <td> <input class="form-control col-4" type="number" id="TECH" v-model="tech" > </td>
            </tr>

            <tr>
              <th> LUK </th>
              <td> <input class="form-control col-4" type="number" id="luk" v-model="luk" > </td>
            </tr>
          </table>

        </div>
        @includeWhen(!app()->isLocal(), 'inc.ads_article')
      </div>
      <div class="col-md-8">
      	<div class="card">
          <div class="card-header">
            Status Lainnya
          </div>
          <div class="card-body p-3">
            <div class="form-group">
              <label class="form-label">Status Masakan</label>

              <!-- status masakan -->
              <div class="row">
                <div class="col-6">
                  <label>STR</label>
                  <input class="form-control" v-model="foodSTR">
                </div>

                <div class="col-6">
                  <label>DEX</label>
                  <input class="form-control" v-model="foodDEX">
                </div>
              </div>

              <hr class="my-2">

              <!-- status perlengkapan -->

              <label class="form-label">Status Perlengkapan (Weapon / Senjata)</label>

              <div class="row">
                <div class="col-6">
                  <label>STR</label>
                  <input class="form-control" v-model="weapSTRflat">
                </div>

                <div class="col-6">
                  <label>STR (%)</label>
                  <input class="form-control" v-model="weapSTRperc">
                </div>

                <div class="col-6">
                  <label>DEX</label>
                  <input class="form-control" v-model="weapDEXflat">
                </div>

                <div class="col-6">
                  <label>DEX (%)</label>
                  <input class="form-control" v-model="weapDEXperc">
                </div>
              </div>


              <hr class="my-2">

              <label class="form-label">Pelengkap Sub Senjata</label>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" v-model="subWeap">
                      <option value="0">Kosong</option>
                      <option value="2">Army Knife (DEX+2)</option>             <option value="2">High-Quality Wood Arrow (DEX+2)</option>
                    </select>
                  </div>
                </div>
              </div>

              <hr class="my-2">

              <label class="form-label">Status Perlengkapan (Armor / Zirah)</label>

              <div class="row">
                <div class="col-6">
                  <label>STR</label>
                  <input class="form-control" v-model="armSTRflat">
                </div>

                <div class="col-6">
                  <label>STR (%)</label>
                  <input class="form-control" v-model="armSTRperc">
                </div>

                <div class="col-6">
                  <label>DEX</label>
                  <input class="form-control" v-model="armDEXflat">
                </div>

                <div class="col-6">
                  <label>DEX (%)</label>
                  <input class="form-control" v-model="armDEXperc">
                </div>
              </div>

              <hr class="my-2">

              <label class="form-label">Pelengkap Tambahan</label>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" v-model="additional">
                      <option value="0">Kosong</option>
                      <option value="5">Sanggul Chignon [Monster] (DEX+5)</option>
                      <option value="6">Sanggul Chignon [NPC] (DEX+6)</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- special -->

              <hr class="my-2">

              <label class="form-label">Pelengkap Spesial</label>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" v-model="special">
                      <option value="0">Kosong</option>
                      <option value="5">Azimat Mahir IV [NPC] (DEX+8)</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <div class="card-title">
              Potensi yang di dapat
            </div>
          </div>
          <table class="card-table table table-striped text-nowrap">
            <tr>
              <th> Pedang </th>
              <td> <input class="form-control col-4" type="number" id="pedang" v-model="pedang" disabled> </td>
            </tr>
            <tr>
              <th> Pedang 2 tangan </th>
              <td> <input class="form-control col-4" type="number" id="pedangraya" v-model="pedangraya" disabled> </td>
            </tr>
            <tr>
              <th> Busur </th>
              <td> <input class="form-control col-4" type="number" id="bow" v-model="bow" disabled> </td>
            </tr>
            <tr>
              <th> Bowgun </th>
              <td> <input class="form-control col-4" type="number" id="bowgun" v-model="bowgun" disabled> </td>
            </tr>
            <tr>
              <th> Tongkat </th>
              <td> <input class="form-control col-4" type="number" id="tongkat" v-model="tongkat" disabled> </td>
            </tr>
            <tr>
              <th> Alat Sihir </th>
              <td> <input class="form-control col-4" type="number" id="md"  v-model="md" disabled> </td>
            </tr>

            <tr>
              <th> Tinju </th>
              <td> <input class="form-control col-4" type="number" id="tinju" v-model="tinju" disabled> </td>
            </tr>

            <tr>
              <th> Tombak </th>
              <td> <input class="form-control col-4" type="number" id="tombak" v-model="tombak" disabled> </td>
            </tr>

            <tr>
              <th> katana </th>
              <td> <input class="form-control col-4" type="number" id="katana"  v-model="katana" disabled> </td>
            </tr>
            <tr>
              <th> Zirah </th>
              <td> <input class="form-control col-4" type="number" id="zirah" v-model="zirah" disabled> </td>
            </tr>
          </table>

          <hr class="my-3">

          <div class="row">
            <div class="col-md-6">
          <div class="form-group p-3">
            <label class="form-label">Total Status DEX (flat)</label>
            <input class="form-control" v-model="totalDEX" disabled=disabled>
          </div></div>
            <div class="col-md-6">
          <div class="form-group p-3">
            <label class="form-label">Total Status DEX (%)</label>
            <input class="form-control" v-model="totalDEXperc" disabled=disabled>
          </div></div>
          </div>


          <hr class="my-3">

          <div class="row">
            <div class="col-md-6">
          <div class="form-group p-3">
            <label class="form-label">Total Status STR (flat)</label>
            <input class="form-control" v-model="totalSTR" disabled=disabled>
          </div></div>
            <div class="col-md-6">
          <div class="form-group p-3">
            <label class="form-label">Total Status STR (%)</label>
            <input class="form-control" v-model="totalSTRperc" disabled=disabled>
          </div></div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection

@section('footer')
<script src="/assets/js/pot.js"></script>
@endsection