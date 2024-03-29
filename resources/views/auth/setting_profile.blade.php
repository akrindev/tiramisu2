@extends('layouts.tabler')


@section('title','Pengaturan profile')
@section('description','Pengaturan profile')
@section('image',to_img())


@section('content')

<link rel="stylesheet" href="/assets/plugins/md/simplemde.min.css">

<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col-md-8">
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
		  @if($data->changed == 0)
          	<div class="input-group">
            <span class="input-group-prepend" id="basic-addon1">
              <span class="input-group-text">@</span>
             </span>
        <input type="text" name="username" class="form-control
        {{  $errors->has('username') ? 'is-invalid': '' }}" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{ $data->username }}" required>
        </div>
		  @else
		  	<div class="form-control-plaintext text-success">{{ $data->username }}</div>
		  <input type="hidden" name="username" value="{{ $data->username }}">
		  @endif
        @if($errors->has('username'))
        <span class="help-block text-danger">
  			{{$errors->first('username')}}
        </span> <br>
        @endif
        @if ($data->changed == 0)
        <small class="help-block text-muted">
          Hanya dapat di ganti sekali!
        </small>
        @endif
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
          <label class="form-label"> Jenis kelamin</label>
          <select class="form-control" name="gender">

            <option value="0" {{ $data->gender == "hode" ? 'selected':'' }}> Hode </option>

            <option value="1" {{ $data->gender == "cowok" ? 'selected':'' }}>Cowok</option>

            <option value="2" {{ $data->gender == "cewek" ? 'selected':'' }}>Cewek</option>
          </select>
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
        <div class="form-group">
          <div class="row gutters-xs">
              <div class='col-8'>
          <label class="form-label"> Buff masakan </label>
          <select class="form-control" name="cooking" id='cooking1'>
            <option value="">-- Pilih buff masakan --</option>
            @foreach(\App\Cooking::get() as $cook)
            <option value={{ $cook->id }} {{ $data->cooking_id == $cook->id ? 'selected':'' }}> {{ $cook->buff }} </option>
            @endforeach
          </select>
              </div>
          <div class='col-3'>
              <label class="form-label">Level</label>
          <input type="number" name="cooklv" class="form-control" min=1 max=10 value={{ $data->cooking_level }} placeholder="level" id='cookingval1'>
          </div>
          </div>
        </div>


        <div class="form-group">
          <div class="row gutters-xs">
              <div class='col-8'>
          <label class="form-label"> Buff masakan kedua (second)</label>
          <select class="form-control" name="second_cooking" id='cooking2'>
            <option value="">-- Pilih buff masakan --</option>
            @foreach(\App\Cooking::get() as $cook)
            <option value={{ $cook->id }} {{ $data->second_cooking_id == $cook->id ? 'selected':'' }}> {{ $cook->buff }} </option>
            @endforeach
          </select>
              </div>
          <div class='col-3'>
              <label class="form-label">Level</label>
          <input type="number" name="second_cooklv" class="form-control" min=1 max=10 value={{ $data->second_cooking_level }} placeholder="level" id='cookingval2'>
          </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            Privasi
          </label>
          <div class="custom-switches-stacked">
            <label class="custom-switch">
              <input type="radio" name="visibility" value="0" class="custom-switch-input" {{ $data->visibility == 0 ? 'checked' : '' }}>
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">Tertutup</span>
            </label>
            <label class="custom-switch">
              <input type="radio" name="visibility" value="1" class="custom-switch-input" {{ $data->visibility == 1 ? 'checked' : '' }}>
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">Publik</span>
            </label>
          </div>
          <small class="help-block text-muted">
          	Privasi ini hanya akan menampilkan list buff anda menjadi publik atau private. lihat di <a href="/cooking/berteman">Tukar buff</a>. Pastikan untuk mengisi data kontak anda agar mudah di hubungi.
          </small>
        </div>


        <div class="form-group">
          <label class="form-label">
            Email Notification
          </label>
          <div class="custom-switches-stacked">
            <label class="custom-switch">
              <input type="radio" name="subscribe" value="0" class="custom-switch-input" {{ $data->subscribe == 0 ? 'checked' : '' }}>
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">No</span>
            </label>
            <label class="custom-switch">
              <input type="radio" name="subscribe" value="1" class="custom-switch-input" {{ $data->subscribe == 1 ? 'checked' : '' }}>
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">Yes</span>
            </label>
          </div>
        </div>

        <div class="form-group">
          Since: <span class="text-muted"> {{ $data->created_at->format('d-M-Y H:i:s')}} ({{$data->created_at->diffForHumans() }}) </span>
        </div>
