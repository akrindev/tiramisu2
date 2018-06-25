@extends('layouts.tabler')

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">Edit {{ $data->nama }}</h3>
      </div>
      @if(session()->has('sukses'))
      <div class="card-alert alert alert-success">
        {{ session('sukses') }}
      </div>
      @endif
      <div class="card-body">


      {!! form_open() !!}

      <div class="form-group
        {{  $errors->has('nama') ? 'has-error': '' }}">
        <label>Nama </label>
        <input type="text" name="nama" class="form-control" value="{{ $data->nama ?? '' }}">
        {{  $errors->has('nama') ?
  		$errors->first('nama') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('type') ? 'has-error': '' }}">
        <label>Type </label>
        <input type="text" name="type" class="form-control" value="{{ $data->type ?? '' }}">
        {{  $errors->has('type') ?
  		$errors->first('type') : ''  }}
      </div>



      <div class="form-group {{  $errors->has('stats') ? 'has-error': '' }}">
        <label>Status</label>
        <textarea name="stats" class="form-control">{{ $data->stats }}</textarea>
        {{  $errors->has('stats') ?
  		$errors->first('stats') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('slug') ? 'has-error': '' }}">
        <label>Slug </label>
        <input type="text" name="slug" class="form-control" value="{{ $data->slug }}">
        {{  $errors->has('slug') ?
  		$errors->first('slug') : ''  }}
      </div>



      <button type="submit" class="btn btn-primary">Ubah</button>


        <a onclick="if(confirm('Hapus data ini?')){ event.preventDefault();
                                                     document.getElementById('delete-form').submit(); }else{ return false; }" href="/edit/{{ $data->id }}/crysta/delete" class="btn btn-danger">Hapus</a>

        @csrf

      {!! form_close() !!}


        {!! form_open('/edit/crysta/delete',['id' => 'delete-form']) !!}
        <input type="hidden" name="id" value="{{ $data->id }}">
 @csrf
        @method("DELETE")

        {!! form_close() !!}

    </div>
  </div>
</div>

    </div>
  </div>
</div>

@endsection