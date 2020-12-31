@extends('layouts.sb-admin')

@section('content')
  <livewire:admin.drop-add />
@endsection


@section('head')
  @livewireStyles
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/selectize.css">
@endsection

@section('footer')
  @livewireScripts
<script src="/assets/js/vendors/selectize.min.js"></script>
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
<script>
  /*
  let form = document.getElementById("tambah-drop");
  let simpan = document.getElementById("simpan");

  form.addEventListener('submit', (e) => {
  	e.preventDefault();

    simpan.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan';

    let data = new FormData(e.target);

    axios.post('/item/drop/store', data)
    .then((res) => {
    	if(res.data.success) {
          swal("Data drop telah di tambahkan", {
          	icon: 'success'
          }).then(() => {
          	form.reset();
 var control = $select[0].selectize;
 control.clear();
            $("#preview").html('');
          });
        } else {
          swal("Data drop sudah ada",{
          	icon: 'error'
          });
        }

      simpan.innerHTML = 'Simpan';
    }).catch((err) => alert(err));
  });
*/
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
   fileReader(this, '#preview');
 })
 $("#fullimage").change(function(){
   fileReader(this, '#preview2');
 })
</script>

@endsection