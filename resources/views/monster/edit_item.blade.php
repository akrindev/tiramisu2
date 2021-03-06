@extends('layouts.tabler')

@section('title', $data->name)

@section('content')
<div class="divider"></div>
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col-md-8">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit drop</h3>
      </div>
      <div class="card-alert alert alert-info">Jika telah selesai menambahkan drop, tambahkan mobs beserta drop <a href="/mons/store">disini</a> </div>
      <div class="card-body" style="font-size:13px;font-weight:400">

        {!! form_open_multipart('/item/'.$data->id.'/edit',["id"=>"tambah-drop"]) !!}

        <div class="form-group">
          <label class="form-label">Nama</label>
          <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
        </div>

          <div class="form-group">
          <label class="form-label">Name English *optional</label>
          <input type="text" name="name_en" class="form-control" value="{{ $data->name_en }}">
        </div>

        <div class="form-group">
          <label class="form-label">Type</label>
          <select name="type" id="select-type" class="form-control custom-select" required>
          @foreach((new App\DropType)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->url }}"}' {{ $type->id === $data->dropType->id ? 'selected':''}}>{{$type->name}}</option>
          @endforeach
          </select>
        </div>

          <div class="form-group">
            <label class="form-label">NPC Selling price</label>
            <input type="number" class="form-control" name="sell" value="{{ $data->sell }}">
          </div>


          <div class="form-group">
            <label class="form-label">Proses pts</label>
            <input type="number" class="form-control" name="proses" value="{{ $data->proses }}">
          </div>

          <div class="form-group">
            <label class="form-label">Tambahan / Note (Monster) <small class="text-muted">boleh kosong</small></label>
            <textarea name="noteMonster" rows="5" class="form-control" placeholder="Status Monster . . .">{{ optional($data->note)['monster'] }}</textarea>
          </div>


          <div class="form-group">
            <label class="form-label">Tambahan / Note (NPC) <small class="text-muted">boleh kosong</small></label>
            <textarea name="noteNpc" rows="5" class="form-control" placeholder="Status NPC . . .">{{ optional($data->note)['npc'] }}</textarea>
          </div>


          <div class="form-group">
            <label class="form-label">Screenshot</label>
            <div id="preview">
              @if($data->picture)
              <img src="/{{$data->picture}}"/>
              @endif
            </div>
            <input type="file" name="picture" class="form-control" accept="image/*" id="picture">
          </div>


          <div class="form-group">
            <label class="form-label">Screenshot full image for armor</label>
            <div id="preview2">@if($data->fullimage)
              <img src="/{{$data->fullimage}}"/>
              @endif</div>
            <input type="file" name="fullimage" class="form-control" accept="image/*" id="fullimage">
          </div>

          <div class="form-group">
              <label class="form-label">Released Date</label>
              <input type="date" name="released" class="form-control" id="">
          </div>

        <div class="form-group">
          <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button> <span class="btn btn-outline-danger ml-3 btn-pill" id="hapus">hapus</span>
        </div>

        @csrf
        {!! form_close() !!}

        {!! form_open('/item/'.$data->id.'/hapus',['id'=>'form-hapus']) !!}
        @csrf
        @method('DELETE')
        {!! form_close() !!}

      </div>
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
<script>
(function(){
  let form = document.getElementById("tambah-drop");
  let simpan = document.getElementById("simpan");
  let sendTo = form.getAttribute('action');
  let hapus = document.getElementById("hapus");
  let formHapus = document.getElementById('form-hapus');
  let hapusResep = document.getElementById("hapus-resep");
  let formResep = document.getElementById("form-hapus-resep");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    let data = new FormData(e.target);

    axios.post(sendTo, data)
    .then((res) => {
    	if(res.data.success) {
          swal("Data drop berhasil di edit", {
          	icon: 'success'
          }).then(() => {
          	window.close();
          });
        }

      simpan.innerHTML = 'Simpan';
    }).catch((err) => alert(err));
  });

  hapus.addEventListener('click', (e) => {
  	e.preventDefault();

    swal({
    	title:'Yakin mau hapus ini?',
      	text:'data tidak bisa di kembaikan setelah di hapus',
      	icon:'warning',
      	buttons:true,
      	dangerMode:true
    }).then((ya) => {
    	if(ya) {
          formHapus.submit();
        } else {
          swal('aman gan');
        }
    });
  });

  formResep.addEventListener('submit', (e) => {
  	e.preventDefault();

    let d = new FormData(e.target);

    swal({
      title: 'Yakin mau hapus resep?',
      text: '',
      icon: 'warning',
      buttons: true,
      dangerMode: true
    }).then((iya) => {
    	if(iya) {
          axios.post(e.target.action, d)
          .then((res) => {
          	if(res.data.success) {
              swal("resep di hapus",{
              	icon: 'success',
                text: 'tambahkan resep di menu resep'
              });
            } else {
              swal('aman gan!');
            }
          }).catch((err) => alert(err));
        } else {
          swal("aman gan!!");
        }
    });
  })

})();
</script>

<script>
function fileReader(input, el) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $(el).html('Preview: <img src="'+e.target.result+'" class="img-fluid"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
 $("#picture").change(function(){
   fileReader(this, "#preview");
 })

 $("#fullimage").change(function(){
   fileReader(this, '#preview2');
 })
</script>

@endsection
