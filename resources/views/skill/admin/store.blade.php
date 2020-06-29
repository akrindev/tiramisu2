@extends('layouts.sb-admin')

@section('title', 'store skill child')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Store Skill Child</h1>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
      <div class="card-body p-3">

     {!! form_open_multipart('/admin/skill/store/child') !!}
     @csrf

      <div class="form-group">
        <label class="form-label">Icon</label>
        <div id="preview"></div>
        <input type="file" class="form-control" accept="image/*" name="icon" id="picture">
      </div>

      <div class="form-group">
        <label class="form-label">Nama skill</label>
        <input type="text" class="form-control" name="name" required>
      </div>

        <div class="form-group">
          <label class="form-label">Anggota skill</label>
          <select name="skill" id="select-type" class="form-control custom-select" required>
          @foreach((new App\Skill)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->picture }}"}'>{{ $type->name }}</option>
          @endforeach
          </select>
        </div>


     <div class="form-group">
       <label class="form-label">Skill level</label>
       <div class="selectgroup selectgroup-pills">
         @for($i = 1; 6 >= $i; $i++)
         <label class="selectgroup-item">
         <input name="level" type="radio" class="selectgroup-input" value="{{ $i }}">
           <span class="selectgroup-button">{{ $i }}</span>
         </label>
         @endfor
       </div>
     </div>

     <div class="form-group">
       <label class="form-label">Type</label>
       <div class="selectgroup selectgroup-pills">
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="active">
           <span class="selectgroup-button">active</span>
         </label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="pasif">
           <span class="selectgroup-button">passive</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="skill fisik">
           <span class="selectgroup-button">skill fisik</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="skill sihir">
           <span class="selectgroup-button">skill sihir</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="EX Skill">
           <span class="selectgroup-button">EX Skill</span></label>
       </div>
     </div>

     <div class="form-group">
       <label class="form-label">MP Cost</label>
       <input type="number" class="form-control" name="mp">
     </div>

     <div class="form-group">
       <label class="form-label">Jarak <small class="text-muted">(m)</small> </label>
       <input type="number" class="form-control" name="range">
     </div>


     <div class="form-group">
       <label class="form-label">Untuk senjata</label>
       <div class="selectgroup selectgroup-pills">

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="all">
           <span class="selectgroup-button">semua senjata</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="bg">
           <span class="selectgroup-button">bowgun</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="busur">
           <span class="selectgroup-button">busur</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="dw">
           <span class="selectgroup-button">pedang ganda</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="katana">
           <span class="selectgroup-button">katana</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="knuckle">
           <span class="selectgroup-button">tinju</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="md">
           <span class="selectgroup-button">alat sihir</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="mdsub">
           <span class="selectgroup-button">alat sihir sokongan</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="ohs">
           <span class="selectgroup-button">pedang</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="panah">
           <span class="selectgroup-button">panah</span>
         </label>


         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="pisau">
           <span class="selectgroup-button">pisau</span>
         </label>


         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="shield">
           <span class="selectgroup-button">tameng</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="ths">
           <span class="selectgroup-button">pedang raya</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="tongkat">
           <span class="selectgroup-button">tongkat</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="tombak">
           <span class="selectgroup-button">tombak</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="heavy">
           <span class="selectgroup-button">armor berat</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="light">
           <span class="selectgroup-button">armor ringan</span>
         </label>

       </div>
     </div>

     <div class="form-group">
       <label class="form-label">Combo awal</label>
       <div class="selectgroup selectgroup-pills">

         <label class="selectgroup-item">
         <input name="combo_awal" type="radio" class="selectgroup-input" value="1">
           <span class="selectgroup-button">ya</span>
         </label>
         <label class="selectgroup-item">
         <input name="combo_awal" type="radio" class="selectgroup-input" value="0">
           <span class="selectgroup-button">tidak</span>
         </label>

       </div>
     </div>

     <div class="form-group">
       <label class="form-label">Combo tengah</label>
       <div class="selectgroup selectgroup-pills">

         <label class="selectgroup-item">
         <input name="combo_tengah" type="radio" class="selectgroup-input" value="1">
           <span class="selectgroup-button">ya</span>
         </label>
         <label class="selectgroup-item">
         <input name="combo_tengah" type="radio" class="selectgroup-input" value="0">
           <span class="selectgroup-button">tidak</span>
         </label>

       </div>
     </div>

      <div class="form-group">
        <label class="form-label">Element</label>
<div class="selectgroup selectgroup-pills">
  @foreach ((new App\Element)->get() as $el)
  <label class="selectgroup-item">
    <input type="radio" name="element" class="selectgroup-input" value="{{$el->id}}">
    <span class="selectgroup-button">{{ $el->name }}</span>
  </label>
  @endforeach
        </div>
        </div>

        <div class="form-group">
          <label class="form-label">Deskripsi</label>
          <textarea name="body" data-provide="markdown" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">

        <button type="submit" class="btn btn-outline-primary btn-pill"> <i class="fe fe-edit"></i> Simpan </button>
        </div>

     {!! form_close() !!}

      </div>
    </div>
    </div>
  </div>

</div>
@endsection


@section('head')
<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" href="/assets/css/selectize.css" />


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

<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>
<script src="/assets/js/vendors/selectize.min.js"></script>


<script>
function fileReader(input, aid) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#'+aid).html('<div class="mb-3">Preview: <br> <img src="'+e.target.result+'" class="img-fluid" style="width:30px;height:30px;border-radius:50%"/></div>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<script>

  $("#picture").change(function(){
  	fileReader(this, 'preview');
  });
</script>

<script>
$('#select-type').selectize({
    render: {
      option: function (data, escape) {
        return '<div>' +
          '<span class="image"><img src="' + data.image + '" alt=""></span>' +
          '<span class="title">' + escape(data.text) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        return '<div>' +
          '<span class="image"><img src="' + data.image + '" alt=""></span>' +
          escape(data.text) +
          '</div>';
      }
    }
  });
</script>
@endsection