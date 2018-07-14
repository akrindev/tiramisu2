@extends('layouts.tabler')

@section('title','Toram fill stats Calculator')
@section('description','Toram fill stats calculator +16')
@sectoon('image',to_img())

@section('content')
<div class="my-5">
  <div class="container">

    <div class="page-header">
      <h1 class="page-title"> Fill Calculator</h1>
    </div>

    <div class="row">


      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Recipes </h3>
          </div>

          <div class="card-body p-3" style="font-size:14px;font-weight:400">
          </div>
        </div>
      </div>

      <div class="col-md-4">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Recipes </h3>
          </div>

          <div class="card-body p-3" style="font-size:14px;font-weight:400">
          </div>
        </div>
      </div>

      <div class="col-md-4">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Recipes </h3>
          </div>

          <div class="card-body p-3" style="font-size:14px;font-weight:400">
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
@endsection