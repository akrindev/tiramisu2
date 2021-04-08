@extends('layouts.tabler')


@section('title',$data->judul)
@section('description',str_limit(strip_tags(toHtml($data->body))))
@section('image',to_img($data->body))


@push('canonical')
	@canonical
@endpush
@section('content')

@php
$commentss = $comments;
$tags = $data->tags;
$tags = explode(',', $tags);
@endphp
<script type="application/ld+json">
{
  "@context":"http://schema.org",
  "@type":"DiscussionForumPosting",
  "@id":"{{ url()->current() }}",
  "headline":"{{ $data->judul }}",
  "author": {
    "@type": "Person",
    "name": "{{ $data->user->name }}"
  },
  "interactionStatistic": {
    "@type": "InteractionCounter",
    "interactionType": "http://schema.org/CommentAction",
    "userInteractionCount": {{ $comments->count()+1 }}
  }
}
</script>
        <div class="my-3 my-md-5">
          <div class="container">

	<div class="row">
	 <div class="col-md-8">

   <a href="/forum" class="btn btn-sm mb-3 btn-outline-secondary btn-pill"> <i class="fe fe-chevrons-left"></i> Back to forum</a>

   <div class="mb-3">
     <h3 class="mt-0 mb-5"> {{ $data->judul }} </h3>

 	  @includeUnless(app()->isLocal(), 'inc.ads_article')

   </div>

        <div class="card p-0">
          @if ( session()->has('sukses'))
          <div class="card-alert alert alert-success">
            {{ session('sukses') }}
          </div>
          @endif
          <div class="card-status bg-{{ $data->color }}"></div>

          <div class="card-body text-wrap p-3">

     <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="{{ $data->user->getAvatar() }}" class="avatar avatar-md float-left mr-4 lazyload"><a href="/profile/{{$data->user->provider_id }}" data-author="{{ $data->user->name }}"> <b> {{ $data->user->name }} </b></a><br>
            <small class="text-muted"> {{ waktu($data->created_at) }}  &nbsp; <i class="fe fe-eye"></i> {{ $data->views }} &nbsp; <i class="fe fe-message-square"></i> {{ $data->comment->count() }} </small>

            @if(auth()->user() && auth()->user()->id == $data->user_id)

            <a href="/forum/{{ $data->slug }}/edit" class="btn btn-sm btn-pill btn-outline-secondary float-right">edit</a>

            @endif

            <hr class="my-2">
            <i class="fe fe-folder mr-1"></i> <a href="/forum/kategori/{{ $data->category->slug }}"> {{ $data->category->name }} </a>
            <div class="my-1">
              @foreach ($tags as $tag => $n)
              <a class="tag" href="/forum/tag/{{ $n }}"> {{ $n }} </a>
              @endforeach
            </div>
            <div class="body-text">
            {{ toHtml($data->body, true) }}

              <small class="text-muted">Short link: <i><u id="srt">https://toram-id.info/f/{{ $data->id }}</u></i> <i class="ml-1 fe fe-copy" style="cursor:pointer;" onClick="copyToClipboard('srt');"></i></small>

           <div class="my-3">
             {!! form_open('/',["id"=>"likeme"]) !!}
             @csrf
             <input type="hidden" name="id" value="{{$data->id}}">
             <i onclick="$(this).submit();" id="like" class="fe fe-heart @auth {{ auth()->user()->hasLikedThread($data) ? 'text-red' :''}} @endauth" style="font-size:15px"></i> &nbsp; <span class="@auth {{ auth()->user()->hasLikedThread($data) ? 'text-red' :'text-muted'}} @endauth" id="count-liked" data-suka="{{$data->likes->count()}}">
             {{ auth()->check() ?
             	auth()->user()->hasLikedThread($data) ?
             		$data->likes->count() == 1 ?
             		'Kamu menyukai ini'	:
             		'Kamu dan ' . ($data->likes->count()-1) . ' lainnya menyukai ini'
             	: $data->likes->count() . ' menyukai ini' :
             	$data->likes->count() . ' menyukai ini'
             }}
             </span>
             {!! form_close() !!}
           </div>

  @auth

         @if (auth()->user()->role == 'admin')
            {!! form_open(url()->current().'/pin') !!}
            @csrf

            <input type="hidden" name="pinned" value="{{ $data->id }}">
              @if ($data->pinned == 0)

            <input type="hidden" name="pinthis" value="1">
            <button type="submit" class="btn btn-sm btn-pill btn-outline-success">Pin thread </button>
              @else
            <input type="hidden" name="pinthis" value="0">
            <button type="submit" class="btn btn-sm btn-pill btn-outline-danger">Unpin thread </button>
              @endif
            {!! form_close() !!}

            <button onclick="event.preventDefault(); dte()" class="float-right btn btn-sm btn-pill btn-outline-danger">hapus</button>
           {!! form_open(url()->current().'/del',['id' => 'delete-form']) !!}
            @csrf
            @method('delete')
           {!! form_close() !!}

         @endif

