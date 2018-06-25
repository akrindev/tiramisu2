@extends('layouts.tabler')

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">Tambah data Crysta</h3>
      </div>
      <div class="card-body">


      {!! form_open() !!}

        @csrf

      <div class="form-group
        {{  $errors->has('nama') ? 'has-error': '' }}">
        <label>Nama </label>
        <input type="text" name="nama" class="form-control" value="">
        {{  $errors->has('nama') ?
  		$errors->first('nama') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('type') ? 'has-error': '' }}">
        <label>Type </label>
        <input type="text" name="type" class="form-control" value="">
        {{  $errors->has('type') ?
  		$errors->first('type') : ''  }}
      </div>



      <div class="form-group {{  $errors->has('stats') ? 'has-error': '' }}">
        <label>Status</label>
        <textarea name="stats" class="form-control"> </textarea>
        {{  $errors->has('stats') ?
  		$errors->first('stats') : ''  }}
        </div>

      <div class="form-group {{  $errors->has('slug') ? 'has-error': '' }}">
        <label>slug </label>
        <textarea name="slug" class="form-control"></textarea>
        {{  $errors->has('slug') ?
  		$errors->first('slug') : ''  }}
      </div>

      <button type="submit" class="btn btn-primary">Tambah</button>
      {!! form_close() !!}



    </div>
  </div>
</div>

    </div>
  </div>
</div>

@endsection