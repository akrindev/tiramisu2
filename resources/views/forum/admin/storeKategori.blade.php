@extends('layouts.sb-admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Store Forum Kategori</h1>
  </div>

  @if(session()->has('success'))
  <div class="alert alert-success"> {{ session('success') }}</div>
  @endif

  <div class="row">
    <div class="col-md-8 mb-5">
      <div class="card">
        <div class="card-body p-3">

          {!! form_open('/admin/forum/kategori') !!}
          @csrf

          <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" placeholder="boleh dikosongkan">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
          </div>
          {!! form_close() !!}
        </div>
    </div>
    </div>

    <div class="col-md-8">
      <div class="card">
        <div class="card-body p-3">
			@foreach($categories as $kategori)
          	-> <a href="/forum/kategori/{{ $kategori->slug }}">
          		{{ $kategori->name }}
          </a> [ <a href="#" data-name="{{ $kategori->name }}" data-slug="{{ $kategori->slug }}" data-id="{{ $kategori->id }}" class="editkat text-muted small">edit</a>  ] <br>
          	@endforeach
        </div>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      {!! form_open('/admin/forum/kategori/save',['id'=>'save']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        @csrf
        <input type="hidden" name="id" id="kate">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" id="sname" class="form-control" required>
        </div>

            <div class="form-group">
              <label class="form-label">
                Slug
              </label>
                 <input type="text" name="slug" id="sslug" class="form-control" placeholder="boleh kosong">
            </div>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="simpan">Save</button>
      </div>

        {!! form_close() !!}
    </div>
  </div>
</div>

@endsection

@section('footer')

<script>
  $(".editkat").click(function(e) {
  	e.preventDefault();

    let id = $(this).data('id');
    let name = $(this).data('name');
    let slug = $(this).data('slug');

    $("#kate").val(id);
    $("#sname").val(name);
    $("#sslug").val(slug);

    $("#exampleModal").modal('show');
  })
</script>

@endsection