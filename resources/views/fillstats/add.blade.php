@extends('layouts.tabler')

@section('title','Tambah data Fillstats')
@section('description','Tambah data Fillstats')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      @if(session()->has('sukses'))
                  <div class="card-alert alert alert-success mb-0">
                    {{ session('sukses') }}
                  </div>
      @endif
      <div class="card-body">


      {!! form_open() !!}

        @csrf

      <div class="form-group
        {{  $errors->has('nama') ? 'has-error': '' }}">
        <label>Type</label>
        <select name="type" class="form-control">
          <option value="1">Armor</option>

          <option value="2">Weapon</option>
        </select>
        {{  $errors->has('nama') ?
  		$errors->first('nama') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('type') ? 'has-error': '' }}">
        <label>plus </label>
        <select name="plus" class="form-control">
      @for ($i=10;$i<17;$i++)
          <option value="{{ $i }}">{{ $i }}</option>
      @endfor
        </select>
        {{  $errors->has('plus') ?
  		$errors->first('plus') : ''  }}
      </div>



      <div class="form-group {{  $errors->has('stats') ? 'has-error': '' }}">
        <label>Status</label>
        <textarea name="stats" class="form-control"></textarea>
        {{  $errors->has('stats') ?
  		$errors->first('stats') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('stats') ? 'has-error': '' }}">
        <label>Steps</label>
        <textarea name="steps" class="form-control" rows=7></textarea>
        {{  $errors->has('steps') ?
  		$errors->first('steps') : ''  }}
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