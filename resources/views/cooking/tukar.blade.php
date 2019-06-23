@extends('layouts.tabler')

@section('title', 'Tukeran buff masakan')
@section('description', 'Saling tukar buff masakan dengan cara saling berteman')
@section('image', 'https://i.ibb.co/8Dqtxvz/FB-IMG-15607680360251846-picsay.jpg')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Buff Masakan Member</h1>
    </div>

    <div class="row">

     <div class="col-12">
       <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Buff Masakan Member
            </h3>
         </div>
         <div class="card-alert alert alert-info">
           <strong>Tips!</strong> Saling berbagi buff masakan dengan cara berteman. buff kamu akan tampil disini dengan cara <a href="/setting/profile">edit profile</a>mu dan atur buff masakanmu lalu set privasi ke publik, jangan lupa isi kontak agar mudah di hubungi.
         </div>
         <div class="my-2">
           @includeWhen(! app()->isLocal(), 'inc.ads_mobile')
         </div>
         <div class="unit w-2-3">
         <table class="display" id="buff" style="width:100%">
           <thead>
             <tr>
             	<th> Oleh </th>
             	<th> Buff </th>
             	<th> Hubungi </th>
                <th> Bio </th>
             </tr>
           </thead>

         </table>
         </div>
       </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
            	Status Buff Masakan
            </div>
          </div>
          <div class="table-responsive">
          <table class="card-table table table-bordered table-striped table-sm table-hover" style="font-size:12px">
            <thead>
              <tr>
                <th rowspan="2" class="text-center text-success"> Stat </th>
                <th colspan="10" class="text-center text-danger"> Level </th>
              </tr>
              <tr>
                <th> 1 </th>
                <th> 2 </th>
                <th> 3 </th>
                <th> 4 </th>
                <th> 5 </th>
                <th> 6 </th>
                <th> 7 </th>
                <th> 8 </th>
                <th> 9 </th>
                <th> 10 </th>
              </tr>
            </thead>
            <tbody>
              @foreach(\App\Cooking::get() as $cook)
              <tr>
                <td> {{ $cook->buff }} </td>
                @for($i = 1; 10 >= $i;$i++)
                <td> {{ (new \App\Http\Controllers\CookingController)->getStatLv($cook->buff, $cook->stat, $i) }} </td>
                @endfor
              </tr>
              @endforeach

            </tbody>
          </table>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        @include('inc.menu')
      </div>
      <div class="col-md-8">
        @includeWhen(! app()->isLocal(), 'inc.ads_article')
      </div>
    </div>
  </div>
</div>
@endsection


@section('head')

<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">

<link rel="stylesheet" href="//datatables.net/media/css/site.css">
<script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

<style>
  body {
    color:#495057;text-align:left;background-color:#f5f7fb;
  }
</style>
@endsection

@section('footer')
<script>
  $('#buff').addClass('nowrap')
    .DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    searching: false,
    ordering: false,
    ajax: "{{ url('/cooking/buff') }}",
    columns: [
      { data: 'oleh' , name: 'name' },
      { data: 'buff', name: 'cooking.buff' },
      { data: 'hubungi', name: 'hubungi' },
      { data: 'bio',	name: 'bio'},

    ],
    columnDefs: [
      {
        targets: [-1, -2],
        className: 'dt-body-right'
      },
      {
        targets: -1,
        render: function (data, type, row, meta) {
          return `<div class="text-wrap wrap" style="word-wrap: break-word; white-space:normal; font-size:12.5px; min-width: 100%">${data}</div>`
        }
      }
    ]
  });
</script>
@endsection