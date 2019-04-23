@extends('layouts.tabler')


@section('title','Admin Page')
@section('description','admin page')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Admin Dashboard</h1>
    </div>

    <div class="row mb-5">
      <div class="col-md-12">
        <div class="alert alert-info"><b>Tips!</b> &nbsp; Tambahkan drop terlebih dahulu, setelah itu monster setelah monster tambah resep</div>
        <a href="/mons/store" class="btn btn-sm mb-2">Store monster</a>
        <a href="/mons/drop/store" class="btn btn-sm mb-2">Store drop</a>
        <a href="/mons/store/resep" class="btn btn-sm mb-2">Store resep</a>
        <a href="/store/peta" class="btn btn-sm mb-2">Edit Peta</a>
		  <a href="/fill_stats/add" class="btn btn-sm mb-2">Store fill stats formula</a>
        <a href="/npc/store" class="btn btn-sm mb-2">Edit Npc</a>
         <a href="/prestasi/add" class="btn btn-sm mb-2">Tambah Emblem</a>
        <a href="/contribution/show" class="btn btn-sm mb-2">Kontribusi</a>
        <a href="/skill" class="btn btn-sm mb-2">Skill</a>
        <a href="/cooking/store" class="btn btn-sm mb-2">Store Cooking </a>
        <a href="/edit-tentang" class="btn btn-sm mb-2">Edit About Us</a>
      </div>
    </div>


    <div class="row row-cards">
          <div class="col-6 col-sm-4 col-lg-2">

                <div class="card">
                  <div class="card-body p-3 text-center">

                    <div class="h1 m-0">{{ $users->count() }} </div>
                    <div class="text-muted mb-4">Total Member</div>
                  </div>
                </div>

           </div>

          <div class="col-6 col-sm-4 col-lg-2">

                <div class="card">
                  <div class="card-body p-3 text-center">
 <div class="text-right text-success">
                      {{ $fcom->count() }} replies
                    </div>
                    <div class="h1 m-0">{{ $forums->count() }} </div>
                    <div class="text-muted mb-4">Total Thread</div>
                  </div>
                </div>

           </div>

          <div class="col-6 col-sm-4 col-lg-2">

                <div class="card">
                  <div class="card-body p-3 text-center">
<div class="text-right">
  <span class="text-success">
    {{ $quiz->where('approved',1)->count() }} <i class="fe fe-chevron-up"></i>
                    </span>
  <span class="text-red">
  {{ $quiz->where('approved',0)->count() }} <i class="fe fe-chevron-down"></i></span>
</div>
                    <div class="h1 m-0">{{ $quiz->count() }} </div>
                    <div class="text-muted mb-4">Total Quiz</div>
                  </div>
                </div>

           </div>

          <div class="col-6 col-sm-4 col-lg-2">

                <div class="card">
                  <div class="card-body p-3 text-center">

                    <div class="h1 m-0">{{ $gallery->count() }} </div>
                    <div class="text-muted mb-4">Total Photos</div>
                  </div>
                </div>

           </div>

          <div class="col-6 col-sm-4 col-lg-2">

                <div class="card">
                  <div class="card-body p-3 text-center">

                    <div class="h1 m-0">{{ (new App\Scammer)->count() }} </div>
                    <div class="text-muted mb-4">Total Penipuan</div>
                  </div>
                </div>

           </div>


          <div class="col-6 col-sm-4 col-lg-2">

                <div class="card">
                  <div class="card-body p-3 text-center">
 <div class="text-right small">
   <span class="text-success mr-2">
                      {{ (new App\Monster)->count() }} mobs
    </span> <span class="text-primary">
                      {{ (new App\Resep)->count() }} resep
   </span>
                    </div>
                    <div class="h1 m-0">{{ (new App\Drop)->count() }} </div>
                    <div class="text-muted mb-4">Total Items</div>
                  </div>
                </div>

           </div>
    </div>

    <div class="row">

     <div class="col-12">
       <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Latest Search
            </h3>
         </div>
         <div class="table-responsive">
         <table class="card-table table table-outline text-nowrap table-vcenter table-striped" id="searches" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
             <th> Key </th>
             <th> By </th>
             <th> On </th>
             </tr>
           </thead>

         </table>
         </div>
       </div>
      </div>

     <div class="col-12">
       <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Members
            </h3>
         </div>
         <div class="table-responsive">
         <table class="card-table table table-outline text-nowrap table-vcenter table-striped" id="users" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
                <th class="text-center w-1"><i class="icon-people" data-pic></i></th>
             <th> Name </th>
             <th> Kontak (line &amp; whatsapp) </th>
             <th> Alamat  </th>
             <th> IGN  </th>
             <th> Biodata  </th>
             <th> Gender </th>
             <th> Joined </th>
               <th> Action </th>
             </tr>
           </thead>

         </table>
         </div>
       </div>
      </div>


     <div class="col-12">
       <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Last Login
            </h3>
         </div>
         <div class="table-responsive">
         <table class="card-table table table-outline table-vcenter table-striped" id="lasts" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
                <th class="text-center w-1"><i class="icon-people" data-pic></i></th>
             <th> Name </th>
             <th> IP </th>
             <th> Browser  </th>
             <th> Info </th>
             <th> Date  </th>
             </tr>
           </thead>

         </table>
         </div>
       </div>
      </div>

  </div>
