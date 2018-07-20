@extends('layouts.tabler')

@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();

$colors = ['blue','green','orange','red','yellow','teal','purple','dark','pink'];

@endphp

@section('title','Buat thread forum baru')
@section('description','Buat thread forum baru')
@section('image',to_img())
@section('content')

<link rel="stylesheet" href="/assets/plugins/md/simplemde.min.css">

<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col-12">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">Tulis baru</h3>
      </div>

      <div class="card-body">
      {!! form_open() !!}

        @csrf

      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control
        {{  $errors->has('judul') ? 'is-invalid': '' }}" required>
        @if($errors->has('judul'))
        <span class="invalid-feedback">
  			{{$errors->first('judul')}}
        </span>
        @endif
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea id="sectionBody" name="deskripsi" class="form-control{{  $errors->has('deskripsi') ? ' is-invalid': '' }}" data-provide="markdown" rows=10 required></textarea>
        <div class="help-block">

        @if($errors->has('deskripsi'))
        <small class="text-danger">
  			{{$errors->first('deskripsi')}}
        </small>
        @endif
          <small class="text-muted">Markdown supported!</small>
        </div>
      </div>


      <div class="form-group">
        <label class="form-label">Tags</label>

            <div class="selectgroup selectgroup-pills {{  $errors->has('tags') ? 'is-invalid': '' }}">
          @foreach ($tags as $tag)
                          <label class="selectgroup-item">
                            <input type="checkbox" name="tags[]" value="{{ $tag->name }}" class="selectgroup-input" {{ $tag->name == 'umum' ? 'checked':'' }}>
                            <span class="selectgroup-button">{{ $tag->name }}</span>
                          </label>
          @endforeach
        </div>

        @if($errors->has('tags'))
        <span class="invalid-feedback">
  			{{$errors->first('tags')}}
        </span>
        @endif

        <div class="help-block text-muted">
          <small>Minimal 1 max 4 tags!</small>
        </div>
        </div>
  <div class="form-group">
                          <label class="form-label">Pilih warna</label>
                          <div class="row gutters-xs">

         @foreach ($colors as $color)
                            <div class="col-auto">
                              <label class="colorinput">
                                <input name="color" type="radio" value="{{ $color }}" class="colorinput-input" />
                                <span class="colorinput-color bg-{{$color}}"></span>
                              </label>
                            </div>
         @endforeach
    </div>
        </div>
      <button type="submit" class="btn btn-primary">Publish</button>
      {!! form_close() !!}



    </div>
  </div>
</div>

  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"> Image uploader </h3>
      </div>

      <div class="card-body">
{!! form_open_multipart('/uploader',['id'=>'my-upload']) !!}
        @csrf
        <div class="form-group">
          <label class="form-label">Upload image</label>
          <div id="preview"></div>

   <div class="custom-file">
       <input type="file" class="custom-file-input mr-5" name="gambar" id="gambar" accept="image/*">
       <label class="custom-file-label"></label>
    </div>

        </div>

        <button type="submit" class="btn btnku btn-pill btn-outline-primary">Unggah</button>
{!! form_close() !!}
        <hr class="my-2">

        <div class="form-group">
          <label class="form-result">Result</label>
          <input type="text" class="form-control" id="result" value="">
          <small class="text-muted dsc"></small>
        </div>
      </div>

    </div>
  </div>
    </div>
  </div>
</div>

@endsection

@section('head')

<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>

@endsection

@section('footer')

<script>
function fileReader(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#preview').html('Preview: <img src="'+e.target.result+'" class="img-fluid mb-2"/>');
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

<script>
  $(document).ready(function(){

      $('#my-upload').on('submit', function(e){
        e.preventDefault();
        var token = '{{ csrf_token() }}';
        var form = e.target;
        var data = new FormData(form);
        $('input[name="_token"]').val(token);

        $.ajax({
          xhr: function() {
    		var xhr = new window.XMLHttpRequest();

    		xhr.upload
              .addEventListener(
              	"progress",
                function(evt) {
      				if (evt.lengthComputable) {
        			var percentComplete = evt.loaded / evt.total;
        			percentComplete = parseInt(percentComplete * 100);

            $(".btnku").html('<i class="fa fa-spinner fa-spin"></i> Mengunggah... ('+percentComplete+'%)')
              .addClass('disabled');
      		}
   			 }, false);

    		return xhr;
 		  },
          type:'POST',
          url: form.action,
          method: form.method,
          processData: false,
          contentType: false,
          data: data,
          processData: false,
          beforeSend:function(){
          },
          success: function(data){

            $('#result').val(data.url).focus().addClass('is-valid').select();
            $(".btnku").text('Upload')
            .removeClass('disabled');

            token = data.token;
            $(".dsc").text("copy url");
          },
          error:function(j,t,e){
            alert('terjadi kesalahan');

            $(".btnku").text('Upload')
            .removeClass('disabled');
          }
        })
      })
    })
</script>
@endsection