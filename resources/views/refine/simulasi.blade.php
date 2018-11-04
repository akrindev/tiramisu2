@extends('layouts.tabler')

@section('title', 'Toram simulasi refine')
@section('description', 'Toram simulasi refine, guide refine toram, toram refine success rate, toram table success rate refine, refine guide toram, toram refine simulator')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Toram simulasi refine</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-body p-3">
        <div class=row>
        <div class="form-group col-md-6">
          <label class="form-label">Weapon</label>
          <select name="weapon" id="weapon" class="form-control">
            <option value="busur">busur</option>
            <option value="tongkat">tongkat</option>
            <option value="pedang">pedang</option>
            <option value="pedang raya">pedang raya</option>
            <option value="tombak">tombak</option>
            <option value="tinju">tinju</option>
            <option value="katana">katana</option>
          </select>
        </div>

          <div class="form-group col-md-6">
            <label class="form-label">Tempa</label>
            <select name="ref" id="v-ref" class="form-control">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">E</option>
              <option value="11">D</option>
              <option value="12">C</option>
              <option value="13">B</option>
              <option value="14">A</option>
              <option value="15">S</option>
            </select>
          </div>

          <div class="form-group col-md-6">
          <label class="form-label">Bahan <small class="text-muted">(ore)</small></label>
            <select name="bahan" id="bahan" class="form-control">
            <option value="hematite">hematite</option>
            <option value="iron">iron</option>
            <option value="high purity iron">high purity iron</option>
            <option value="damascus ore">damascus ore</option>
            <option value="damascus steel">damascus steel</option>
            <option value="high purity damascus">high purity damascus</option>
            <option value="mythril ore">mythril ore</option>
            <option value="mythril">mithril</option>
            <option value="high purity mythril">high purity mythril</option>
            <option value="orichalcum ore">orichalcum ore</option>
            <option value="orichalcum">orichalcum</option>
            <option value="high purity orichalcum">high purity orichalcum</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label class="form-label">Jumlah bahan <small class="text-muted">(ore)</small> </label>
            <input class="form-control" type="number" id="v-bahan" value="99">
          </div>



          <div class="form-group col-12">
            <button class="btn btn-pill btn-outline-primary" onclick="getResult()">Tempa</button>
          </div>

        <div class="form-group col-12">
        <b>Weapon: </b>  <span id="r-weapon"></span> <br>
        <b>Bahan:</b> <span id="r-bahan"></span> <br>
        <b>Nilai refine:</b> <span id="r-ref"></span> <br>
        <b>Rate Sukses:</b> <span id="r-rate"></span> <br>
        <b>Risk:</b> <span id="r-risk"></span> <br>
        <b>Peluang sukses:</b> <span id="r-peluang"></span>
        </div>
          </div>
        </div>
      </div>
      </div>

      <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Refine</h3>
        </div>
        <div class="card-body p-3">
        - <a href="/refine">Tentang Refine</a> <br>
        - <a href="/refine/simulasi">Simulasi Refine</a>
        </div>
      </div>
      </div>

      <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Success rate and risk</h3>

        </div>
        <div class="table-responsive">
          <div id="t-ref"></div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')
<script src="/assets/js/refine.js"></script>
<script>
$(document).ready(function() {
	build_table()
})
</script>
@endsection