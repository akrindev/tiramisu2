@extends('layouts.tabler')

@section('content')
<div class="my-3 my-md-5">
  <div class="container">

                <div class="card card-profile">
                  <div class="card-header" style="background-image: url(/img/profile.jpg);"></div>
                  <div class="card-body text-center">
                    <img class="card-profile-img" src="https://graph.facebook.com/{{ $profile->provider_id }}/picture?type=normal">
                    <h3 class="mb-3">{{ $profile->name }}</h3>
                    <p class="mb-4">
                      Big belly rude boy, million dollar hustler. Unemployed.
                    </p>
                    <button class="btn btn-outline-primary btn-sm">
                      <span class="fa fa-twitter"></span> Follow
                    </button>
                  </div>
                </div>
@auth
   @if(count($ucap) > 0)

    <div class="row">
      <div class="col-xs-12 col-md-6">
	<div class="card">
      <div class="card-header">
        <h3 class="class-title">Ucapan pribadi saya</h3>
      </div>
      <table class="table card-table">
@foreach($ucap as $u)

        <tr>
          <td width="70%"> <a href="/ucapan/lihat/{{ $u->slug }}">{{ substr($u->ucapan,0,20).'...' }} </a><br>
            <small class="text-muted">{{ waktu($u->created_at) }}</small></td>
          <td> <a href="/ucapan/edit/{{$u->slug}}" class="btn btn-sm btn-pill btn-outline-primary">edit</a> <a href="/ucapan/delete/{{$u->slug}}" class="btn btn-sm btn-pill btn-outline-danger" onClick="if(confirm('Yakin mau ngehapus?')) { return true; } else { return false;}">hapus</a>  </td>
        </tr>
@endforeach
      </table>
        </div>
      </div>
    </div>
    @endif
 @endif
  </div>
</div>

@endsection