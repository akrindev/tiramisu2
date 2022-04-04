@extends('layouts.tabler')


@section('title', 'Info Dye ' . now()->formatLocalized('%B %Y'))
@section('description', 'Toram Online Monthly Dye (Dye Bulanan)')


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Dye Bulanan (Monthly Dye)</h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                @includeUnless(app()->isLocal(), 'inc.ads_horizontal')
            </div>
            <div class="col-md-8">
                <livewire:dye/>
                @includeUnless(app()->isLocal(), 'inc.ads_article')
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


@section('head')
	@livewireStyles
@endsection

@section('footer')
	@livewireScripts
@endsection