@endauth
            </div>
          </div>
        </div>


        <div class="my-5">
            @includeUnless(app()->isLocal(), 'inc.ads_mobile')
        </div>

   @php $i = 0; @endphp
@if (count($comments))
@foreach (collect($comments)->where('parent_id',null) as $comment)
   @php $i++; @endphp
		<div class="card p-0" id="reply{{ $comment->id }}">
          <div class="card-body p-3">
            <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="{{ $comment->user->getAvatar() }}" class="avatar avatar-md float-left mr-4 lazyload">
            <b><a href="/profile/{{$comment->user->provider_id }}" data-author="{{ $comment->user->name }}">  {{ $comment->user->name }}</a> </b> <br>
            <small class="text-muted">{{ waktu($comment->created_at) }}</small>
            <hr class="my-2">
            <div class="body-text">
            {{ toHtml($comment->body, true) }}


           <div class="my-3">

             <i id="likes" data-id="{{ $comment->id }}" class="fe fe-heart @auth {{ auth()->user()->hasLikedThreadReply($comment) ? 'text-red' :''}} @endauth" style="font-size:15px"></i>
             &nbsp;
             <span class="@auth {{ auth()->user()->hasLikedThreadReply($comment) ? 'text-red' :'text-muted'}} @endauth" id="count-liked-reply-{{ $comment->id }}" data-suka="{{$comment->likes->count()}}">
             {{ auth()->check() ?
             	auth()->user()->hasLikedThreadReply($comment) ?
             		$comment->likes->count() == 1 ?
             		'Kamu menyukai ini'	:
             		'Kamu dan ' . ($comment->likes->count()-1) . ' lainnya menyukai ini'
             	: $comment->likes->count() . ' menyukai ini' :
             	$comment->likes->count() . ' menyukai ini'
             }}
             </span>
           </div>

            </div>
            @auth
            <div class="form-group">
              @if(auth()->user()->role == 'admin')
              <button onclick="event.preventDefault(); dcm({{$comment->id}});" class="btn btn-sm btn-pill btn-outline-danger">hapus</button>
              {!! form_open('/forum/delete-comment',['id'=>'cid-'.$comment->id]) !!}
              @csrf
              @method("DELETE")
              <input type="hidden" name="cid" value="{{$comment->id}}">
              {!! form_close() !!}
              @endif
            <button class="btn btn-sm float-right btn-outline-primary" data-toggle="collapse" data-target="#comm-{{$i}}" role="button" aria-expanded="false" aria-controls="comm-{{$i}}">reply</button>
            </div>

            @endauth
          </div>
          @auth

          <div class="collapse" id="comm-{{$i}}">
            {!! form_open(url()->current().'/c') !!}
            @csrf
            <div class="card-footer">
              <div class="form-group">
                <input type="hidden" name="id" value="{{$comment->id}}">
                <textarea class="form-control" data-provide="markdown" name="reply" required></textarea>

              </div>
              <button type="submit" class="btn btn-sm btn-primary">reply</button>
            </div>
            {!! form_close() !!}
          </div>
          @endauth


          @foreach ($comment->getReply as $reply)
