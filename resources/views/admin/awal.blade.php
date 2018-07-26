@extends('layouts.tabler')


@section('title','Admin Page')
@section('description','admin page')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Admin Dashboard</h1>
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
    </div>

    <div class="row">


      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Visitor and views
            </h3>
         </div>

         <div class="table-responsive">
         <table class="card-table table table-outline table-vcenter table-striped" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
               <th>Page</th>
               <th>Visitor</th>
               <th>Views</th>
             </tr>
           </thead>
       @foreach ($visitor as $visit)
           <tr>
             <td> {{ $visit['pageTitle'] }} </td>
             <td> {{ $visit['visitors'] }} </td>
             <td> {{ $visit['pageViews'] }} </td>
           </tr>
       @endforeach
         </table>
        </div>
      </div>

    </div>


      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-activity"></i> Total Visitor and views
            </h3>
         </div>
           <div class="card-chart-bg" style="height: 50%">
             <div id="tvisit"></div>
          </div>

         <div class="o-auto" style="height: 280px">
         <table class="card-table table table-outline table-vcenter table-striped" style="font-size:14px;font-weight:400">
           <thead>
             <tr>
               <th>Page</th>
               <th>Visitor</th>
               <th>Views</th>
             </tr>
           </thead>
       @foreach ($totalVisitor as $vis)
           <tr>
             <td> {{ waktu($vis['date']) }} </td>
             <td> {{ $vis['visitors'] }} </td>
             <td> {{ $vis['pageViews'] }} </td>
           </tr>
       @endforeach
         </table>
        </div>
      </div>

    </div>


      <div class="col-md-4 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Most Visitor views
            </h3>
         </div>

         <div class="o-auto" style="height: 300px">
         <table class="card-table table table-outline table-vcenter table-striped" style="font-size:10px;font-weight:400">
           <thead>
             <tr>
               <th>Url</th>
               <th>Page</th>
               <th>Views</th>
             </tr>
           </thead>
       @foreach ($mostVisit as $visi)
           <tr>
             <td> {{ $visi['url'] }} </td>
             <td> {{ $visi['pageTitle'] }} </td>
             <td> {{ $visi['pageViews'] }} </td>
           </tr>
       @endforeach
         </table>
        </div>
      </div>

    </div>


      <div class="col-md-4 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Top referrers
            </h3>
         </div>

         <div class="o-auto" style="height: 300px">
         <table class="card-table table table-outline table-vcenter table-striped" style="font-size:10px;font-weight:400">
           <thead>
             <tr>
               <th>Url</th>
               <th>Views</th>
             </tr>
           </thead>
       @foreach ($topRef as $top)
           <tr>
             <td> {{ $top['url'] }} </td>
             <td> {{ $top['pageViews'] }} </td>
           </tr>
       @endforeach
         </table>
        </div>
      </div>

    </div>


      <div class="col-md-4 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fe fe-user"></i> Top Browsers
            </h3>
         </div>

         <div class="o-auto" style="height: 300px">
         <table class="card-table table table-outline table-vcenter table-striped" style="font-size:10px;font-weight:400">
       @foreach ($topBrowsers as $topb)
           <tr>
             <td> {{ $topb['browser'] }} </td>
             <td> {{ $topb['sessions'] }} </td>
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
             <th> thread </th>
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
   <script>
         $(function() {
               $('#users').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ url('/admin/users') }}",
               columns: [
                 		{ data: 'pic' , name: 'pic', searchable:false, orderable: false},
                        { data: 'name', name: 'name' },
                        { data: 'thread', name: 'thread' },
                        { data: 'alamat', name: 'alamat' },
                        { data: 'ign', name: 'ign' },
                        { data: 'biodata', name: 'biodata' },
                        { data: 'gender', name: 'gender' },
                        { data: 'created_at', name: 'joined' },
                 		{ data: 'action', name: 'action', orderable: false, searchable:false}
                     ]
            });
         });
         </script>

  	<script>
         	$(document).ready(function() {
                      		var chart = c3.generate({
                      			bindto: '#tvisit',
                      			padding: {
                      				bottom: 0,
                      				left: -1,
                      				right: -1
                      			},
                      			data: {

                      				columns: [
['visitor',
                         @foreach ($totalVisitor as $v)
                      					 {{ $v['visitors']}},
                          @endforeach
                                         ],['pageviews',
                         @foreach ($totalVisitor as $pv)
                          {{ $pv['pageViews']}},
                          @endforeach
                      				]
                                                    ],
                      				type: 'area-spline'
                      			},
             axis: {
               x: {
                type: 'category',
                categories: [
                @foreach ($totalVisitor as $p)
                            '{{ $p['date']->day }}',
                @endforeach
                ]
               }
             }

                      		});
                      	});
  </script>
@endsection