@extends('layouts.tabler')

@section('title','Main Quest Exp Calculator (MQ Calculator)')
@section('description','Kalkulasi jumlah exp yang di dapat dari MQ untuk menghitung kenaikan level')
@section('image','https://i.ibb.co/k1zFdBv/Level-CAP.png')

@push('canonical')
	@canonical
@endpush

@section('content')
  <div class="my-3 my-md-5">
    <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Main Quest Exp Calculator </h1>
    </div>

    <div class="row">

        <div class="col-md-8">
          @includeWhen(!app()->isLocal(), 'inc.ads_article')

          <div class="my-3">
            <div class="alert alert-info">
              <strong> Try</strong><br /> <a href="/exp"> Exp Calculator </a>
            </div>
          </div>

          <!-- card -->
          <div class="my-3">
              <div class="card">
                  <div class="card-body p-2">
                    <table>
                      <tbody>
                        <tr>
                          <th> Language </th>
                          <td> <select name="locale" id="locale" class="form-control" onchange="App.setLocale()">
                            <option value="1">Bahasa Indonesia</option>
                            <option value="2">English</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <th>Your Level</th>
                          <td> <input type="number" class="form-control" id="level" value="50" min=1 max=250 oninput="App.calculate()"/> </td>
                        </tr>
                        <tr>
                          <th>Your Level %</th>
                          <td> <input type="number" class="form-control" id="percent" value="1" min=0 max=100 oninput="App.calculate()"/> </td>
                        </tr>
                        <tr>
                          <th>MQ Episode (start)</th>
                          <td id="chap">  </td>
                        </tr>
                        <tr>
                          <th>MQ Episode (end)</th>
                          <td id="chap_end">  </td>
                        </tr>
                        <tr>
                          <th>Results</th>
                          <td id="results">  </td>
                        </tr>
                      </tbody>
                    </table>

          	@includeWhen(!app()->isLocal(), 'inc.ads_article')
                  </div>
              </div>
          </div>
         </div>

         <div class="col-md-4">
             @include('inc.menu')
         </div>
    </div>

    </div>
 </div>
@endsection

@section('head')
<style>
  table {
    width: 100%;
    border-collapse: collapse
  }
  th {
    white-space: nowrap;
  }
  th, td {
    padding: 12px;
    border: 1px solid #ddd
  }
</style>
@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.20/lodash.min.js"></script>
 <script src="/assets/js/mq.js?1"></script>
@endsection