@extends('layouts.tabler')

@section('title', 'Tambah data dye')


@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Tambah Dye Bulanan (Monthly Dye)</h3>
  </div>

    <div class="row">
      <div class="col-md-8">

        <a href="/admin" class="btn btn-outline-primary my-3">Back to admin panel</a>

        <div class="card">
         <div class="card-body p-3">
        {!! form_open('/admin/storedye', ['id' => 'dye-form']) !!}

           @csrf
        <div class="form-group">
            <label class="form-label">Monster</label>
            <select name="monster" id="monster" class="form-control custom-select" required>
              <option value=""></option>
            @foreach ($monsters as $monster)
              <option value="{{ $monster->id }}">{{ $monster->name }}</option>
            @endforeach
            </select>
        </div>

            <div class="form-group">
              <div class="form-label">
                Dye type
              </div>
              <div class="selectgroup selectgroup-pills">
                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="a" class="selectgroup-input" checked="">
                            <span class="selectgroup-button selectgroup-button-icon">A</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="b" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">B</span>
                 </label>

                 <label class="selectgroup-item">
                     <input type="radio" name="type" value="c" class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon">C</span>
                 </label>

              </div>
            </div>

           <div class="form-group">
            <label class="form-label">Dye color </label>
            <select name="dye" id="dye" class="form-control custom-select" required>
              <option value=""></option>
            @foreach ($dyes as $dye)
              <option value="{{ $dye->id }}">{{ $dye->color }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
          <button id="btndye" class="btn btn-primary">Save</button>
        </div>

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
  var m = $('#monster').selectize({
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

  var d = $('#dye').selectize({
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
  let form = document.getElementById('dye-form'),
      btn = document.getElementById('btndye')


  form.addEventListener('submit', e => {
  	e.preventDefault();


    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    axios.post('/dye/store', new FormData(e.target))
    .then((res) => {
    	if(res.data.success) {
          swal('Data dye telah di tambahkan', {
          	icon: 'success'
          });
        }

      m[0].selectize.clear();
      d[0].selectize.clear();
      btn.innerHTML = 'Save';
    }).catch(e => swal(e));

  });
</script>
@endsection