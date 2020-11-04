@extends('layouts.tabler')

@section('title','Toram fill Stat Simulator')
@section('description','Toram fill stats Skill level 4 Simulator calculator +20  +21')
@section('image',to_img())


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5" onload="App.loadFromStorage()">

  <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Fill Stat Simulator</h1>
    </div>

    <div class="row">
      <div class="col-12">
      @include('inc.cari')
      </div>

      <div class="col-12">
        @includeUnless(app()->isLocal(), 'inc.ads_article')
      </div>

      <div class="col-12">
        <div class="alert alert-info">
        Untuk melihat fill stats formula <a href="/fill_stats">klik disini</a>
        </div>

      </div>

    </div>

    <div class="row equal justify-content-center">
      <div class="col-md-5 mb-5" {{ session()->has('data') ? 'style="display:none"' : '' }}>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Resep status </h3>
          </div>
          <div class="card-alert alert alert-info">
            <b>Updated</b> Skill tree level 4
          </div>

          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div class="form-group">
              <label class="form-label">Type</label>
              <div class="selectgroup w-100">
                 <label class="selectgroup-item">
                     <input onclick="document.querySelector('#recipe_pot').value = 46" type="radio" value="w" class="selectgroup-input" checked="true" name="weap_arm" id="weap_arm">
                            <span class="selectgroup-button selectgroup-button-icon">Weapon</span>
                 </label>

                 <label class="selectgroup-item">
                     <input onclick="document.querySelector('#recipe_pot').value = 44" type="radio" value="a" checked="false" class="selectgroup-input" name="weap_arm" id="weap_arm">
                            <span class="selectgroup-button selectgroup-button-icon">Armor</span>
                 </label>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Recipe Pot</label>
              <input type="number" value="44" class="form-control" id="recipe_pot">
            </div>


            <div class="form-group">
              <label class="form-label">Starting Pot</label>
                   <input type="number" value="89" class="form-control" id="starting_pot">
            </div>

            <div class="form-group">
              <label class="form-label">Level prof bs</label>
            	<input type="number" min=1 max=200 class="form-control" id="prof" value=1 oninput="update_prof_lv();">
            </div>

            <div class="form-group">
              <button class="btn btn-outline-primary btn-pill m-1" onclick="App.spawn();setTimeout(() => { document.getElementById('workspace').scrollIntoView() }, 400)">Start!</button>

              <a href="/fill_stats" class="btn btn-pill btn-outline-warning m-1"><i class="fe fe-folder"></i> Explore Formula</a>

            </div>


            <div class="mt-3">
              <small class="text-muted">Credit: <a href="https://sparkychildcharlie.github.io/statting_simulator" rel="nofollow" target="_blank">Charlie Kobayashi</a></small>
            </div>
          </div>
        </div>
      </div>

        <div class="col-md-4 mb-5" id="wk">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">WorkSpace</h3>
                </div>
                <div class="card-body p-3">
                    <div id="navigation_bar"></div>
                    Save your formula to server <br />
                    <div class="form-group">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" id="note" maxlength="40" placeholder="title max 40 charachter">
                    </div>
                    @if(!session()->has('data'))
                    <div class="form-group">
                        <button class="btn btn-primary btn-pill" id="save" onClick="Cloud.send()">Save</button>
                    </div>
                    @endif

                    <hr class="my-2">

			<div class="dimmer">
  				<div class="loader"></div>
  				<div class="dimmer-content">
                    <div id="saved-formula" class="o-auto" style="height:330px">
                        Save public atau <a href="/fb-login">Login</a> untuk melihat formula yang telah kamu simpan <br />
                    </div>
  				</div>
			</div>



                </div>
            </div>
        </div>

        <div class="col-md-3 mb-5" id="ads">
        	@includeUnless(app()->isLocal(), 'inc.ads_article')
        </div>

      <div class="w-100"></div>
      <div class="col-md-5 mb-5 hidden">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Status</h3>
          </div>
          <div class="card-body p-3">
            <div class="form-group">
              <div class="row gutter-xs p-3" id="workspace"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-5 hidden" id="show-formula">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Formula</h3>
              <div class="card-options"> <button class="btn btn-sm btn-outline-primary" onclick="document.getElementById('wk').scrollIntoView();document.getElementById('note').focus()">save</button> </div>
          </div>
          <div class="card-body p-0" id="formula_display" style="font-size:14px">
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-5 hidden">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Material Used</h3>
          </div>
          <div class="card-body p-0" id="material_display">
          </div>
        </div>
      </div>

    </div>

    <!-- ads -->
    <div class="row">
      <div class="col-12">
        @includeUnless(app()->isLocal(), 'inc.ads_mobile')</div>
    </div>

  </div>
</div>

@endsection

@section('head')

<style>
    html {
        scroll-behavior: smooth;
    }
  @media (min-width: 768px) {
  .equal {
    display: -webkit-box;

  display: -webkit-flex;

  display: -ms-flexbox;

  display:         flex;
  }
}
  .hidden {
    display: none
  }

  .card {
    height: 100%
  }
</style>
@endsection

@section('footer')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/saveFormula.js?v1"></script>
<script src="/assets/js/newfill.js"></script>

@if(session()->has('data'))
<script>
	App.getFromCloud({{ session('data') }});
</script>
@endif

@auth
<script>
	Cloud.loadSavedFormula();
 </script>
@endauth
@endsection