@extends('layouts.tabler')

@section('title', 'My Contribusi')


@section('content')
<div class="my-5">
  <div class="container">

    <div class="page-header">
      <h3 class="page-title">My Contribution</h3>
    </div>

    <div class="row">

      <div class="col-md-4">
      @include('inc.contribution_menu')
      </div>

      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px">
            @if($data->count() == 0)
            <b>Belum ada kontribusi</b>
            @endif
            @foreach($data as $drop)

            <div class="mb-1">

              <img src="{{ $drop->drop->dropType->url }}" class="avatar avatar-sm mr-2" style="width:18px;height:18px"> <a class="h5 text-primary" href="/item/{{ $drop->drop->id }}"> {{ $drop->drop->name }}</a> <button type="button" class="btn btn-outline-{{ $drop->accepted == 1 ? 'success':'danger' }} btn-sm btn-pill ml-4" id="{{ $drop->id }}">
  {{ $drop->accepted == 1 ? 'diterima':'pending' }}
</button><br>
              edited to: {{ $drop->name }} <br>
              On: {{ $drop->created_at->diffForHumans() }} <br>
              @if(! is_null($drop->picture))
              <img src="/{{ $drop->picture }}" width="120px" height="120px" class="my-2 rounded">
              <div style="font-size:11px;font-weight:400">@parsedown(nl2br(e($drop->note)))
              </div>
              @endif
            </div>
            @endforeach
          </div>
        </div>

        {{ $data->links() }}
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
@endsection

@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<style type="text/css">
  #nprogress .bar {
    background: red !important;
  }
  #nprogress .peg {
    box-shadow: 0 0 10px red, 0 0 5px red !important;
  }
  #nprogress .spinner-icon {
    border-top-color: red !important;
    border-left-color: red !important;
  }
</style>
@endsection

@section('footer')
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
<script>
$(".f-edit").click(function(e){
	e.preventDefault();
  let token = $("#token").val();

  let data = new FormData();
  data.append('token', token);
  data.append('id', this.id);

  swal({
  	title: 'Terima ini?',
    text: '',
    icon:'warning',
    buttons:true
  }).then(y => {
  	if(y){
      axios.post("/contribution/sudo", data)
      .then(res => {
      	if(res.data.success){
          swal('ok bos',{
            icon: 'success'
          }).then(() => this.remove());

        }
      }).catch(err => alert(err));

    }
  });
});
</script>
@endsection