@extends('layouts.tabler')

@section('title','Toram '.$pos->user->name)
@section('description',$pos->body)
@section('image',$pos->gambar)
@section('content')
<style>

  p.body-text, div.body-text {
     -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size:13px;
    font-family:'Source Sans Pro';
    font-weight:400;
  }
</style>

 <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <a href="/gallery" class="btn btn-outline-secondary btn-pill btn-sm"><i class="fe fe-chevron-left"></i> Back to gallery</a>
            </div>

            <div class="row row-cards">

              <div class="col-sm-12">

                @if(session()->has('sukses'))
                <div class="alert alert-success">
                  {{ session('sukses') }}
                </div>
                @endif
                <div class="card p-3">
                  <div class="row">
                  <div class="col-sm-6">
                  <a href="javascript:void(0)" class="mb-3">
                    <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="{{ $pos->gambar }}" alt="Photo by {{ $pos->user->name }}" class="rounded lazyload">
                  </a>
                  </div>
                  <div class="col-sm-6">
                           <div class="d-flex align-items-center px-2 py-2">
                    <div class="mr-3" style=""><img src="https://graph.facebook.com/{{$pos->user->provider_id}}/picture?type=normal" class="avatar avatar-md"></div>
                    <div>
                      <div><a href="/profile/{{$pos->user->provider_id}}">{{ $pos->user->name }}</a> </div>
                      <small class="d-block text-muted">{{ $pos->created_at->diffForHumans() }} . <i class="fe fe-message-square"></i> {{ $pos->comment->count() }} <i class="fe fe-eye"></i> {{ $pos->views }} </small>
                    </div>
                    </div>
                  <div class="my-2 body-text"> {!!
      preg_replace('/#(\w+)/',"<a href='/gallery/tag/\\1'>#\\1</a>",$pos->body) !!}
                     @auth
    @if (auth()->user()->role == 'admin' || auth()->id() == $pos->user_id)
                    <br><br>
                  <button onclick="dg({{$pos->id}})" class="btn btn-sm btn-pill btn-outline-danger float-right">hapus</button> <a href="/gallery/{{$pos->id}}/edit" class="btn btn-sm btn-pill btn-outline-secondary">edit</a>
         {!! form_open('/gallery/destroy',['id'=>'gid'.$pos->id]) !!}
                    @csrf
                    @method("DELETE")
         <input type="hidden" name="id" value="{{$pos->id}}">
          {!! form_close() !!}

    @endif
  @endauth
                    </div>

                    <div class="ml-auto text-muted">
<!--                       <a href="javascript:void(0)" class="icon"><i class="fe fe-eye mr-1"></i></a>
                      <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 42</a> -->
                    </div>
                  </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">

     @if ($comments->count() > 0)
      <div class="col-12">
     	@foreach ($comments as $comment)

		<div class="card p-0">
          <div class="card-body p-3">
            <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="https://graph.facebook.com/{{$comment->user->provider_id}}/picture?type=normal" class="avatar avatar-md float-left mr-4 lazyload">
            <b><a href="/profile/{{$comment->user->provider_id }}">  {{ $comment->user->name }}</a> </b> <br>
            <small class="text-muted">{{ waktu($comment->created_at) }}</small>
            <hr class="my-2">
            <div class="body-text">{!!
      preg_replace('/#(\w+)/',"<a href='/gallery/tag/\\1'>#\\1</a>",$comment->body) !!}
            </div>
            @auth
            <div class="form-group">
              @if(auth()->user()->role == 'admin')
              <button onclick="event.preventDefault(); dcm({{$comment->id}});" class="btn btn-sm btn-pill btn-outline-danger">hapus</button>
              {!! form_open('/gallery/destroy/comment',['id'=>'cid-'.$comment->id]) !!}
              @csrf
              @method("DELETE")
              <input type="hidden" name="id" value="{{$comment->id}}">
              {!! form_close() !!}
              @endif
            </div>

            @endauth
          </div>
      		</div>
        @endforeach
      </div>
     @endif
      <div class="col-12">
        @include('inc.gallery_comment')
      </div>


            </div>

   </div>
</div>
@endsection

@section('footer')


@auth
 @if (auth()->user()->role == 'admin')

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

  function dcm(i)
  {
    swal({
      title: "Yakin mau hapus komentar ini?",
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

   function dg(i)
  {
       swal({
        title: "Yakin mau hapus gambar ini?",
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