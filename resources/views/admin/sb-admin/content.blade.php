@extends('layouts.sb-admin')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Users (Total) -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users (Total)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Searches (Total) -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Searches (Total)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($searches->count()) }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-search fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Image -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Images (All Users)</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $images }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-images fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Drop item -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Drop items</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $items->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-boxes fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Monster -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Monsters</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monsters->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-paw fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quiz -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Quizzes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $quizzes->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-award fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Forum Threads -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Forum Threads</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $forums->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- pencarian terakhir -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pencarian Terakhir</h6>
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

            <!-- last threads Column -->
            <div class="col-lg-6 mb-4">

              <!-- last forum post terakhir -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Forum posts terakhir</h6>
                </div>

   			      <div class="table-responsive">
         <table class="card-table table table-striped" id="posts" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
             <th> judul </th>
             <th> by </th>
             <th> On </th>
             </tr>
           </thead>

         </table>
         </div>
              </div>
            </div>
            <!-- users Column -->
            <div class="col-lg-6 mb-4">

              <!-- users terakhir -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                </div>

         <div class="table-responsive">
         <table class="card-table table table-outline text-nowrap table-vcenter table-striped" id="users" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
                <th class="text-center" style="width: 0.25rem !important;" data-pic></th>
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
          </div>

        </div>
        <!-- /.container-fluid -->
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

     $('#posts').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('/admin/last_forum_posts') }}",
      columns: [
        { data: 'judul' , name: ''},
        { data: 'user_id', name: 'user_id' },
        { data: 'created_at', name: 'created_at' }
      ]
    });

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
            	id: id
            },
            success: function(r){
              swal('Data berhasil di ubah','','success');

              var kamu = $("#users").find(".change[data-id="+id+"]");
              if(r.ban == 1) {
            	kamu.removeClass('btn-outline-success').addClass('btn-outline-danger').text('banned');
              } else {
            	kamu.removeClass('btn-outline-danger').addClass('btn-outline-success').text('active');
              }
            },
            error: function(err){
              swal('kesalahan '+err);
            }
          });
        } else {
          swal('fyuhhh');
        }
    });
  });
});
  </script>
@endsection