@extends('layouts.tabler')


@section('title','Edit fillstats')
@section('description','Edit fillstats')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      @if(session()->has('sukses'))
                  <div class="card-alert alert alert-success mb-0">
                    {{session('sukses')}}
                  </div>
      @endif
      <div class="card-body">


      {!! form_open()!!}
@csrf
      <div class="form-group
        {{  $errors->has('type') ? 'has-error': '' }}">
        <label>Type</label>
        <select name="type" class="form-control">
          <option value="1" {{ $data->type == 1 ? 'selected':'' }}>Armor</option>

          <option value="2" {{ $data->type == 2 ? 'selected':'' }}>Weapon</option>
        </select>
        {{  $errors->has('type') ?
  		$errors->first('type') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('plus') ? 'has-error': '' }}">
        <label>plus </label>
        <select name="plus" class="form-control">
       @for ($i=10;$i<22;$i++)
          <option value="{{ $i }}" {{ $data->plus == $i ? 'selected':'' }}>{{ $i }}</option>
      @endfor
        </select>
        {{  $errors->has('plus') ?
  		$errors->first('plus') : ''  }}
      </div>



      <div class="form-group {{  $errors->has('stats') ? 'has-error': '' }}">
        <label>Status</label>
        <textarea name="stats" class="form-control">{{ $data->stats }}</textarea>
        {{  $errors->has('stats') ?
  		$errors->first('stats') : ''  }}
      </div>


      <div class="form-group {{  $errors->has('stats') ? 'has-error': '' }}">
        <label>Steps</label>
        <textarea name="steps" class="form-control">{{  $data->steps }}</textarea>
        {{  $errors->has('steps') ?
  		$errors->first('steps') : ''  }}
      </div>


      <button type="submit" class="btn btn-primary">Ubah</button>
        <a onclick="if(confirm('Hapus data ini?')){ event.preventDefault();
                                                     document.getElementById('delete-form').submit(); }else{ return false; }" href="/delete/fillstats" class="btn btn-danger">Hapus</a>
      {!! form_close() !!}


        {!! form_open('/delete/fillstats',['id' => 'delete-form']) !!}
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