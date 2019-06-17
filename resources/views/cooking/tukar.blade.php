@extends('layouts.tabler')

@section('title', 'Tukeran buff masakan')
@section('description', 'Saling tukar buff masakan dengan cara saling berteman')

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
    searching: true,
    ajax: "{{ url('/cooking/buff') }}",
    columns: [
      { data: 'oleh' , name: 'oleh' },
      { data: 'buff', name: 'buff' },
      { data: 'hubungi', name: 'hubungi' },
      { data: 'bio',	name: 'bio'}
    ],
    columnDefs: [
      {
        targets: [-1, -2],
        className: 'dt-body-right'
      },
      {
        targets: -1,
        render: function (data, type, row, meta) {
          return `<div class="text-wrap wrap" style="word-wrap: break-word; white-space:normal; max-width: 100%">${data}</div>`
        }
      }
    ]
  });
</script>
@endsection