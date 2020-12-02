@extends('layouts.tabler')

@section('title','Main Quest Exp Calculator (MQ Calculator)')
@section('description','Kalkulasi jumlah exp yang di butuhkan dari Nc, bnut sampai Quest. kuy cek disini')
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
                          <td> <input type="number" class="form-control" id="level" value="100" oninput="App.calculate()"/> </td>
                        </tr>
                        <tr>
                          <th>Your Level %</th>
                          <td> <input type="number" class="form-control" id="percent" value="69" oninput="App.calculate()"/> </td>
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
  th, td {
    padding: 12px;
    border: 1px solid #ddd
  }
</style>
@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.20/lodash.min.js"></script>
 <script src="/assets/js/mq.js"></script>
@endsection