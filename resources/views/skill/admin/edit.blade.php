@extends('layouts.sb-admin')

@section('title', 'Edit Data Skill')


@section('content')
  <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Skill</h1>
  </div>
    <div class="row">
      @if(session('sukses'))
      <div class="alert alert-success">{{ session('sukses') }}</div>
      @endif
      <div class="col-md-8">

        <div class="card shadow">
         <div class="card-body p-3">
        {!! form_open_multipart('/admin/skill/store', ['id' => 'skill-form']) !!}

           @csrf
        <div class="form-group">
            <label class="form-label">Nama Skill</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

            <div class="form-group">
              <div class="form-label">
                Skill type
              </div>
              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="weapon" class="selectgroup-input" checked="">
                            <span class="selectgroup-button selectgroup-button-icon">Weapon</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="buff" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">Buff</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="assist" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">Assist</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="others" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">Others</span>
                 </label>

              </div>
            </div>

           <div class="form-group">
            <label class="form-label">Skill icon </label>
             <div id="preview"></div>
            <input type="file" name="icon" id="picture" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
          <button id="save" class="btn btn-primary">Save Skill</button>
        </div>

        {!! form_close() !!}

           <hr>


        @foreach($skills->groupBy('type') as $skill => $child)
        <div class="mb-5">
        <h4>{{ ucfirst($skill) }}</h4>

          @foreach($child as $kid)
        <div class="mb-2">
        <img src="{{ $kid->picture }}" alt="{{ $kid->name }}" class="avatar avatar-md mr-4" style="width:30px;height:30px;border-radius:50%" id="icon{{ $kid->id }}"> <a href="/skill/{{ $kid->id }}" id="skill{{ $kid->id }}"> {{ $kid->name }} </a> [<a href="#" class="text-muted editSkill" data="{{ $kid->id }}" data-type="{{ $kid->type }}">edit</a>] </div>


          @endforeach
        </div>

        @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      {!! form_open_multipart('/admin/skill/save',['id'=>'save-skill']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Skill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        @csrf
        <input type="hidden" name="id" id="mape">
        <div class="form-group">
            <label class="form-label">Nama Skill</label>
            <input type="text" name="name" id="sname" class="form-control">
        </div>

            <div class="form-group">
              <div class="form-label">
                Skill type
              </div>
              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="weapon" class="selectgroup-input" id="stype" checked="">
                            <span class="selectgroup-button selectgroup-button-icon">Weapon</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" id="stype" value="buff" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">Buff</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" id="stype" value="assist" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">Assist</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" id="stype" value="others" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">Others</span>
                 </label>

              </div>
            </div>

           <div class="form-group">
            <label class="form-label">Skill icon </label>
             <div id="spreview"></div>
            <input type="file" name="icon" id="spicture" class="form-control" accept="image/*">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="simpan">Save</button>
      </div>

        {!! form_close() !!}
    </div>
  </div>
</div>

@endsection

@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
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
<script src="/assets/js/vendors/selectize.min.js"></script>

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
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

  $("#spicture").change(function(){
  	fileReader(this, 'spreview');
  });
</script>
<script>
$(".editSkill").click(function(e) {
	e.preventDefault();

  	var id = $(this).attr('data');
  	var type = $(this).data('type');
  	var name = $("#skill" + id).text();
  	var icon = $("#icon" + id).attr('src');

  	$("#mape").val(id);
  	$("#sname").val(name);
  	$("#stype[value="+ type +"]").prop('checked', 'checked');
  	$("#spreview").html('<img style="width:30px;height:30px;border-radius:50%;margin-bottom:5px" src="'+icon+'"/>');
  	$("#exampleModal").modal('show');
});
</script>
<script>
let simpan = document.getElementById("save-skill");

  simpan.addEventListener("submit", (e) => {

  	document.getElementById("simpan").innerHTML = '<i class="fa fa-spinner fa-spin"></i> menyimpan';
  });
</script>

@endsection