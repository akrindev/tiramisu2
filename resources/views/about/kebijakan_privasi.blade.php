@extends('layouts.tabler')

@section('title','Kebijakan Privasi')
@section('description','Kebijakan layanan penggunaan pada website toram-id.com')
@section('image',to_img())



@section('content')
<div class="my-5 my-md-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Kebijakan Privasi
      </h1>
         </div>
    <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Kebijakan Privasi</h3>
        </div>
        <div class="card-body">
         <p> Informasi yang kami minta, seperti nama, alamat email akan dipakai untuk memenuhi permintaan atas informasi dan bantuan dalam layanan yang diberikan.
          </p><br>
          <p>
Website ini tidak menjual atau memberikan informasi yang ada kepada perusahaan lain. Selama kebijakan privasi berlaku, kami akan terus memberikan versi terbaru pada website ini.
          </p><br>
           <p>
Kebijakan Privasi ini hanya mencakup informasi yang diperoleh melalui website ini.
 </p><br>
Post yang telah ditulis sepenuhnya menjadi tanggung jawab penulis

        </div>
      </div>

      <div class="card mt-5" id="account-deletion">
          <div class="card-header">
              <h3 class="card-title">Account Deletion</h3>
          </div>
          <div class="card-body">
              <p>We provide account deletion in case you are not using our services anymore or in any conditions. </p>
              <p>You can delete your account through profile setting. there will be menu to delete permanently your account. <span class="text-danger"> Once your account has been deleted, your data will be removed permanently form our database, including your name, facebook id, twitter id, name, email. </span> </p>
          </div>
      </div>

    </div>
    </div>
  </div>
</div>

@endsection
