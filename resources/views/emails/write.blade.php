@extends('layouts.sb-admin')

@section('title', 'Kirim email')


@section('content')
@if(session()->has('success'))
<div class="card-alert alert alert-success">
  {{ session('success') }}
</div>
@endif
  <div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tulis Email</h1>
  </div>

    <div class="row">
      <div class="col-xl-6 mb-5">
        <div class="card shadow">
                  <div class="card-header">
                    <h3 class="card-title">Kirim Email ke Member</h3>
                  </div>
                  <div class="card-body">
                    {!! form_open('/email/send') !!}
                    @csrf
                      <div class="form-group">
                        <div class="row align-items-center">
                          <label class="col-sm-2">To:</label>
                          <div class="col-sm-10">

          				  <select id="user" class="form-control" name="user_id" required>
            </select>

                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row align-items-center">
                          <label class="col-sm-2">Subject:</label>
                          <div class="col-sm-10">
                            <input type="text" name="subject" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <textarea rows="10" name="body" class="form-control" data-provide="markdown" required></textarea>
                      <div class="btn-list mt-4 text-right">
                        <button type="submit" class="btn btn-primary btn-space">Send message</button>
                      </div>
                    {!! form_close() !!}
                  </div>
                </div>
      </div>
      <div class="col-xl-6">
           <div class="card shadow">
                  <div class="card-header">
                    <h3 class="card-title">Kirim Email ke Semua Member</h3>
                  </div>
                  <div class="card-body">
                    {!! form_open('/email/sendtoall') !!}
                    @csrf
                      <div class="form-group">
                        <div class="row align-items-center">
                          <label class="col-sm-2">Subject:</label>
                          <div class="col-sm-10">
                            <input type="text" name="subject" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <textarea rows="10" name="body" class="form-control" data-provide="markdown" required></textarea>
                      <div class="btn-list mt-4 text-right">
                        <button type="submit" class="btn btn-primary btn-space">Send message</button>
                      </div>
                    {!! form_close() !!}
                  </div>
                </div>
      </div>
    </div>

  </div>
@endsection


@section('footer')
<link rel="stylesheet" href="/assets/css/selectize.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>
<script src="/assets/js/vendors/selectize.min.js"></script>
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script type="text/javascript">
        loadProgressBar();
    </script>


  <script>
  $('#user').selectize({
    valueField: 'id',
    labelField: 'name',
    searchField: 'name',
    create: true,
    options: [],
    render: {
      option: function (item, escape) {
        console.log(item);
        return '<div>' +
          '<span class="image"><img src="https://graph.facebook.com/'+ item.provider_id +'/picture?type=normal" alt=""></span>' +
          '<span class="title text-'+ (item.email ? 'success' : 'danger') +'">' + escape(item.name) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        console.log(data);
        return '<div>' +
          '<span class="image"><img src="https://graph.facebook.com/'+ data.provider_id +'/picture?type=normal" alt=""></span>' +
          escape(data.name) +
          '</div>';
      }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: '/email/user_emails',
          	data: {
              q: query
            },
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    }
});
    </script>
@endsection