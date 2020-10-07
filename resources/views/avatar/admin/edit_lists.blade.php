@extends('layouts.sb-admin')

@section('title', 'Edit Avatar Lists')


@section('content')
  <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Avatar Lists</h1>
  </div>
    <div class="row">
      <div class="col-md-8">

        <div class="card shadow">
         <div class="card-body p-3">
        {!! form_open_multipart('/avatar/edit/list/'. $id, ['id' => 'store-form']) !!}

           @csrf
        <div class="form-group">
            <label class="form-label">Title (id)</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $data->title }}" required/>
        </div>

        <div class="form-group">
            <label class="form-label">Title (en) *optional</label>
            <input type="text" name="title_en" class="form-control" id="title_en" value="{{ $data->title_en }}" />
        </div>


        <div class="form-group">
            <div class="form-label">Avatar Type</div>

              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="1" class="selectgroup-input" {{ $data->type == 1 ? "checked=''" : '' }}>
                            <span class="selectgroup-button selectgroup-button-icon">Top</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="2" class="selectgroup-input" {{ $data->type == 2 ? "checked=''" : '' }}>
                            <span class="selectgroup-button selectgroup-button-icon">Bottom</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="3" class="selectgroup-input" {{ $data->type == 3 ? "checked=''" : '' }}>
                            <span class="selectgroup-button selectgroup-button-icon">Add</span>
                 </label>
              </div>
        </div>

        <div class="form-group">
            <div class="form-label">Rating bintang</div>

              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="rate" value="1" class="selectgroup-input" {{ $data->rate == 1 ? "checked=''" : '' }}>
                            <span class="selectgroup-button selectgroup-button-icon">1</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="rate" value="2" class="selectgroup-input" {{ $data->rate == 2 ? "checked=''" : '' }}>
                            <span class="selectgroup-button selectgroup-button-icon">2</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="rate" value="3" class="selectgroup-input" {{ $data->rate == 3 ? "checked=''" : '' }}>
                            <span class="selectgroup-button selectgroup-button-icon">3</span>
                 </label>
                 <label class="selectgroup-item">
                     <input type="radio" name="rate" value="4" class="selectgroup-input" {{ $data->rate == 4 ? "checked=''" : '' }}>
                            <span class="selectgroup-button selectgroup-button-icon">4</span>
                 </label>

              </div>
        </div>


        <div class="form-group">
            <label class="form-label">Rate value %</label>
            <input type="text" name="value" class="form-control" id="value" value="{{ $data->value }}"/>
        </div>


        <div class="form-group">
            <label class="form-label">Image</label>
            <div class="my-2"><img class="img" src="{{ $data->image }}" width=100%/></div>
            <input type="file" name="image" class="form-control form-control-file" id="cover" accept="image/*"/>
        </div>

        <div class="form-group">
          <button id="btn" class="btn btn-outline-primary">Save</button>
        </div>

        {!! form_close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />

  <style>

.custom-switch-input {
  position: absolute;
  z-index: -1;
  opacity: 0;
}

.custom-switches-stacked {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
}

.custom-switches-stacked .custom-switch {
  margin-bottom: .5rem;
}

.custom-switch-indicator {
  display: inline-block;
  height: 1.25rem;
  width: 2.25rem;
  background: #e9ecef;
  border-radius: 50px;
  position: relative;
  vertical-align: bottom;
  border: 1px solid rgba(0, 40, 100, 0.12);
  transition: .3s border-color, .3s background-color;
}

.custom-switch-indicator:before {
  content: '';
  position: absolute;
  height: calc(1.25rem - 4px);
  width: calc(1.25rem - 4px);
  top: 1px;
  left: 1px;
  background: #fff;
  border-radius: 50%;
  transition: .3s left;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.4);
}

.custom-switch-input:checked ~ .custom-switch-indicator {
  background: #467fcf;
}

.custom-switch-input:checked ~ .custom-switch-indicator:before {
  left: calc(1rem + 1px);
}

.custom-switch-input:focus ~ .custom-switch-indicator {
  box-shadow: 0 0 0 2px rgba(70, 127, 207, 0.25);
  border-color: #467fcf;
}

.custom-switch-description {
  margin-left: .5rem;
  color: #6e7687;
  transition: .3s color;
}

.custom-switch-input:checked ~ .custom-switch-description {
  color: #495057;
}


.custom-switch {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  cursor: default;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -ms-flex-align: center;
  align-items: center;
  margin: 0;
}
.selectgroup {
  display: -ms-inline-flexbox;
  display: inline-flex;
}

.selectgroup-item {
  -ms-flex-positive: 1;
  flex-grow: 1;
  position: relative;
}

.selectgroup-item + .selectgroup-item {
  margin-left: -1px;
}

.selectgroup-item:not(:first-child) .selectgroup-button {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.selectgroup-item:not(:last-child) .selectgroup-button {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.selectgroup-input {
  opacity: 0;
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
}

.selectgroup-button {
  display: block;
  border: 1px solid rgba(0, 40, 100, 0.12);
  text-align: center;
  padding: 0.375rem 1rem;
  position: relative;
  cursor: pointer;
  border-radius: 3px;
  color: #9aa0ac;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  font-size: 0.9375rem;
  line-height: 1.5rem;
  min-width: 2.375rem;
}

.selectgroup-button-icon {
  padding-left: .5rem;
  padding-right: .5rem;
  font-size: 1rem;
}

.selectgroup-input:checked + .selectgroup-button {
  border-color: #467fcf;
  z-index: 1;
  color: #467fcf;
  background: #edf2fa;
}

.selectgroup-input:focus + .selectgroup-button {
  border-color: #467fcf;
  z-index: 2;
  color: #467fcf;
  box-shadow: 0 0 0 2px rgba(70, 127, 207, 0.25);
}

.selectgroup-pills {
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  -ms-flex-align: start;
  align-items: flex-start;
}

.selectgroup-pills .selectgroup-item {
  margin-right: .5rem;
  -ms-flex-positive: 0;
  flex-grow: 0;
}

.selectgroup-pills .selectgroup-button {
  border-radius: 50px !important;
}
  </style>
@endsection

@section('footer')

<script src="http://wechatfe.github.io/vconsole/lib/vconsole.min.js?v=3.3.0"></script>
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        const vConsole = new VConsole()
        loadProgressBar();
    </script>
<script>
  let form = document.getElementById('store-form'),
      btn = document.getElementById('btn')


  form.addEventListener('submit', e => {
  	e.preventDefault();

    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    axios.post(e.target.action, new FormData(e.target))
    .then((res) => {
    	if(res.data.success) {
          swal('Data Avatar List telah di tambahkan', {
          	icon: 'success'
          }).then(() => window.location.href = '/avatar')
        }

      form.reset()

      btn.innerHTML = 'Save';
    }).catch(e => swal(e));

  });
</script>
@endsection