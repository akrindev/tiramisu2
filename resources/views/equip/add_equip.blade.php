@extends('layouts.tabler')

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"> Tambah data equip </h3>
      </div>

      <div class="card-body">


      {!! form_open() !!}

       @csrf

      <div class="form-group">
        <label>Nama </label>
        <input type="text" name="nama" class="form-control
        {{  $errors->has('nama') ? 'is-invalid': '' }}" value="">
        {{  $errors->has('nama') ?
  		$errors->first('nama') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('type') ? 'is-invalid': '' }}">
        <label>Type </label>  <br>
        <select name="type" class="form-control">
 @foreach(DB::table('barangs')->select('type')->distinct()->get() as $u)
          <option value="{{ $u->type }}" {{ old('type') ? 'selected' : '' }}>{{ $u->type }}</option>

 @endforeach
        </select>
        {{  $errors->has('type') ?
  		$errors->first('type') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('pics') ? 'is-invalid': '' }}">
        <label>Pics</label>
        <input type="text" name="pics" class="form-control" value="">
        {{  $errors->has('pics') ?
  		$errors->first('pics') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('stats') ? 'is-invalid': '' }}">
        <label>Status</label>
        <textarea name="stats" class="form-control"></textarea>
        {{  $errors->has('stats') ?
  		$errors->first('stats') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('drop') ? 'is-invalid': '' }}">
        <label>Drop </label>
        <textarea name="drop" class="form-control"></textarea>
        {{  $errors->has('drop') ?
  		$errors->first('drop') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('drop') ? 'is-invalid': '' }}">
        <label>Quest </label>
        <textarea name="quest" class="form-control"> </textarea>
        {{  $errors->has('quest') ?
  		$errors->first('quest') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('blacksmith') ? 'is-invalid': '' }}">
        <label>Blacksmith</label>

        <textarea name="blacksmith" class="form-control"></textarea>
        {{  $errors->has('blacksmith') ?
  		$errors->first('blacksmith') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('proc') ? 'is-invalid': '' }}">
        <label>Proses material </label>
        <input type="text" name="proc" class="form-control" value="{{  __('proc') }}">
        {{  $errors->has('proc') ?
  		$errors->first('proc') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('prod') ? 'is-invalid': '' }}">
        <label>Produksi </label>
        <textarea name="prod" class="form-control"> {{  __('prod') }}</textarea>
        {{  $errors->has('prod') ?
  		$errors->first('prod') : ''  }}
      </div>


      <button type="submit" class="btn btn-primary">Tambah</button>
      {!! form_close(); !!}



    </div>
  </div>
</div>
    </div>
  </div>
</div>

@endsection