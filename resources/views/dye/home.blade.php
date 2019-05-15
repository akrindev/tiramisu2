@extends('layouts.tabler')


@section('title', 'Info Dye Bulanan')
@section('description', 'Toram Online Dye Bulanan, akan selalu di update setiap bulan')

@php

$let = 0;

@endphp

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Dye Bulanan (Monthly Dye)</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Dye bulan {{ now()->formatLocalized('%B %Y') }} </h3>
        </div>
        @includeWhen(!app()->isLocal(), 'inc.ads_article')
        <div class="card-body p-3" style="font-size:14px;font-weight:400">
          Kamu bisa mendapatkan senjata berwarna (Weapon dye) pada tingkat kesulitan Nightmare atau Ultimate mode.
di mode Nightmare senjata tidak bisa di trade, sedangkan di mode Ultimate senjata sudah auto craft dari boss battle. shield dye juga drop di mode Nightmare atau Ultimate.
<br> <br>
Perolehan type dye bergantung pada senjata yg dipakai regumu. Jika 4 member regumu memakai senjata berbeda 1h, 2h, staff, katana. maka dye yang di dapat juga 1h, 2h, staff, katana. tetapi jika regumu memakai 1h semua, dye yg di dapat juga hanya 1h saja. di sarankan untuk memakai senjata yang berbeda beda agar type senjata dye yang di peroleh juga berbeda.<br><br>

Warna senjata berubah-ubah pada tanggal pertama setiap bulannya.
        </div>
        <h5 class="text-center"> Dye bulan {{ now()->formatLocalized('%B %Y') }} </h5>
        <table class="card-table table table-striped" style="font-size:13px">
          <caption class="p-3">  Dye bulan {{ now()->formatLocalized('%B %Y') }} </caption>
          <thead>
            <tr>
              <th> Nama Boss </th>
              <th> A </th>
              <th> B </th>
              <th> C </th>
            </tr>
          </thead>
          @forelse($dyes as $dye)
          <tr>
            <td class="p-2"> {{ $dye->monster->name }} @auth @if(auth()->user()->isAdmin()) [<a href="#" class="dd" data-id="{{ $dye->id }}">hapus</a>] @endif @endauth</td>
            <td class="p-2" {!! $dye->type == 'a' ? "style='color:white;text-shadow:0 0 8px black, 0 0 4px blue;text-align:center;background:#{$dye->dye->hex}'" : '' !!}> {{ $dye->type == 'a' ? $dye->dye->color : '' }}</td>
            <td class="p-2" {!! $dye->type == 'b' ? "style='color:white;text-shadow:0 0 8px black, 0 0 4px blue;text-align:center;background:#{$dye->dye->hex}'" : '' !!}> {{ $dye->type == 'b' ? $dye->dye->color : '' }}</td>
          	<td class="p-2" {!! $dye->type == 'c' ? "style='color:white;text-shadow:0 0 8px black, 0 0 4px blue;text-align:center;background:#{$dye->dye->hex}'" : '' !!}> {{ $dye->type == 'c' ? $dye->dye->color : '' }}</td>
          </tr>
          @empty
          <tr> Wait for update</tr>
          @endforelse
        </table>
      </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <img class="img img-fluid" src="/img/dye_code.png" alt="toram dye code"/>
        </div>
        @include('inc.menu')
      </div>
    </div>
  </div>
</div>

@auth
@if(auth()->user()->isAdmin())

 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<script src="/assets/js/vendors/selectize.min.js"></script>

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>
	<script>

  let dd = document.querySelectorAll('.dd'),
      token = '{{ csrf_token() }}';

  for(let d of dd) {

    d.addEventListener('click', (e) => {
    	e.preventDefault();

      let data = new FormData();
      data.append('id', d.dataset.id);
      data.append('_token', token);
      data.append('_method', 'DELETE');

      	swal({
        	title: 'Hapus',
          	text: 'yakin ingin menghapus ini?',
          	icon: 'warning',
          	buttons: true
        }).then(r => {
        	if(r) {
              axios.post('/dye/delete', data)
              .then(r => {
              	if(r.data.success) {
                  swal('data dihapus', {
                  	icon: 'success'
                  }).then(z => {
                  	window.location.reload();
                  });
                }
              }).catch(e => swal(e));
            }else {
              swal('oke aman!!');
            }
        });
    });
  }
</script>
@endif
@endauth
@endsection