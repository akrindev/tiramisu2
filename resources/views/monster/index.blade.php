@extends('layouts.tabler')


@section('title','Toram drop list Monsters')
@section('description','Toram database / drop list monster, Mini boss dan boss, toram map')
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

  @includeUnless(app()->isLocal(), 'inc.ads_mobile')

      @foreach ($data as $pos)
                    <b class="kunci" style="display:block"><i class="fe fe-github mr-2"></i>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/peta/{{$pos->id}}" class="key">{{$pos->name}}</a> </b>
     @endforeach

  @includeUnless(app()->isLocal(), 'inc.ads_mobile')
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
<script src="/assets/js/mons.js"></script>
@endsection
