@extends('layouts.tabler')

@section('title','Edit')

@section('content')

 <div class="my-3 my-md-5">
   <div class="container">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title"> Edit </h3>
       </div>

       @if(session()->has('sukses'))
       <div class="card-alert alert alert-success">
         {{ session('sukses') }}
       </div>
       @endif

       <div class="card-body">
{!! form_open() !!}
         @csrf
         <div class="form-group">
           <label class="form-label"> Gambar </label>
           <img src="{{$data->gambar}}" class="rounded">
           <small class="text-muted">Gambar tidak diperbolehkan diubah</small>
         </div>


         <div class="form-group">
           <label class="form-label"> Deskripsi </label>
           <textarea name="body" class="form-control {{$errors->has('body') ? 'is-invalid':''}}">{{$data->body}} </textarea>
           @if($errors->has('body'))
           <small class="text-danger">
             {{ $errors->first('body') }}
           </small>
           @endif
         </div>


         <div class="form-group">
           <button type="submit" class="btn btn-outline-primary"> Ubah </button> <button onclick="event.preventDefault();dg({{$data->id}})" class="btn btn-outline-danger">hapus</button>

         </div>
{!! form_close() !!}

         {!! form_open('/gallery/destroy',['id'=>'gid'.$data->id]) !!}
                    @csrf
                    @method("DELETE")
         <input type="hidden" name="id" value="{{$data->id}}">
          {!! form_close() !!}
       </div>
     </div>
   </div>
</div>
@endsection


@section('footer')

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

   function dg(i)
  {
       swal({
        title: "Yakin mau hapus gambar ini?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          return document.getElementById('gid'+i).submit();
        } else {
          swal("Aman gan!");
        }
      });
  }
</script>
@endsection