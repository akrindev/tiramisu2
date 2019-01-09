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

     <div class="col-md-6 col-lg-4">
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

      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Forum tags
            </h3>
            <div class="card-options">
              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#addTag">Tambah data tag </button>
            </div>
          </div>
          <div class="o-auto" style="height:300px">
          <table class="card-table table table-striped o-auto" style="font-weight: 400;font-size:13px;height:150px" id="tagsForum">

         @foreach ($tags as $tag)
            <tr id="tg-{{$tag->id}}">
              <td> <button class="btn btn-sm btn-outline-primary tagged-{{$tag->id}}" onClick="yeah({{$tag->id}});"><i class="fe fe-edit"></i> </button> <button class="btn btn-sm btn-outline-danger" onClick="hapus({{$tag->id}});"><i class="fe fe-trash-2"></i> </button> {{ $tag->name }} </td>
              <td class="text-right"> <span class="tag tag-red"> {{ DB::table('forums')->where('tags','like','%'.$tag->name.'%')->whereNull('deleted_at')->count() }}</span> </td>
            </tr>

         @endforeach
          </table>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Kategori penipuan
            </h3>
            <div class="card-options">
              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#addTagPenipu">Tambah kategori </button>
            </div>
          </div>
          <div class="o-auto" style="height:300px">
          <table class="card-table table table-striped o-auto" style="font-weight: 400;font-size:13px;height:150px" id="tagsPenipu">

         @foreach ((new App\CatScammer)->get() as $scam)
            <tr id="sc-{{$scam->id}}">
              <td> <button class="btn btn-sm btn-outline-primary taggedp-{{$scam->id}}" onClick="editPenipu({{$scam->id}});"><i class="fe fe-edit"></i> </button> <button class="btn btn-sm btn-outline-danger" onClick="hapusScam({{$scam->id}});"><i class="fe fe-trash-2"></i> </button> {{ $scam->name }} </td>
              <td class="text-right"> <span class="tag tag-red"> {{ $scam->scammer->count() }}</span> </td>
            </tr>

         @endforeach
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


  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="addTag" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTag">Tambah data Tag forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>

{!! form_open('/admin/tagforum',['id'=>'tagforum']) !!}
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">
            Tag name </label>
          <input type="text" name="tag" class="form-control ">
          <small class="text-muted"> tanpa spasi 1 kata </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="tagsave">Save</button>
      </div>

{!! form_close() !!}
    </div>
  </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="addTagPenipu" tabindex="-1" role="dialog" aria-labelledby="addTagPenipu" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTagPenipu">Tambah kategori penipu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>

{!! form_open('/admin/catscam',['id'=>'catscammer']) !!}
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">
           Nama Kategori </label>
          <input type="text" name="kategori" class="form-control ">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="scamsave">Save</button>
      </div>

{!! form_close() !!}
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editTag" tabindex="-1" role="dialog" aria-labelledby="editTag" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTag">Edit data Tag forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>

{!! form_open('/admin/editforum',['id'=>'editforum']) !!}
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">
            Tag name </label>
          <input type="hidden" name="id" id="etag">
          <input type="text" id=edit name="tag" class="form-control ">
          <small class="text-muted"> tanpa spasi 1 kata </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="etagsave">Save</button>
      </div>

{!! form_close() !!}
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editScam" tabindex="-1" role="dialog" aria-labelledby="editScam" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editScam">Edit kategori scam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>

{!! form_open('/admin/editscam',['id'=>'editscam']) !!}
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">
            Nama kategori </label>
          <input type="hidden" name="id" id="stag">
          <input type="text" id="skat" name="kat" class="form-control ">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="stagsave">Save</button>
      </div>

