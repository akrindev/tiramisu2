@extends('layouts.tabler')

@section('title','Jual barang')
@section('description','Jual barang')
@section('image',to_img())

@section('content')
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>

  @if (auth()->user()->contact)

    <div class="col">
   	 <div class="card">

      <div class="card-header">
        <h3 class="card-title">Jual barang / items</h3>
      </div>
      <div class="card-body">


      {!! form_open_multipart() !!}

        @csrf

      <div class="form-group
        {{  $errors->has('nama') ? 'is-invalid': '' }}">
        <label class="form-label">Apa yang kamu jual? </label>
        <input type="text" name="nama" class="form-control" value="">
        {{  $errors->has('nama') ?
  		$errors->first('nama') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('harga') ? 'is-invalid': '' }}">
        <label class="form-label">Harga </label>
        <input type="number" name="harga" class="form-control" value="">
        {{  $errors->has('harga') ?
  		$errors->first('harga') : ''  }}
        <small class="text-muted">dalam bentuk spina</small>
      </div>



      <div class="form-group {{  $errors->has('kategori') ? 'is-invalid': '' }}">
        <label class="form-label">Kategori </label>
      <select class="form-control" name="kategori">
        @foreach ($kategori as $kat)
        <option value="{{$kat->id}}">{{$kat->name}}</option>
        @endforeach
        </select>
  {{  $errors->has('kategori') ?
        $errors->first('kategori') : ''  }}
      </div>

      <div class="form-group {{  $errors->has('deskripsi') ? 'is-invalid': '' }}">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control"> </textarea>
        {{  $errors->has('deskripsi') ?
  		$errors->first('deskripsi') : ''  }}
        </div>

      <div class="form-group {{  $errors->has('screenshot') ? 'is-invalid': '' }}">
        <label class="form-label">Screenshot / foto</label>
        <div id="preview"></div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input mr-5" name="screenshot" id="gambar" accept="image/*">
                          <label class="custom-file-label"></label>
                        </div>
        {{  $errors->has('screenshot') ?
  		$errors->first('screenshot') : ''  }}
      </div>

      <button type="submit" class="btn btn-outline-primary btn-pill">Jual</button>

      {!! form_close() !!}



    </div>
  </div>
	</div>
  @else

  <div class="card">
    <div class="card-body">
      {!! form_open('/save/contact') !!}
      @csrf
      <b> Untuk melanjutkan silahkan isi data berikut</b>

      <div class="form-group">
        <label class="form-label">
          ID Line:
        </label>
        <input type="text" name="line" class="form-control {{ $errors->has('line') ? 'is-invalid':''}}" required>
        @if ($errors->has('line'))
        <small class="text-danger">
          {{ $errors->first('line') }}
        </small>
        @endif
      </div>

      <div class="form-group">
        <label class="form-label">
          No. Whatsapp:
        </label>
        <input type="text" pattern="(\()?(\+62|62|0)(\d{2,3})?\)?[ .-]?\d{2,4}[ .-]?\d{2,4}" name="whatsapp" class="form-control {{ $errors->has('whatsapp') ? 'is-invalid':''}}" placeholder="contoh: +62823456789" value="" required>
        @if ($errors->has('whatsapp'))
        <small class="text-danger">
          {{ $errors->first('whatsapp') }}
        </small>
        @endif
        <small class="text-muted">Di awali dengan kode negara</small>
      </div>

      <button class="btn btn-pill btn-outline-primary" type="submit">Submit</button>

      {!! form_close() !!}
    </div>
  </div>

  @endif

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