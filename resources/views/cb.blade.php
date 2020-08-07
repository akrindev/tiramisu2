@extends('layouts.tabler')

@section('title', 'Toram Papan Market calculator')
@section('description', 'Kalkulasi penjualan di papan toram')

@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Toram Consignment Board Calculator</h3>
    </div>


    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3">

            <div class="form-group">
              <label class="form-label">Harga Jual</label>
              <input type="text" class="form-control" name="harga" id="harga" value="1">
            </div>

            <div class="form-group">
              <label class="form-label">Global Tax</label>
              <select name="tax" id="tax" class="form-control">
                <option value="0.2">+20</option>
                <option value="0.19">+19</option>
                <option value="0.18">+18</option>
                <option value="0.17">+17</option>
                <option value="0.16">+16</option>
                <option value="0.15">+15</option>
                <option value="0.14">+14</option>
                <option value="0.13">+13</option>
                <option value="0.12">+12</option>
                <option value="0.11">+11</option>
                <option value="0.10">+10</option>
                <option value="0.09">+9</option>
                <option value="0.08">+8</option>
                <option value="0.07">+7</option>
                <option value="0.06">+6</option>
                <option value="0.05">+5</option>
                <option value="0.04">+4</option>
                <option value="0.03">+3</option>
                <option value="0.02">+2</option>
                <option value="0.01">+1</option>
              </select>
            </div>

            <div class="form-group">
              <button class="btn btn-pill btn-outline-primary" id="cek">Kalkulasi</button>
            </div>

            <div class="form-group">
              <label class="form-label">Tanpa Full vip ticket</label>
              <b>Fee:</b> <span id="nfee" class="text-danger"></span> <br>
              <b>Laba:</b> <span id="nlaba" class="text-success"></span> <br>
            </div>

            <div class="form-group">
              <label class="form-label">Dengan VIP Ticket</label>
              <b>Fee:</b> <span id="fee" class="text-danger"></span> <br>
              <b>Laba:</b> <span id="laba" class="text-success"></span> <br>
            </div>

            <div class="form-group">
              <label class="form-label">Global</label>
              <b>Harga yang tampil di board:</b>  <span id="nglobal" class="text-primary"></span>
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

@section('footer')
<script src="/assets/js/cb.js"></script>
@endsection