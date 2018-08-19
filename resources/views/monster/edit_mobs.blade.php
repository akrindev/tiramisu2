@extends('layouts.tabler')

@section('content')
<div class="my-5">
  <div class="container">

    <div class="row">
      <div class="col-md-8">

        <div class="card">
          <div class="card-header">
          <h3 class="card-title">Edit data monster</h3>
          </div>
          <div class="card-alert alert alert-info">Jika data drop tidak di temukan, tambah data dropnya <a href="/mons/drop/store">disini</a>
          </div>

        <div class="card-body p-3" style="font-size:13px;font-weight:400">

          {!! form_open_multipart('/monster/'.$data->id.'/edit',["id"=>"mons-catcher"]) !!}
          @csrf

          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ $data->name }}" required>
          </div>

      <div class="form-group">
        <label class="form-label">Type</label>
<div class="selectgroup selectgroup-pills">
  <label class="selectgroup-item">
    <input type="radio" name="type" class="selectgroup-input" value="1" {{ $data->type == 1 ? 'checked':''}}>
    <span class="selectgroup-button">Normal mons</span>
  </label>
   <label class="selectgroup-item">
    <input type="radio" name="type" class="selectgroup-input" value="2" {{ $data->type == 2 ? 'checked':''}}>
    <span class="selectgroup-button">Mini Boss</span>
  </label>
   <label class="selectgroup-item">
    <input type="radio" name="type" class="selectgroup-input" value="3" {{ $data->type == 3 ? 'checked':''}}>
    <span class="selectgroup-button">Boss</span>
  </label>
        </div>

        </div>

          <div class="form-group">
            <label class="form-label">Map</label>
            <select name="map" id="map" class="form-control custom-select" required>
              <option value=""></option>
            @foreach ((new App\Map)->get() as $map)
              <option value="{{$map->id}}" {{ $data->map_id == $map->id ? 'selected':''}}>{{ $map->name }}</option>
            @endforeach
            </select>
          </div>


          <div class="form-group">
            <label class="form-label">Bisa dijadikan pet?</label>
            <label class="custom-switch">
               <input type="checkbox" name="pet" class="custom-switch-input"  {{ $data->pet == 'y' ? 'checked':''}}>
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description"></span>
             </label>
          </div>

          <div class="row">
            <div class="col-4">

          <div class="form-group">
            <label class="form-label">level</label>
            <input type="number" class="form-control" name="level" value="{{ $data->level }}" required>
          </div>

            </div>

            <div class="col-4">

          <div class="form-group">
            <label class="form-label">HP</label>
            <input type="number" class="form-control" name="hp" value="{{ $data->hp }}">
          </div>
            </div>


            <div class="col-4">

          <div class="form-group">
            <label class="form-label">XP</label>
            <input type="number" class="form-control" name="xp" value="{{ $data->xp }}">
          </div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Drop items</label>
            <select id="drop-item" class="form-control" multiple="multiple" name="drop[]" required>

            </select>
          </div>

      <div class="form-group">
        <label class="form-label">Element</label>
<div class="selectgroup selectgroup-pills">
  @foreach ((new App\Element)->get() as $el)
  <label class="selectgroup-item">
    <input type="radio" name="element" class="selectgroup-input" value="{{$el->id}}" {{ $el->id === $data->element_id ? 'checked':'' }}>
    <span class="selectgroup-button">{{ $el->name }}</span>
  </label>
  @endforeach
        </div>

        </div>

          <div class="form-group">
            <label class="form-label">Screenshot</label>
            <div id="preview"></div>
            <input type="file" name="picture" class="form-control" accept="image/*">
          </div>


          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button> <span class="btn btn-outline-danger" id="hapus-mons">Hapus</span>
          </div>

          {!! form_close() !!}

          {!! form_open('/monster/'.$data->id.'/hapus',['id'=>'form-hapus']) !!}
          @csrf
          @method('delete')
          {!! form_close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('head')
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<script src="/assets/js/vendors/selectize.min.js"></script>
@endsection

@section('footer')
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
    create: false,
    persist: false,
    options: [],
    delimiter:',',
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
    },onInitialize: function(){
    var selectize = this;
    $.get("/mons/fetch/{{ $data->id }}", function( data ) {
        selectize.addOption(data); // This is will add to option
        var selected_items = [];
        $.each(data, function( i, obj) {
            selected_items.push(obj.id);
        });
        selectize.setValue(selected_items); //this will set option values as default
    });
}
});


    </script>

<script>
(function(){
  let form = document.getElementById("mons-catcher");
  let simpan = document.getElementById("simpan");
  let hapusMons = document.getElementById("hapus-mons");
  let hapusForm = document.getElementById("form-hapus");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    let data = new FormData(e.target);

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    axios.post('/monster/{{ $data->id}}/edit', data)
    .then((res) => {
    	if(res.data.success) {
          swal("Data monster di edit", {
          	icon: 'success'
          }).then(() => {
    		simpan.innerHTML = 'Simpan';
          	window.location.href = '/monster/{{$data->id}}';
          });
        }
    }).catch((err) => alert(err));
  });

  hapusMons.addEventListener('click', (e) => {
  	e.preventDefault();

    swal({
      title:'Hapus data monster ini?',
      text:'',
      icon:'warning',
      buttons:true,
      dangerMode:true
    }).then((yakin) => {
    	if(yakin) {
          hapusForm.submit();
        } else {
          swal('oke gan aman!!');
        }

    });

  });
})();
</script>
@endsection