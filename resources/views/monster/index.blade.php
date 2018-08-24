@extends('layouts.tabler')


@section('title','Toram database Monsters')
@section('description','Toram database monster, Mini boss dan boss')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">
  <div class="container">
    @include('inc.cari')
      <div class="row row-cards">
  @if(count($data) > 0)
	<div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      Monster pada peta
                    </h3>
                  </div>
                  <div class="card-body p-3">
                  <div class="form-group">
                    <input type="text" id="peta-kunci" class="form-control form-control-md" placeholder="Nama peta . . .">
                  </div>
      @foreach ($data as $pos)
                    <b class="kunci" style="display:block"><i class="fe fe-github mr-2"></i>
                      <a href="/peta/{{$pos->id}}" class="key">{{$pos->name}}</a> </b>
     @endforeach

                  <div>
                    </div>
                  </div>

                  </div>
                </div>
   @endif
      </div>
    </div>
</div>
@endsection

@section('footer')
<script>
(function(){
  let key = document.getElementById('peta-kunci');
  let peta = document.querySelectorAll('b.kunci');

  key.addEventListener('keyup', (e) => {

    let kunci = key.value.toLowerCase()

    for(let me of peta) {
      if(me.innerText.toLowerCase().indexOf(kunci) > -1) {
        me.style.display = "block"
      } else {
        me.style.display = "none"
      }
    }

  });

})();
</script>
@endsection