@method('PUT')
      <button type="submit" class="btn btn-outline-primary btn-pill">Simpan Perubahan</button>
      {!! form_close() !!}

    </div>
  </div>
</div>

  <div class="col-md-4">

  <div class="card">
    @if(session('c-sukses'))
    <div class="card-alert alert alert-success">
    {{ session('c-sukses') }}
    </div>
    @endif
    <div class="card-body">
      {!! form_open('/save/contact') !!}
      @csrf
      <b> Data kontak</b>

        <div class="form-group">
            <label class="form-label">
            ID Line:
            </label>
            <input type="text" name="line" class="form-control {{ $errors->has('line') ? 'is-invalid':''}}" value="{{$data->contact->line ?? ''}}">
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
        <input type="text" pattern="(\()?(\+62|62|0)(\d{2,3})?\)?[ .-]?\d{2,4}[ .-]?\d{2,5}" name="whatsapp" class="form-control {{ $errors->has('whatsapp') ? 'is-invalid':''}}" placeholder="contoh: +62823456789" value="{{$data->contact->whatsapp ?? ''}}">
        @if ($errors->has('whatsapp'))
        <small class="text-danger">
          {{ $errors->first('whatsapp') }}
        </small> <br>
        @endif
        <small class="text-muted">Di awali dengan kode negara</small>
      </div>

      <div class="form-group">
        <label for="facebook" class="form-label">Facebook</label>
      <input type="text" class="form-control" name="facebook" placeholder="https://facebook/.com/username" value="{{ $data->contact->facebook ?? '' }}">
      </div>

      <div class="form-group">
        <label for="twitter" class="form-label">Twitter</label>
        <input type="text" class="form-control" name="twitter" placeholder="https://twitter.com/username" value="{{ $data->contact->twitter ?? '' }}">
      </div>

      <button class="btn btn-pill btn-outline-primary" type="submit">Submit</button>

      {!! form_close() !!}
    </div>
  </div>

  <livewire:token.show>

  <div class="card mt-5">
      <div class="card-header">
          <h3 class="card-title">Delete account</h3>
      </div>
      <div class="card-body">
          <strong class="text-danger">*Once you delete your account, your data (fbid, twitterid, email, name) including login to facebook / twitter will be removed permanently from our database.</strong>
        </div>
        <div class="card-footer">

            <form action="{{ route('user.delete') }}" method="POST" id="form-user-delete">
                @csrf
                @method('delete')
                <button type="button" id="btn-delete-user" class="btn btn-danger">yes, delete</button>
            </form>
      </div>
  </div>

  </div>
    </div>
  </div>
</div>

@endsection

@section('head')
    @livewireStyles
@endsection

@section('footer')
@livewireScripts
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cooking1 = document.getElementById('cooking1')
        const cooking2 = document.getElementById('cooking2')
        const cookingval1 = document.getElementById('cookingval1')
        const cookingval2 = document.getElementById('cookingval2')

        const formDelete = document.getElementById('form-user-delete')
        const btnDelete = document.getElementById('btn-delete-user')

        btnDelete.addEventListener('click', (e) => {

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this account!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((res) => {
                if (res) {
                    formDelete.submit()
                }
            })

        })

        if(!cooking1.value) {
          cookingval1.disabled = true
        }

        if(!cooking2.value) {
          cookingval2.disabled = true
        }

        cooking1.addEventListener('change', (e) => {
            if(e.target.value) {
              cookingval1.disabled = false
              return
            }
              cookingval1.disabled = true
        })

        cooking2.addEventListener('change', (e) => {
            if(e.target.value) {
              cookingval2.disabled = false
              return
            }
              cookingval2.disabled = true
        })

    })
</script>

@endsection
