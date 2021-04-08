@auth
		<div class="card p-0">
          {!! form_open() !!}
          @csrf
        @if (session()->has('sukses_comment'))
          <div class="card-alert alert alert-success">
            {{ session('sukses_comment') }}
          </div>
        @endif
          <div class="card-body p-3">
            <img src="{{ auth()->user()->getAvatar() }}" class="avatar avatar-md float-left mr-4">
            <b> {{ auth()->user()->name }} </b><br/> &nbsp;
            <hr class="my-2">

            <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid': ''}}" rows=5 required></textarea>
            @if($errors->has('body'))
            <div class="invalid-feedback">{{ $errors->first('body') }}
            </div>
            @endif

            <button type="submit" class="btn btn-pill btn-outline-primary float-right my-3">Komentari</button>
          </div>
          {!! form_close() !!}
   		</div>
@else


   <a href="/fb-login" class="btn btn-outline-primary btn-block mb-5">Masuk untuk berkomentar</a>
@endauth