{!! form_close() !!}
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


    $("#tagforum").submit(function(e){
    	e.preventDefault();

      $("#tagsave").html("<i class='fa fa-spinner fa-spin'></i> menyimpan . . .").addClass('disabled');
      var me = $(this);

      $.ajax({
      	url: me.attr('action'),
        type: 'POST',
        data: me.serialize(),
        success: function(){
          swal('data ditambahkan ketika di reload');

      $("#addTag").modal("hide");
	      $("#tagsave").html("Save").removeClass('disabled');
          $(this).reset();
        },
        error: function(r,y,u){
          alert(r+y+u);
        },
        always:function(){

        }

      });
    });


    $("#catscammer").submit(function(e){
    	e.preventDefault();

      $("#scamsave").html("<i class='fa fa-spinner fa-spin'></i> menyimpan . . .").addClass('disabled');
      var me = $(this);

      $.ajax({
      	url: me.attr('action'),
        type: 'POST',
        data: me.serialize(),
        success: function(){
          swal('data ditambahkan ketika di reload');

      $("#addTagPenipu").modal("hide");
	      $("#scamsave").html("Save")
            .removeClass('disabled');
          $(this)[0].reset();
        },
        error: function(r,y,u){
          alert(r+y+u);
        },
        always:function(){

        }

      });
    });


    $("#editforum").submit(function(e){
    	e.preventDefault();

      $("#etagsave").html("<i class='fa fa-spinner fa-spin'></i> menyimpan . . .").addClass('disabled');
      var me = $(this);

      $.ajax({
      	url: me.attr('action'),
        type: 'POST',
        data: me.serialize(),
        success: function(){
          swal('data diedit ketika di reload');

      $("#editTag").modal("hide");
	      $("#etagsave").html("Save")
            .removeClass('disabled');
          $("form")[1].reset();
        },
        error: function(r,y,u){
          alert(r+y+u);
        },
        always:function(){

        }

      });
    });


    $("#editscam").submit(function(e){
    	e.preventDefault();

      $("#stagsave").html("<i class='fa fa-spinner fa-spin'></i> menyimpan . . .").addClass('disabled');
      var me = $(this);

      $.ajax({
      	url: me.attr('action'),
        type: 'POST',
        data: me.serialize(),
        success: function(){
          swal('data diedit ketika di reload');

      $("#editScam").modal("hide");
	      $("#stagsave").html("Save")
            .removeClass('disabled');
          $("form")[0].reset();
        },
        error: function(r,y,u){
          alert(r+y+u);
        },
        always:function(){

        }

      });
    });
    });
  </script>
  <script>

    var token = '{{ csrf_token() }}';

    function yeah(i)
    {
      $("#editTag").modal("show");
      $(".tagged-"+i).html("<i class='fa fa-spin fa-spinner'></i>");
      $.ajax({
      	url: '/admin/tagedit/'+i,
        type: 'GET',
        dataType: 'JSON',
        success: function(r){
          $('#edit[name="tag"]').val(r.tag);
          $('#etag[name="id"]').val(r.id);
          $(".tagged-"+i).html("<i class='fe fe-edit'></i>");
        }
      });
    }

    function editPenipu(i)
    {
      $("#editScam").modal("show");
      $(".taggedp-"+i).html("<i class='fa fa-spin fa-spinner'></i>");
      $.ajax({
      	url: '/admin/scamedit/'+i,
        type: 'GET',
        dataType: 'JSON',
        success: function(r){
          $('#skat[name="kat"]').val(r.kat);
          $('#stag[name="id"]').val(r.id);
          $(".taggedp-"+i).html("<i class='fe fe-edit'></i>");
        }
      });
    }


    function hapus(dd)
    {
      swal({
      	title: 'Hapus Tag ini?',
        text: '',
        icon: 'warning',
        buttons: true,
        dangerMode:true
      }).then((isOk) => {
      	if(isOk) {
          $.ajax({
          	url: '/admin/taghapus',
            type: 'POST',
            dataType: 'JSON',
            data: {
              id: dd
            },
            success: function() {
              swal('Dihapus');
              $("#tg-"+dd).slideUp();
            },
            error: function(r,t,y) {
              alert(r+t+y);
            }
          });
        } else {
          swal('no');
        }
      })
    }


    function hapusScam(dd)
    {
      swal({
      	title: 'Hapus kategori ini?',
        text: '',
        icon: 'warning',
        buttons: true,
        dangerMode:true
      }).then((isOk) => {
      	if(isOk) {
          $.ajax({
          	url: '/admin/scamhapus',
            type: 'POST',
            dataType: 'JSON',
            data: {
              id: dd,
              _token: token
            },
            success: function() {
              swal('Dihapus');
              $("#sc-"+dd).slideUp();
            },
            error: function(r,t,y) {
              alert(r+t+y);
            }
          });
        } else {
          swal('no');
        }
      })
    }
  </script>
@endsection