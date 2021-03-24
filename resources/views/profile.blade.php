@extends('layouts.tabler')

@section('title','Profileku')
@section('description', $profile->biodata)
@section('image','https://graph.facebook.com/'.$profile->provider_id.'/picture?type=normal')


@section('content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <div class="col-md-4 mb-5">
        <img src="https://graph.facebook.com/{{$profile->provider_id}}/picture?type=normal" class="img img-fluid mr-3 float-left">
        <b> {{ $profile->name }} </b>
        <span class="text-muted"> ({{ $profile->username }}) </span>
        <br>
      <b>Ign:</b>  <span class="text-muted">  {{ $profile->ign }} <br>
        <i class="fe fe-users"></i> {{ $profile->gender }}</span><br>
        <i class="fe fe-map-pin"></i> {{ $profile->alamat }}
        <p class="text-muted">
          {{ $profile->biodata }}
        </p>

        <a href="/setting/profile" class="btn btn-link btn-sm">edit profile</a>
        <a href="{{ route('mygallery') }}" class="btn btn-link btn-sm">My Gallery</a>
        <a href="/forum/baru" class="btn btn-link btn-sm">Tulis post</a>
        <a href="/quiz/profile" class="btn btn-link btn-sm">My Quiz</a>
        <a href="/fill_stats/myformula" class="btn btn-link btn-sm">My Formula</a>

        @if(auth()->user()->isAdmin())
        <a href="/admin" class="btn btn-link btn-sm">Admin Dashboard</a>
        @endif

        <hr class="my-2">
        <div class="d-block">
            <span>Contribution point: </span> <span class="text-primary">{{ auth()->user()->contribution->point ?? 0 }}</span>
        </div>
      </div>

      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Aktifitas Forum</h4>

          </div>
          <div class="table-responsive">
          <table class="table card-table table-vcenter">
            <thead>
              <tr>
                <th> posts</th>
                <th> Menjawab </th>
                <th> views </th>
                <th class="text-red"> <i class="fe fe-heart"></i> Loves</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> {{ auth()->user()->thread->count() }} </td>
                <td> {{ auth()->user()->comment->count() }} </td>
                <td> {{ $profile->thread->sum('views') }} </td>
                <td>   {{ auth()->user()->myLovedThread->count() }} <small class="text-muted"> <i class="fe fe-heart text-red"></i> Given</small> <br />

                </td>
              </tr>
            </tbody>
          </table>
          </div>
<hr class="m-0 p-0">
           <div class="card-header mt-0">
            <h4 class="card-title">Aktifitas Gallery</h4>
          </div>
          <table class="table card-table">
            <thead>
              <tr>
                <th> images</th>
                <th> Menjawab </th>
                <th> views </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> {{ auth()->user()->gallery->count() }} </td>
                <td> {{ auth()->user()->gallerycomment->count() }} </td>
                <td> {{ $profile->gallery->sum('views') }}
              </tr>
            </tbody>
          </table>
        </div>
      </div>


   @if(count($threads) > 0)

      <div class="col-md-12">
	<div class="card">
      <div class="card-header">
        <h3 class="card-title">My Posts</h3>
      </div>
      <table class="table card-table table-striped" style="font-size:13px;font-weight:400">
@foreach($threads as $thread)

        <tr>
          <td width="80%" class="p-2"> <a href="/forum/{{ $thread->slug }}">{{ str_limit($thread->judul,50) }} </a><br>
            <small class="text-muted">{{ waktu($thread->created_at) }} <br /><i class="fe fe-eye"></i> {{ $thread->views }}   <i class="fe fe-message-square"></i> {{ $thread->comment->count() }}   <i class="fe fe-heart"></i> {{ $thread->likes->count() }}</small> </td>

          <td class="p-2"> <a href="/forum/{{$thread->slug}}/edit" class="text-primary">edit</a> |
              <a onclick="event.preventDefault(); dcm({{$thread->id}});" class="text-danger">hapus</a>
              {!! form_open('/forum/'.$thread->slug.'/delete',['id'=>'cid-'.$thread->id]) !!}
              @csrf
              @method("DELETE")
              <input type="hidden" name="cid" value="{{$thread->id}}">
              {!! form_close() !!}</td>

        </tr>
@endforeach
      </table>
      {{ $threads->links() }}

       </div>
      </div>
   @endif

  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"> Notifikasi </h3>
  <div class="card-options">
    <a href="/profile/notifikasi" class="btn btn-sm btn-pill btn-outline-primary float-right">Lihat semua</a>
        </div>
      </div>
@if(count($profile->notifications) > 0)
      <div class="card-body p-1">
      @foreach (collect($profile->notifications)->take(5) as $notify)
      <i class="fe fe-check"></i>  <b> {{ $notify->data['by'] }} </b>
        <a href="{{$notify->data['link']}}">
      {{ $notify->data['message'] }}
        </a> {{ $notify->created_at->diffForHumans() }}
      <br>
      @endforeach
      </div>
@else
      <div class="card-body">
      <b> belum ada notif :') </b>
      </div>
@endif
    </div>
      </div>

    </div>

  </div>
</div>

@endsection

@section('footer')

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   function dcm(i)
  {
    swal({
      title: "Yakin mau hapus ini?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        return document.getElementById('cid-'+i).submit();
      } else {
        swal("Aman gan!");
      }
    });

  }
</script>
@endsection
