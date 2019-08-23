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
      <div class="col-md-8">
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
          </table>

        </div>
        @includeWhen(!app()->isLocal(), 'inc.ads_article')
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