<hr class="my-1">
          <div id="reply{{$reply->id}}" class="p-2">
            <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="{{ $reply->user->getAvatar() }}" class="avatar avatar-md float-left mr-4 lazyload">
            <b><a href="/profile/{{$reply->user->provider_id }}" data-author="{{ $comment->user->name }}">  {{ $reply->user->name }}</a> </b> <small class="text-muted"> &nbsp; ({{ waktu($reply->created_at)}})</small><br>
            <div class="media-body body-text">
            {{ toHtml($reply->body, true) }}

              <div class="my-2 small text-right">

             <i id="likes-reply" data-id="{{ $reply->id }}" class="fe fe-heart @auth {{ auth()->user()->hasLikedThreadReply($reply) ? 'text-red' :''}} @endauth" style="font-size:15px"></i>
             &nbsp;
             <span class="@auth {{ auth()->user()->hasLikedThreadReply($reply) ? 'text-red' :'text-muted'}} @endauth" id="count-liked-reply-{{ $reply->id }}" data-suka="{{$reply->likes->count()}}">
             {{ auth()->check() ?
             	auth()->user()->hasLikedThreadReply($reply) ?
             		$reply->likes->count() == 1 ?
             		'Kamu menyukai ini'	:
             		'Kamu dan ' . ($reply->likes->count()-1) . ' lainnya menyukai ini'
             	: $reply->likes->count() . ' menyukai ini' :
             	$reply->likes->count() . ' menyukai ini'
             }}
             </span>
              </div>
            </div>
             @if(auth()->check() && auth()->user()->role == 'admin')
              <button onclick="event.preventDefault(); dcm({{$reply->id}});" class="btn btn-sm btn-pill btn-outline-danger float-right">hapus</button>
              {!! form_open('/forum/delete-comment',['id'=>'cid-'.$reply->id]) !!}
              @csrf
              @method("DELETE")
              <input type="hidden" name="cid" value="{{$reply->id}}">
              {!! form_close() !!}
              @endif
          </div>
            @endforeach

          @auth

        @if (session()->has('sukses_reply-'.$comment->id))
          <div class="card-alert alert alert-success">
            {{ session('sukses_reply-'.$comment->id) }}
          </div>
        @endif
          @endauth
   		</div>

@endforeach
@endif



   		@include('inc.forum_comment')

  </div>

     <div class="col-md-4">

                <!-- tags -->

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      Berdasarkan Tags
                    </h3>
                  </div>
                    <div class="p-0 m-0">

                      @include('inc.tags')

                    </div>

                </div>
                <!-- // tags -->

                @include('inc.menu')

              </div>

    </div>
          </div>
        </div>

@endsection

@section('head')
<link href="/assets/css/read.css" rel="stylesheet">
@endsection

@section('footer')
<script>
function copyToClipboard(elementId) {

  // Create a "hidden" input
  var aux = document.createElement("input");

  // Assign it the value of the specified element
  aux.setAttribute("value", document.getElementById(elementId).innerHTML);

  // Append it to the body
  document.body.appendChild(aux);

  // Highlight its content
  aux.select();

  // Copy the highlighted text
  document.execCommand("copy");

  // Remove it from the body
  document.body.removeChild(aux);
  alert('copied!');
}
</script>
@auth
<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>

<script src="/assets/js/forum.js?1">
</script>
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $("details").on("click", function() {
  	$("details[open]").not(this).removeAttr("open");
  })
</script>
<script>

 @if(auth()->user()->role == 'admin')
 function dte()
  {

       swal({
  title: "Yakin mau hapus data ini?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    return document.getElementById('delete-form').submit();
  } else {
    swal("Aman gan!");
  }
});

  }

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
  @endif
</script>
@endauth
@endsection