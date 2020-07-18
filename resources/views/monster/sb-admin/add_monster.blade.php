@extends('layouts.sb-admin')

@section('content')
  <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Monster</h1>
  </div>
    <div class="row">
      <div class="col-md-8">

        <div class="card shadow">
          <div class="card-alert alert alert-info">Jika data drop item tidak di temukan, tambah data dropnya <a href="/item/drop/store">disini</a>
          </div>

        <div class="card-body p-3" style="font-size:13px;font-weight:400">

          {!! form_open_multipart('/mons/store/mobs',["id"=>"mons-catcher"]) !!}
          @csrf

          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" required>
          </div>

      <div class="form-group">
        <label class="form-label">Type</label>
<div class="selectgroup selectgroup-pills">
  <label class="selectgroup-item">
    <input type="radio" name="type" class="selectgroup-input" value="1" checked>
    <span class="selectgroup-button">Normal mons</span>
  </label>
   <label class="selectgroup-item">
    <input type="radio" name="type" class="selectgroup-input" value="2">
    <span class="selectgroup-button">Mini Boss</span>
  </label>
   <label class="selectgroup-item">
    <input type="radio" name="type" class="selectgroup-input" value="3">
    <span class="selectgroup-button">Boss</span>
  </label>
        </div>

        </div>

          <div class="form-group">
            <label class="form-label">Map</label> <br>
            <select name="map" id="map" class="form-control custom-select" required>
              <option value=""></option>
            @foreach ((new App\Map)->get() as $map)
              <option value="{{$map->id}}">{{ $map->name }}</option>
            @endforeach
            </select>
          </div>


          <div class="form-group">
            <label class="form-label">Bisa dijadikan pet?</label>
            <label class="custom-switch">
               <input type="checkbox" name="pet" class="custom-switch-input">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description"></span>
             </label>
          </div>

          <div class="row">
            <div class="col-4">

          <div class="form-group">
            <label class="form-label">level</label>
            <input type="number" class="form-control" name="level" required>
          </div>

            </div>

            <div class="col-4">

          <div class="form-group">
            <label class="form-label">HP</label>
            <input type="number" class="form-control" name="hp">
          </div>
            </div>


            <div class="col-4">

          <div class="form-group">
            <label class="form-label">XP</label>
            <input type="number" class="form-control" name="xp">
          </div>
            </div>
          </div>

          <div class="form-group d-block">
            <label class="form-label">Drop items</label>
            <select id="drop-item" class="form-control" multiple="multiple" name="drop[]" required>
            </select>
          </div>

      <div class="form-group d-block">
        <label class="form-label">Element</label>
<div class="selectgroup selectgroup-pills">
  @foreach ((new App\Element)->get() as $el)
  <label class="selectgroup-item">
    <input type="radio" name="element" class="selectgroup-input" value="{{$el->id}}" {{ $loop->first ? 'checked':'' }}>
    <span class="selectgroup-button">{{ $el->name }}</span>
  </label>
  @endforeach
        </div>

        </div>

          <div class="form-group">
            <label class="form-label">Screenshot</label>
            <div id="preview"></div>
            <input type="file" name="picture" class="form-control" accept="image/*" id="picture">
          </div>


          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>
          </div>

          {!! form_close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" >
 <link rel="stylesheet" type="text/css" href="/assets/css/selectize.css">
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

select.form-control:not([size]):not([multiple]) {
  height: 2.375rem;
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
  $('#map').selectize({
    render: {
      option: function (data, escape) {
        return '<div>' +
          '<span class="title">' + escape(data.text) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        return '<div>' +
          escape(data.text) +
          '</div>';
      }
    }
  });
</script>
  <script>
  $('#drop-item').selectize({
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    create: true,
    options: [],
    render: {
      option: function (item, escape) {
        return '<div>' +
          '<span class="image"><img src="' + item.drop_type.url + '" alt=""></span>' +
          '<span class="title">' + escape(item.name) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        return '<div>' +
          '<span class="image"><img src="' + data.drop_type.url + '" alt=""></span>' +
          escape(data.name) +
          '</div>';
      }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: '/mons/store',
          	data: {
              q: query
            },
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res.data);
            }
        });
    }
});
    </script>

<script>
  let form = document.getElementById("mons-catcher");
  let simpan = document.getElementById("simpan");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    let data = new FormData(e.target);

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    axios.post('/mons/store/mobs', data)
    .then((res) => {
    	if(res.data.success) {
          swal("Data monster ditambah", {
          	icon: 'success'
          }).then(() => {
          	form.reset();
            form.clear();
          });

    		simpan.innerHTML = 'Simpan';
            $("#preview").html('');
        }
    }).catch((err) => alert(err));
  });
</script>

<script>
function fileReader(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#preview').html('Preview: <img src="'+e.target.result+'" class="img-fluid mb-5"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
 $("#picture").change(function(){
   fileReader(this);
 })
</script>

@endsection