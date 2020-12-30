<div class="col-12 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Pencarian Terakhir</h6>
        </div>
        <div class="table-responsive">
            <table style="width:100%"  class="card-table table table-outline text-nowrap table-vcenter table-striped" style="font-size:14px;font-weight:400">
                <thead>
                    <tr>
                        <th> Key </th>
                        <th> By </th>
                        <th> On </th>
                    </tr>
        </thead>
        <tbody>
            @foreach ($searches as $search)
                <tr>
                  <td> {{ $search->q }} </td>
                  <td> {{ $search->user->name ?? 'guest'  }} </td>
                  <td> {{ $search->created_at }} </td>
              </tr>
          @endforeach
        </tbody>
        
      </table>

      {{ $searches->links() }}
    </div>
</div>

</div>