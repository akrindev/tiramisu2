@extends('layouts.tabler')

@section('title', 'Food List (Tukeran buff masakan)')
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
        @includeUnless(app()->isLocal(), 'inc.ads_article')

         <div class="alert alert-info">
           <strong>Tips!</strong> Saling berbagi buff masakan dengan cara berteman. buff kamu akan tampil disini dengan cara <a href="/setting/profile">edit profile</a>mu dan atur buff masakanmu lalu set privasi ke publik, jangan lupa isi kontak agar mudah di hubungi.
         </div>

         <div class="my-2">
           <livewire:food-member />
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
          <table class="card-table table table-bordered table-striped table-sm table-hover text-nowrap" style="font-size:12px">
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
        @includeUnless(app()->isLocal(), 'inc.ads_article')
      </div>
    </div>
  </div>
</div>
@endsection


@section('head')
  @livewireStyles
@endsection

@section('footer')
  @livewireScripts
@endsection
