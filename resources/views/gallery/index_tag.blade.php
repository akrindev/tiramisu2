@extends('layouts.tabler')

@section('title','Toram Gallery tag '. $tag)
@section('description','Toram Online '. $tag .' gallery, images, foto garam, cinta, hoax dan lainnya')



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
              <h1 class="page-title">
                Gallery tag #{{ $tag }}
              </h1>
              <div class="page-subtitle">Total {{ $total }} images </div>
            </div>

@auth
@endauth
            <a href="/gallery" class="btn btn-outline-primary btn-pill mb-5">Back to gallery</a>


            <div id="ad" class="row">
              <div class="col-12">
              @includeUnless(app()->isLocal(), 'inc.ads_article')
              </div>
            </div>

            <div class="row row-cards">
       @if ($data->count() > 0)
              @foreach ($data as $pos)
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <a href="/gallery/{{$pos->id}}" class="mb-3">
                    <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="{{ $pos->gambar }}" alt="Photo by {{ $pos->user->name }}" class="rounded lazyload">
                  </a>
                  <div class="mb-2 body-text"> {!!
      preg_replace('/#(\w+)/',"<a href='/gallery/tag/\\1'>#\\1</a>",$pos->body) !!}
  @auth
    @if (auth()->user()->role == 'admin' || auth()->id() == $pos->user_id)
                    <br><br>
                  <button onclick="dg({{$pos->id}})" class="btn btn-sm btn-pill btn-outline-danger float-right">hapus</button>
         {!! form_open('/gallery/destroy',['id'=>'gid'.$pos->id]) !!}
                    @csrf
                    @method("DELETE")
         <input type="hidden" name="id" value="{{$pos->id}}">
          {!! form_close() !!}

    @endif
  @endauth
                  </div>
                  <div class="d-flex align-items-center px-2">
                    <div class="mr-3" style=""><img src="https://graph.facebook.com/{{$pos->user->provider_id}}/picture?type=normal" class="avatar avatar-md"></div>
                    <div>
                      <div>{{ $pos->user->name }}  </div>
                      <small class="d-block text-muted">{{ $pos->created_at->diffForHumans() }} .

                        <i class="fe fe-message-square"></i> {{ $pos->comments->count() }} <i class="fe fe-eye"></i> {{ $pos->views }}
                     </small>

                    </div>
                    <div class="ml-auto text-muted">
<!--                       <a href="javascript:void(0)" class="icon"><i class="fe fe-eye mr-1"></i></a>
                      <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 42</a> -->
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
       @else
              <div class="col-12">
                Tidak ada gambar
              </div>
        @endif

              {{ $data->links() }}

            </div>

   </div>
</div>
@endsection

@section('footer')
<script>
function fileReader(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#preview').html('Preview: <img src="'+e.target.result+'" class="img-fluid"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
 $("#gambar").change(function(){
   fileReader(this);
 })
</script>


@auth

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

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
@endauth

@endsection
