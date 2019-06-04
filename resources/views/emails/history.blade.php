@extends('layouts.tabler')

@section('title', 'Kirim email')


@section('content')
@if(session()->has('success'))
<div class="card-alert alert alert-success">
  {{ session('success') }}
</div>
@endif
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Log Kirim Email </h1>
    </div>

    <div class="row">

      <div class="col-12 mb-5">
        <a href="/admin" class="btn btn-primary btn-pill"> kembali ke halaman admin</a>

        <a href="/email/write" class="btn btn-primary btn-pill"> Tulis email</a>
      </div>
     <div class="col-12">
       <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Latest Mail
            </h3>
         </div>
         <div class="table-responsive">
         <table class="card-table table table-outline text-nowrap table-vcenter table-striped" id="mails" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
             <th> Subject </th>
             <th> User </th>
             <th> Date </th>
             <th> Action </th>
             </tr>
           </thead>

         </table>
         </div>
       </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bacaModal" tabindex="-1" role="dialog" aria-labelledby="bacaModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bacaModalTitle">Isi Pesan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" id="mail-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
@endsection

@section('footer')

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


   <script>
         $(function() {
               $('#mails').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ url('/email/log') }}",
               columns: [
                 		{ data: 'subject' , name: 'subject'},
                        { data: 'user_id', name: 'user_id' },
                        { data: 'created_at', name: 'created_at' },
                 {
                   data: 'action', name: 'action'
                 }
                     ]
            });
         });
         </script>
<script>
  function baca(id) {
    let hal = document.getElementById("mail-body");

    axios.get('/email/baca/'+id).then(res => {
      	$("#bacaModal").modal('show');
      	hal.innerHTML = res.data.body;
    }).catch(e => alert(e));
  }
</script>
@endsection