</div>
@endsection

@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    <link href="/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
@endsection

@section('footer')

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script src="/assets/plugins/charts-c3/js/c3.min.js"></script>
<script src="/assets/plugins/charts-c3/js/d3.v3.min.js"></script>

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script>
         $(function() {
               $('#users').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ url('/admin/users') }}",
               columns: [
                 		{ data: 'pic' , name: 'pic', searchable:false, orderable: false},
                        { data: 'name', name: 'name' },
                        { data: 'contact', name: 'contact' },
                        { data: 'alamat', name: 'alamat' },
                        { data: 'ign', name: 'ign' },
                        { data: 'biodata', name: 'biodata' },
                        { data: 'gender', name: 'gender' },
                        { data: 'created_at', name: 'created_at' },
                 		{ data: 'action', name: 'action', orderable: false, searchable:false}
                     ]
            });

           $('#lasts').DataTable({
               processing: true,
               serverSide: true,
               searching:false,
               ajax: "{{ url('/admin/last-login') }}",
               columns: [
                 		{ data: 'pic' , name: 'pic', searchable:false, orderable: false},
                        { data: 'name', name: 'name' },
                        { data: 'ip', name: 'ip' },
                        { data: 'browser', name: 'browser' },
                        { data: 'extra', name: 'extra' },
                        { data: 'created_at', name: 'created_at' }
                     ]
            });
         });
         </script>


   <script>
         $(function() {
               $('#searches').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ url('/admin/searches') }}",
               columns: [
                 		{ data: 'q' , name: 'q'},
                        { data: 'user_id', name: 'user_id' },
                        { data: 'created_at', name: 'created_at' }
                     ]
            });
         });
         </script>


<script>
  $(document).ready(function(){
  $("#users").on('click', '.change[data-id]', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    swal({
      title: 'Ubah data user ini?',
      text: '',
      icon: 'warning',
      buttons: true,
      dangerMode: true
    }).then((ok) => {
    	if(ok) {
          $.ajax({
          	url: '/admin/change-user',
            type: 'POST',
            data: {
              	_method: 'PUT',
            	id: id,
            	p: $(this).data('p')
            },
            success: function(r){
              swal('Data berhasil di ubah','','success');

              var kamu = $("#users").find(".change[data-id="+id+"]");
              if(r.ban == 1) {
            kamu.removeClass('btn-outline-success').addClass('btn-outline-danger').text('banned');
              }
              else
               {
            kamu.removeClass('btn-outline-danger').addClass('btn-outline-success').text('active');
              }
            },
            error: function(err){
              swal('kesalahan '+err);
            }
          });
        } else {
          swal('not ok');
        }
    });
  });
});
  </script>
@endsection