@extends('layouts.tabler')

@section('title', 'Edit item: ' . $item->name)

@section('content')
<div class="divider"></div>
<div class="my-3 my-md-5">

<div class="container">

    <div class="page-header">
      <h3 class="page-title">Saran pengeditan item</h3>
    </div>

    <div class='row'>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-3">
                <h4 class="text-danger">Peraturan sebelum mengedit item</h4>
                    <hr class="my-1">
                    - Masukkan nama item sesuai nama yang ada di dalam game. <br>
                    - Nama dalam bahasa indonesia tidak boleh kosong. <br>
                    - Nama dalam bahasa inggris boleh di kosongkan jika tidak tahu bahasa inggrisnya. <br>
                    - Pilih tipe item sesuai jenis item yang ada di dalam game. <br>
                    - Terdapat 2 Deskripsi item yaitu deskripsi item dari drop dan deskripsi item dari npc. <br>
                    - Jika item berasal dari drop monster, masukkan dalam deskripsi status monster. <br>
                    - Jika item berasal dari npc, masukkan dalam deskripsi status NPC. <br>
                    - Jika kamu tahu kedua status deskripsi, masukkan semua deskripsi status. <br>
                    - Jika item tidak memiliki deskripsi, kosongkan semua deskripsi status dan hanya mengisi nama dan tipe saja. <i class="text-muted">contoh: jenis item logam, kain, fauna, etc.</i> <br>
                    - Jika terdapat gambar, potonglah gambar terlebih dahulu dengan ratio 1:1 (persegi). item yang di pakai dalam gambar harus hanya 1 item yang sesuai dan tidak mengenakan perlengkapan lain. background gambar lebih baik berwarna hitam. <br>
                    - Tidak perlu memasukkan gambar jika item tidak memiliki gambar atau jika kamu belum mengambil screenshot gambar. <br>
                    - Tim kami akan mereview ulang semua data yang telah di tambahkan maupun yang di ubah.
                    <br><br>

                    <strong>
                        Terima Kasih telah ikut berkontribusi di situs ini
                    </strong>

            </div>
        </div>
    </div>


  <div class="col-md-6">

    <div class="card">
      <div class="card-header p-3">
        <h3 class="card-title">Edit drop item</h3>
      </div>
      {{-- <div class="card-alert alert alert-info">Jika telah selesai menambahkan drop, tambahkan mobs beserta drop <a href="/mons/store">disini</a> </div> --}}
      <div class="card-body p-3" style="font-size:13px;font-weight:400">

        {!! form_open_multipart('/temp/drop/edit/update', [ "id" => "tambah-drop" ]) !!}

        <div class="form-group">
          <label class="form-label">Name (indonesia) <i class="text-danger">*</i></label>
          <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
        </div>

          <div class="form-group">
          <label class="form-label">Name (English) <i class="text-muted">(optional)</i> </label>
          <input type="text" name="name_en" class="form-control" value="{{ $item->name_en }}">
        </div>

        <div class="form-group">
          <label class="form-label">Type</label>
          <select name="type" id="select-type" class="form-control custom-select" required>
          @foreach((new App\DropType)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->url }}"}' {{ $type->id === $item->dropType->id ? 'selected':''}}>{{$type->name}}</option>
          @endforeach
          </select>
        </div>
{{--
          <div class="form-group">
            <label class="form-label">NPC Selling price</label>
            <input type="number" class="form-control" name="sell" value="{{ $item->sell }}">
          </div>


          <div class="form-group">
            <label class="form-label">Proses pts</label>
            <input type="number" class="form-control" name="proses" value="{{ $item->proses }}">
          </div> --}}

          <div class="form-group">
            <label class="form-label">Deskripsi Status Monster <i class="text-muted">(optional)</i></label>
            <textarea name="noteMonster" rows="5" class="form-control" placeholder="Deskripsi status dari monster">{{ optional($item->note)['monster'] }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi status NPC <i class="text-muted">(optional)</i></label>
            <textarea name="noteNpc" rows="5" class="form-control" placeholder="Deskripsi status dari NPC">{{ optional($item->note)['npc'] }}</textarea>
          </div>


          <div class="form-group">
            <label class="form-label">Screenshot <i class="text-muted">optional</i></label>
            <div id="preview">
              @if($item->picture)
              <img src="/{{$item->picture}}"/>
              @endif
            </div>
            <input type="file" name="picture" class="form-control" accept="image/*" id="picture"/>
          </div>


          <div class="form-group">
            <label class="form-label">Screenshot full image for armor <i class="text-muted">optional</i></label>
            <div id="preview2">
                @if($item->fullimage)
                    <img src="/{{$item->fullimage}}"/>
                @endif</div>
            <input type="file" name="fullimage" class="form-control" accept="image/*" id="fullimage"/>
          </div>

        <div class="form-group">
          <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Simpan</button>
        </div>

        <input type="hidden" name="id" value="{{ $item->id }}">
        @csrf
        {!! form_close() !!}
      </div>
    </div>

  </div>


    </div>
  </div>
</div>

@endsection

@section('head')
<meta name="robots" content="noindex, nofollow">
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

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    let data = new FormData(e.target);

    axios.post(sendTo, data)
    .then((res) => {
    	if(res.data.success) {
          swal("Data drop berhasil di edit untuk di review", {
          	icon: 'success'
          }).then(() => {
          	window.close();
          });
        }

    }).catch((err) => alert(err)).finally(() => {
        simpan.innerHTML = 'Simpan';
    });
  });


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
