@extends('layouts.tabler')

@section('title','My quiz')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Quizku </h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
           <div class="card-header mt-0">
            <h4 class="card-title">Aktifitas Quiz</h4>
          </div>
          <div class="table-responsive">
          <table class="table card-table table-striped text-nowrap table-vcenter">
            <thead>
              <tr>
                <th> Quizku</th>
                <th class="text-green"> Benar </th>
                <th class="text-danger"> Salah </th>
                <th class="text-primary"> Point </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> <div>{{ auth()->user()->quiz->count() }} </div>
                  <small class="text-muted"> Quiz yang tersubmit</small>
                       </td>
                <td class="text-green"> {{ auth()->user()->quizScore->benar }}
                <div class="progress progress-xs">
                <div class="progress-bar bg-green" style="width: {{ auth()->user()->quizScore->benar/(auth()->user()->quizScore->benar+auth()->user()->quizScore->salah)*100 }}%"></div>
             </div>
                </td>
                <td class="text-danger"> {{ auth()->user()->quizScore->salah }}
                <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: {{ auth()->user()->quizScore->salah/(auth()->user()->quizScore->benar+auth()->user()->quizScore->salah)*100 }}%"></div>
             </div>
                </td>
                <td class="text-primary"> {{ auth()->user()->quizScore->point }}
                <div class="progress progress-xs">
                <div class="progress-bar bg-primary" style="width: {{ auth()->user()->quizScore->point/(auth()->user()->quizScore->benar+auth()->user()->quizScore->salah)*100 }}%"></div>
             </div>
                </td>
              </tr>
            </tbody>
          </table>
          </div>

          <hr class="my-1">

           <div class="card-header mt-0">
            <h4 class="card-title">My Quiz</h4>
          </div>
          <div class="table-responsive">
            <table class="card-table table table-striped table-vcenter text-nowrap table-hover">
              <thead>
                <tr>
                  <th> Tersubmit </th>
                  <th class="text-success"> Benar </th>
                  <th class="text-danger"> Salah </th>
                  <th class="text-primary"> Total </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> <div>{{ auth()->user()->quiz->count( )}}</div> <small class="text-muted">Quiz tersubmit</small> </td>
                  <td class="text-success"> <div>{{ auth()->user()->quiz->sum('benar') }} </div>
                    <small class="text-muted">Menjawab dengan benar</small>
                  <div class="progress progress-xs">
                <div class="progress-bar bg-success" style="width: {{ auth()->user()->quiz()->sum('benar')/(auth()->user()->quiz->sum('benar')+auth()->user()->quiz->sum('salah'))*100 }}%"></div>
             </div>
                  </td>
                  <td class="text-danger"> <div>{{ auth()->user()->quiz->sum('salah') }} </div>
                    <small class="text-muted">Menjawab salah</small>
                  <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: {{ auth()->user()->quiz()->sum('salah')/(auth()->user()->quiz->sum('benar')+auth()->user()->quiz->sum('salah'))*100 }}%"></div>
             </div>
                  </td>
                  <td class="text-primary"> <div>{{ auth()->user()->quiz->sum('benar')+auth()->user()->quiz->sum('salah') }}</div>
                    <small class="text-muted">Quizku di jawab sebanyak ↑</small>

                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>

@if ($quizzes->count() > 0)
      @foreach ($quizzes as $q)
      <div class="col-md-6">
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <b>Q:</b> @parsedown(e($q->question))
            <hr class="my-2">
            <div {{ $q->correct == 'a' ? 'class="text-success"':''}}> <b>A:</b> @parsedown(e($q->answer_a)) </div>

            <div {{ $q->correct == 'b' ? 'class="text-success"':''}}> <b>B:</b> @parsedown(e($q->answer_b)) </div>

            <div {{ $q->correct == 'c' ? 'class="text-success"':''}}><b>C:</b> @parsedown(e($q->answer_c)) </div>

            <div {{ $q->correct == 'd' ? 'class="text-success"':''}}><b>D:</b> @parsedown(e($q->answer_d)) </div>

            <div>
              <b>Jawaban benar: {{ $q->correct }}</b><br>
              <small class="text-muted">
                {{ $q->created_at->diffForHumans() }}
                {!! $q->approved == 1 ? '<span class="text-success">Diterima</span>':'<span class="text-danger">Ditolak</span>'!!}
              </small>
              <br>
              <b>Dijawab sebanyak: </b> {{ $q->benar+$q->salah}}x<br>
              <b class="text-success"> {{ $q->benar }} </b>x menjawab dengan benar<br>
              <div class="progress progress-xs">
                <div class="progress-bar bg-success" style="width: {{ $q->benar/($q->benar+$q->salah)*100 }}%"></div>
             </div>
              <b class="text-danger"> {{ $q->salah }} </b>x menjawab salah<br>
<div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: {{ $q->salah/($q->benar+$q->salah)*100 }}%"></div>
             </div>

             <div class="form-group mt-5">
               <a href="/quiz/edit/{{$q->id}}" class="btn btn-secondary">edit</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="col-md-12">
        {{ $quizzes->links() }}
      </div>
@endif


    </div>
  </div>
</div>
@endsection