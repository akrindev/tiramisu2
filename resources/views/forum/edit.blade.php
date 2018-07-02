@extends('layouts.tabler')

@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();

$colors = ['blue','green','orange','red','yellow','teal','purple','dark','pink'];

@endphp

@section('content')

<link rel="stylesheet" href="/assets/plugins/md/simplemde.min.css">

<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col-12">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">Edit thread {{ $data->judul }}</h3>
      </div>

      <div class="card-body">
      {!! form_open() !!}

        @csrf

      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control
        {{  $errors->has('judul') ? 'is-invalid': '' }}" value="{{ $data->judul }}" required>
        @if($errors->has('judul'))
        <span class="invalid-feedback">
  			{{$errors->first('judul')}}
        </span>
        @endif
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea id="sectionBody" name="deskripsi" class="form-control{{  $errors->has('deskripsi') ? ' is-invalid': '' }}" data-provide="markdown" rows=10 required>{{ $data->body }} </textarea>
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
                            <input type="checkbox" name="tags[]" value="{{ $tag->name }}" class="selectgroup-input" {{ in_array($tag->name,explode(',',$data->tags)) ? 'checked':'' }}>
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
                                <input name="color" type="radio" value="{{ $color }}" class="colorinput-input" {{ $data->color == $color ? 'checked':'' }}/>
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