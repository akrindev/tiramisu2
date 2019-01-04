@extends('layouts.tabler')

@section('title', 'Toram Cooking list (list resep masakan toram)')
@section('description', 'Toram Cooking list / Toram list masakan')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Toram List Cooking</h3>
    </div>

    @if(session()->has('deleted'))
    <div class="alert alert-success">{{ session('deleted') }}</div>
    @endif

    <div class="row">
      <div class="col-md-8">

        <div class="card">
          <div class="p-0 m-0">

          <table class="table card-table table-striped">
            @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
              @foreach($cooks as $cook)
                @if($loop->index % 8 == 0)
                @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
                @endif
              <tr>
                <td class="px-2 py-2">
                  <b class="text-primary"> {{ $cook->name }} </b> <span class="btn btn-sm btn-outline-danger ml-1" onclick="delthis({{ $cook->id }})">delete?</span> <br>
                  <small class="text-muted">Masakan Lv {{ $cook->level }} <img src="/img/cook-pt.png" class="rounded mr-1 ml-2" width="20px" height="20px"> {{ $cook->pt }}pt</small> <br>
                  <span class="text-warning">{{ $cook->buff }}</span>
                </td>
                <td class="text-right p-1">
                  <img src="{{ $cook->picture }}" class="rounded" width="90px" height="90px">
                </td>
              </tr>

         {!! form_open('/cooking/delete/'.$cook->id,['id'=>'gid'.$cook->id]) !!}
          @csrf
          @method("DELETE")
         <input type="hidden" name="id" value="{{ $cook->id }}">
        {!! form_close() !!}

            @endforeach
          </table>

          </div>
        </div>
      </div>
      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')
@auth
  @if(auth()->user()->isAdmin())
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

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//unpkg.com/axios/dist/axios.min.js"></script><script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>

    <script type="text/javascript">
        loadProgressBar();
    </script>
  @endif
@endauth
@endsection

@section('footer')
  @auth
    @if(auth()->user()->isAdmin())
<script>
function delthis(i) {

       swal({
        title: "Yakin mau hapus data ini?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          return document.getElementById('gid'+i).submit();
        } else {
          swal("Aman gan!");
        }
      });
}
</script>
    @endif
  @endauth
@endsection