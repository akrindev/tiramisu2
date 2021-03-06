
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
            <img src="{{ Auth::user()->getAvatar() }}" class="avatar avatar-md float-left mr-4">
            <b> {{ Auth::user()->name }} </b><br/> &nbsp;
            <hr class="my-2">

            <textarea name="body" data-provide="markdown" class="form-control {{ $errors->has('body') ? 'is-invalid': ''}}" rows=5></textarea>
            @if($errors->has('body'))
            <div class="invalid-feedback">{{ $errors->first('body') }}
            </div>
            @endif

            <button class="btn btn-pill btn-outline-primary float-right my-3">Send</button>
          </div>
          {!! form_close() !!}
   		</div>
@else


   <a href="/fb-login" class="btn btn-outline-primary btn-block mb-5">Masuk untuk memberi komentar</a>
@endauth