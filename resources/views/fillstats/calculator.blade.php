@extends('layouts.tabler')

@section('title','Fill Stat Simulator')
@section('description','Toram fill Stats Skill level 4 Simulator')
@section('image',to_img())


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5" onload="App.loadSettings(); App.loadFromStorage()">

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

      <div class="mb-5 col-12">
        <div class="alert alert-info">
        Untuk melihat fill stats formula <a href="/fill_stats">klik disini</a>
        </div>

        <div class="alert alert-danger">
        	Before using this statting simulator, make sure that you learn these statting skills (3 skills on the bottom) and level up to max level

          <img src="https://lh3.googleusercontent.com/0vK72CbQLCkstI9OuN9hcxbFG5s8vHKt5hAZSwzz0oSkcF58BaFNS4PI9m2C3uxsjXHg-vz_D5fbbxYgK5T3aAvRsZPG0qJFKOnt47pUiyHfVaZ6fhSMlFmRr7KUuUHSKFFXb7AFOQ" class="my-2 d-block" />
          and <b>Max</b> your <b>TECH</b> stats to 255 point.

<img src="https://lh3.googleusercontent.com/LLhAS04wxga6HuLB6Q5pYZvgYdjURvQMLBYvgSYhOWKa5Z6cPiSZ5cDU6PWlmH1Gg68F-e91a0-JN46wruAPAoHPiiKKqo9IRuJsS5BzlBGCyeRJ5Z8c89H8zGbmwUZkuKYP2eW9AA=w1920-h1080" class="my-2 d-block">
        </div>

      </div>

    </div>

    <div class="row equal justify-content-center">
      <div class="mb-5 col-md-5 {{ session()->has('data') ?  '' : '' }}">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Resep status </h3>
          </div>
          <div class="card-alert alert alert-info">
            <b>Updated</b> Skill tree level 4 <br>
            <small>latest simulator update: <i> 4 February 2021</i> </small>
          </div>

          <div class="p-3 card-body" style="font-size:14px;font-weight:400">
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
              <details>
                <summary>extras</summary>
                <label for="tec">TECH</label>
                <input type="number" name="tec" id="tec" min=0 max=255  class='form-control' value=255>
                <label for="proficiency">Proficiency</label>
                <input type="number" name="proficiency" id="proficiency" min=0 max=250 class='form-control' value=0>
              </details>
            </div>

            <div class="form-group">
              <button class="m-1 btn btn-outline-primary btn-pill" onclick="App.spawn();setTimeout(() => { document.getElementById('workspace').scrollIntoView() }, 400)">Start!</button>

              <a href="/fill_stats" class="m-1 btn btn-pill btn-outline-warning"><i class="fe fe-folder"></i> Explore Formula</a>

            </div>


            <div class="mt-3">
              <small class="text-muted">Credit: <a href="https://sparkychildcharlie.github.io/statting_simulator" rel="nofollow" target="_blank">Charlie Kobayashi</a></small>
            </div>
          </div>
        </div>
      </div>

        <div class="mb-5 col-md-4" id="wk">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">WorkSpace</h3>
                </div>
                <div class="p-3 card-body">
                  <div id="stat-details"></div>
                    <div id="navigation_bar"></div>
                    Save your formula to server <br />
                    <div class="form-group">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" id="note" maxlength="40" placeholder="title max 40 charachter">
                    </div>
                    @if(!session()->has('data'))
                    <div class="form-group">
                        <button class="btn btn-primary btn-pill" id="save" onClick="Cloud.send()">Save</button>

                        @auth
                         <a href='/fill_stats/myformula' class="ml-2 btn btn-pill btn-outline-primary animated infinite pulse text-primary">show all my formula</a>
                        @endauth
                    </div>
                    @endif

                    <hr class="my-2">

			<div class="dimmer">
  				<div class="loader"></div>
  				<div class="dimmer-content">
                    <div id="saved-formula" class="o-auto" style="height: 160px">
                        Save public atau <a href="/fb-login">Login</a> untuk melihat formula yang telah kamu simpan <br />
                    </div>
                    <div id="love-formula" class="o-auto" style="height: 165px"> empty
                    </div>
  				</div>
			</div>



                </div>
            </div>
        </div>

        <div class="mb-5 col-md-3" id="ads">
        		@includeUnless(app()->isLocal(), 'inc.ads_article')
        </div>

      <div class="w-100"></div>
      <div class="mb-5 col-md-5">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Status</h3>
          </div>
          <div class="p-3 card-body">
            <div class="form-group">
              <div class="p-3 row gutter-xs" id="workspace">
				stats will appear here.
				</div>
            </div>

			<div class="mt-2 d-block">
        		@includeUnless(app()->isLocal(), 'inc.ads_mobile')
			</div>
          </div>
        </div>
      </div>

      <div class="hidden mb-5 col-md-4" id="show-formula">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Formula</h3>
              <div class="card-options"> <button class="btn btn-sm btn-outline-primary" onclick="document.getElementById('wk').scrollIntoView();document.getElementById('note').focus()">save</button> </div>
          </div>
          <div class="p-0 card-body" id="formula_display" style="font-size:14px">
          </div>

        </div>
      </div>

      <div class="hidden mb-5 col-md-3">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Material Used</h3>
          </div>
          <div class="p-0 card-body" id="material_display">
          </div>
        </div>
      </div>

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
<script src="/assets/js/saveFormula.js?v2"></script>
<script src="/assets/js/newfill.js?v4"></script>
<script src="/assets/js/math.js"></script>


@auth
<script>
	Cloud.loadSavedFormula();
 </script>
@endauth

@if(session()->has('data'))

<script>
    let data = {!! json_encode(session('data')->body, JSON_PRETTY_PRINT) !!}
	App.loadFromJson(data);
</script>
@endif
@endsection