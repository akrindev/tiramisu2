@extends('layouts.tabler')

@section('title','Toram fill stats Calculator')
@section('description','Toram fill stats calculator +16 +17')
@section('image',to_img())

@section('content')
<div class="my-5" onload="build_menu()">

  <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Fill Calculator</h1>
    </div>

    <div class="row">
      <div class="col-12">
      @include('inc.cari')
      </div>

      <div class="col-12">
        <div class="alert alert-info">
        Untuk melihat fill stats formula <a href="/fill_stats">klik disini</a>
        </div>

         @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')
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
            	<div id="stat_menu" class="row gutter-xs p-2">

            	</div>
            </div>

            <div class="form-group">
              <button class="btn btn-outline-primary m-1" onclick="get_results()">Lihat!</button>
              <button class="btn btn-outline-secondary m-1" onclick='prompt_potential()'>Set Potensi</button>
              <button class="btn btn-outline-success m-1" onclick='saveAsImg()'><i class="fe fe-image"></i> Save as image</button>
              <button class="btn btn-outline-danger m-1"  onclick="build_menu()"><i class="fe fe-refresh-ccw"></i> Reset</button>

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

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

            <div id="stat_formulas"></div>
          </div>
        </div>
      </div>




    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="saveImgModal" tabindex="-1" role="dialog" aria-labelledby="saveImgModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="saveImgModalTitle">Save As Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="imgsaved">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" id="dl-image">Download</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')
<script src="/assets/js/vendors/html2canvas.min.js"></script>
<script src="/assets/js/fill.js"></script>

<script src="/assets/js/formula.js"></script>
<script>
$("body").ready(function(){
	build_menu();
});
</script>
@endsection