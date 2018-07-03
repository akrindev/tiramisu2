@extends('layouts.tabler')


@section('title','Pengaturan profile')
@section('description','Pengaturan profile')
@section('image',to_img())


@section('content')

<link rel="stylesheet" href="/assets/plugins/md/simplemde.min.css">

<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col-12">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">Pengaturan profile</h3>
      </div>

      @if (session()->has('sukses'))
      <div class="card-alert alert alert-success">
        {{ session('sukses') }}
      </div>
      @endif

      <div class="card-body">
      {!! form_open() !!}

        @csrf

        <div class="form-group">
          <label class="form-label">Nama</label>
          <div class="form-control-plaintext">
            {{ $data->name }}
          </div>
        </div>


      <div class="form-group">
        <label class="form-label">Username</label>
          <div class="input-group">
            <span class="input-group-prepend" id="basic-addon1">
              <span class="input-group-text">@</span>
             </span>
        <input type="text" name="username" class="form-control
        {{  $errors->has('username') ? 'is-invalid': '' }}" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{ $data->username }}" required>
        </div>
        @if($errors->has('username'))
        <span class="invalid-feedback">
  			{{$errors->first('username')}}
        </span>
        @endif
        <small class="help-block text-muted">
          Hanya dapat di ganti sekali!
        </small>
      </div>


      <div class="form-group">
        <label class="form-label">Email</label>

        <input type="email" name="email" class="form-control
        {{  $errors->has('email') ? 'is-invalid': '' }}" placeholder="Email" value="{{ $data->email }}" required>

        @if($errors->has('email'))
        <span class="invalid-feedback">
  			{{$errors->first('email')}}
        </span>
        @endif
      </div>

      <div class="form-group">
        <label class="form-label">Bio</label>
        <textarea id="sectionBody" name="biodata" class="form-control{{  $errors->has('biodata') ? ' is-invalid': '' }}" rows=5 required>{{ $data->biodata }} </textarea>
        <div class="help-block">

        @if($errors->has('biodata'))
        <small class="text-danger">
  			{{$errors->first('biodata')}}
        </small>
        @endif
          <small class="text-muted">max 160 character</small>
        </div>
      </div>


      <div class="form-group">
        <label class="form-label">Ign Toram</label>
        <input type="text" name="ign" value="{{ $data->ign }}" class="form-control {{  $errors->has('ign') ? 'is-invalid': '' }}" required>


        @if($errors->has('ign'))
        <span class="invalid-feedback">
  			{{$errors->first('ign')}}
        </span>
        @endif
        </div>


      <div class="form-group">
        <label class="form-label">Tempat tinggal</label>
        <input type="text" name="alamat" value="{{ $data->alamat }}" class="form-control {{  $errors->has('alamat') ? 'is-invalid': '' }}" required>


        @if($errors->has('alamat'))
        <span class="invalid-feedback">
  			{{$errors->first('alamat')}}
        </span>
        @endif
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