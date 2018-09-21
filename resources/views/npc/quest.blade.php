@extends('layouts.tabler')

@section('title', 'Toram NPC: '. $npc->name)
@section('description', 'Toram npc: '.$npc->name.', list npc, quest, reward, npc picture and more')
@section('image', $npc->picture ?? to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Toram NPC: {{ $npc->name }}</h3>
    </div>

    <div class="row">
      <div class="col-md-8">
        <a href="/npc" class="mb-5 btn btn-outline-primary btn-pill">← back to npc</a>
        <div class="card">
  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <div style="display:block;clear:both" class="mb-5">
              <img src="{{ $npc->picture }}" style="width:100px;height:100px;float:left" class="mr-3">
           <i class="fe fe-wind"></i> <a href="/npc/npc-{{ $npc->id }}">{{ $npc->name }}</a>
              @if (auth()->check() && auth()->user()->isAdmin()) <span class="text-danger" onclick="delNpc({{ $npc->id }})">[Hapus]</span> <a href="/npc/edit/{{ $npc->id }}">[edit]</a>
              @endif
              <br>
              <small class="text-muted">( {{ $npc->map->name }} )</small>
           </div>
            <div style="clear:both"></div>
            <hr class="my-1">
  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
            @foreach($npc->quest as $quest)
            <div class="mb-5">
             <b>Nama Quest:</b> {{ $quest->name }}
              @if (auth()->check() && auth()->user()->isAdmin()) <span class="text-danger" onclick="delQuest({{ $quest->id }})">[Hapus]</span>
              @endif
              <br>
              <b>Min. Level:</b> {{ $quest->level }} <br>
              @if (! is_null($quest->detail))
              <b>Detail:</b> <br>
              <p class="text-muted">{{ $quest->detail }}</p>
              @endif
              <b>Hadiah: </b> <span class="text-success"> {{ number_format($quest->exp) }}xp </span><br>
                  @foreach($quest->reward as $reward)
                  <img src="{{ $reward->drop->dropType->url }}" class="mr-2 rounded" style="width:18px;height:18px"> <a href="/item/{{ $reward->drop->id }}"> {{ $reward->drop->name }}</a> x{{ $reward->many }} <br>
                  @endforeach
              <br>
              <b>Tujuan:</b> <br>
              @foreach($quest->tujuan as $tujuan)
                @if ($tujuan->defeat == 1)
                  <span class="text-danger">Bunuh <a href="/monster/{{ $tujuan->monster->id }}">{{ $tujuan->monster->name }}</a> </span> x{{ $tujuan->many }} <br>
                @endif
                @if ($tujuan->defeat == 2)
                  <span class="text-success">Kumpulkan <a href="/item/{{ $tujuan->drop->name }}">{{ $tujuan->drop->name }}</a></span> x{{ $tujuan->many }} <br>
                @endif
              @endforeach

            </div>
            <hr class="my-1">
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
@endsection


@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<script src="/assets/js/vendors/selectize.min.js"></script>
@endsection

@section('footer')
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>

@if (auth()->check() && auth()->user()->isAdmin())
<script>

function delQuest(i){
 let token = document.getElementById('token').value;

  let data = new FormData();
  data.append('_method', 'delete');
  data.append('token', token)

  swal({
  	title: 'Hapus Quest ini?',
    text: 'Data yang di hapus tidak bisa di kembalikan',
    icon: 'warning',
    dangerMode:true,
    buttons: true
  }).then(yes => {
  	if(yes){
      axios.post('/npc/delete-quest/'+i, data)
      .then(res => {
      	if(res.data.success){
          window.location.reload();
        }
      }).catch(err => alert(err));
    }
  });
}


function delNpc(i){
 let token = document.getElementById('token').value;

  let data = new FormData();
  data.append('_method', 'delete');
  data.append('token', token)

  swal({
  	title: 'Hapus Npc ini?',
    text: 'Data yang di hapus tidak bisa di kembalikan',
    icon: 'warning',
    dangerMode:true,
    buttons: true
  }).then(yes => {
  	if(yes){
      axios.post('/npc/delete-npc/'+i, data)
      .then(res => {
      	if(res.data.success){
          swal('npc dihapus',{
          	icon: 'success'
          }).then(() => {
         	 window.location.href = '/npc';
          });
        }
      }).catch(err => alert(err));
    }
  });
}
</script>
@endif
@endsection