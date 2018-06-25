@extends('layouts.tabler')

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      <div class="card-body">

        <h3>Edit {{ $data->nama }}</h3>
      {!! form_open() !!}

        @csrf

      <div class="form-group">
        <label>Nama </label>
        <input type="text" name="nama" class="form-control {{  $errors->has('nama') ? 'is-invalid': '' }}" value="{{ $data->nama ?? '' }}">
        {{  $errors->has('nama') ?
  		$errors->first('nama') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('type') ? 'is-invalid': '' }}">
        <label>Type </label>
        <select name="type" class="form-control">
  @foreach(DB::table('barangs')->select('type')->distinct()->get() as $u)
          <option value="{{ $u->type }}" {{  $u->type == $data->type ? 'selected' : '' }}>{{ $u->type }}</option>
  @endforeach
        </select>
        {{  $errors->has('type') ?
  		$errors->first('type') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('pics') ? 'is-invalid': '' }}">
        <label>Pics</label><br>
        {!!  $data->pics ? "<img src=/$data->pics class'img-responsive'>" : ''  !!}<br>
        <input type="radio" name="gantipics" value="ya"> Ganti pics<br>
        <input type="text" name="pics" class="form-control" value="{{ $data->pics }}">
        {{  $errors->has('pics') ?
  		$errors->first('pics') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('stats') ? 'is-invalid': '' }}">
        <label>Status</label>
        <textarea name="stats" class="form-control">{{ $data->stats }}</textarea>
        {{  $errors->has('stats') ?
  		$errors->first('stats') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('drop') ? 'is-invalid': '' }}">
        <label>Drop </label>
        <textarea name="drop" class="form-control">{{ $data->drop }}</textarea>
        {{  $errors->has('drop') ?
  		$errors->first('drop') : '' }}
      </div>


      <div class="form-group {{  $errors->has('drop') ? 'is-invalid': '' }}">
        <label>Quest </label>
        <textarea name="quest" class="form-control">{{ $data->quest }}</textarea>
        {{  $errors->has('quest') ?
  		$errors->first('quest') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('blacksmith') ? 'is-invalid': '' }}">
        <label>Blacksmith</label>

        <textarea name="blacksmith" class="form-control">{{ $data->blacksmith }}</textarea>
        {{  $errors->has('blacksmith') ?
  		$errors->first('blacksmith') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('proc') ? 'is-invalid': '' }}">
        <label>Proses material </label>
        <input type="text" name="proc" class="form-control" value="{{ $data->proc }}">
        {{  $errors->has('proc') ?
  		$errors->first('proc') : '' }}
      </div>


      <div class="form-group {{  $errors->has('prod') ? 'is-invalid': '' }}">
        <label>Produksi </label>
        <textarea name="prod" class="form-control">{{ $data->prod }}</textarea>
        {{  $errors->has('prod') ?
  		$errors->first('prod') : '' }}
      </div>


      <button type="submit" class="btn btn-primary">Ubah</button>
        <a onclick="if(confirm('Hapus data ini?')){ event.preventDefault();
                                                     document.getElementById('delete-form').submit(); }else{ return false; }" href="/edit/{{ $data->id }}/equip/delete" class="btn btn-danger">Hapus</a>


      {!! form_close() !!}

        {!! form_open('/edit/equip/delete',['id' => 'delete-form']) !!}
        <input type="hidden" name="id" value="{{ $data->id }}">
 @csrf
        @method("DELETE")

        {!! form_close() !!}
    </div>
  </div>

    </div>
  </div>
</div>

@endsection