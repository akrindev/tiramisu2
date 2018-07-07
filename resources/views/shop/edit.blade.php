@extends('layouts.tabler')

@section('title','Edit barang')
@section('description','Edit barang')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>

    <div class="col">
   	 <div class="card">
@if(session()->has('sukses'))
       <div class="card-aler alert alert-success">
         {{ session('sukses')}}
       </div>
@endif
      <div class="card-header">
        <h3 class="card-title">Edit barang / items</h3>
      </div>
      <div class="card-body">


      {!! form_open_multipart() !!}

        @csrf

      <div class="form-group
        {{  $errors->has('nama') ? 'is-invalid': '' }}">
        <label class="form-label">Apa yang kamu jual? </label>
        <input type="text" name="nama" class="form-control" value="{{$data->nama_barang}}">
        {{  $errors->has('nama') ?
  		$errors->first('nama') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('harga') ? 'is-invalid': '' }}">
        <label class="form-label">Harga </label>
        <input type="number" name="harga" class="form-control" value="{{$data->harga}}">
        {{  $errors->has('harga') ?
  		$errors->first('harga') : ''  }}
        <small class="text-muted">dalam bentuk spina</small>
      </div>



      <div class="form-group {{  $errors->has('kategori') ? 'is-invalid': '' }}">
        <label class="form-label">Kategori </label>
      <select class="form-control" name="kategori">
        @foreach ($kategori as $kat)
        <option value="{{$kat->id}}" {{ $data->cat_id == $kat->id ? 'selected':''}}>{{$kat->name}}</option>
        @endforeach
        </select>
  {{  $errors->has('kategori') ?
        $errors->first('kategori') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('deskripsi') ? 'is-invalid': '' }}">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control"> {{$data->deskripsi}}</textarea>
        {{  $errors->has('deskripsi') ?
  		$errors->first('deskripsi') : ''  }}
        </div>

      <div class="form-group {{  $errors->has('screenshot') ? 'is-invalid': '' }}">
        <label class="form-label">Screenshot / foto</label>
        <div id="preview">
        <img src="{{$data->gambar}}">
        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input mr-5" name="screenshot" id="gambar" accept="image/*">
                          <label class="custom-file-label"></label>
                        </div>
        {{  $errors->has('screenshot') ?
  		$errors->first('screenshot') : ''  }}
      </div>

      <button type="submit" class="btn btn-outline-primary btn-pill">Jual</button>

      {!! form_close() !!}

{!! form_open('/shop/delete') !!}
@csrf
 @method("DELETE")
        <input type="hidden" name="id" value="{{$data->id}}">
        <button type="submit" class="btn btn-danger float-right">Hapus</button>
 {!! form_close() !!}
    </div>
  </div>
	</div>

    </div>
  </div>
</div>

@endsection


@section('footer')
<script>
function fileReader(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#preview').html('Preview: <img src="'+e.target.result+'" class="img-fluid mb-3"/><br/>');
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
@endsection