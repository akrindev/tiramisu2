@extends('layouts.tabler')

@section('title','Toram fill stats Calculator')
@section('description','Toram fill stats calculator +16')
@section('image',to_img())

@section('content')
<div class="my-5" onload="build_menu()">

  <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Fill Calculator</h1>
    </div>

    <div class="row">

      <div class="col-12">
        <div class="alert alert-info">
        Untuk melihat fill stats formula <a href="/fill_stats">klik disini</a>
    </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Resep status </h3>
          </div>

          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div class="form-group">
               <select class="form-control" id="weap_arm" onchange="update_config('weap_arm')">
                <option value='w'>Weapon</option>
                <option value='a'>Zirah</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label"> Potensial</label>
              <input class="form-control" type="number" value=0 id='recipe_pot' onchange="update_config('recipe_pot')">
            </div>
            <div class="form-group">
            	<div id="stat_menu" class="row gutter-xs p-2">

            	</div>
            </div>

            <div class="form-group">
              <button class="btn btn-outline-primary" onclick="get_results()">Lihat!</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-outline-secondary" onclick='prompt_potential()'>Set Potensi</button>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-8">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Step </h3>
          </div>

          <div class=" o-auto" style="font-size:14px;font-weight:400;height: 26rem">
            <div id="details">
              Step akan tampil disini
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Hasil </h3>
          </div>

          <div class="o-auto" style="font-size:14px;font-weight:40p;height: 26rem">
            <div id="results">
            Hasil akan tampil disini
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8">
      	<div class="card">
          <div class="card-header">
            <h3 class="card-title"> Banyak di gunakan </h3>
          </div>
          <div class="card-body">
            <div id="stat_formulas"></div>
          </div>
        </div>
      </div>




    </div>
  </div>
</div>
@endsection

@section('head')
<script src="/assets/js/fill.js"></script>

<script src="/assets/js/formula.js"></script>
<script>
$("body").ready(function(){
	build_menu();
});
</script>
@endsection