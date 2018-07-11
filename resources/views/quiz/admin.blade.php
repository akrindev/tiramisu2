@extends('layouts.tabler')

@section('title','My quiz')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"> Admin Quiz </h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">

           <div class="card-header mt-0">
            <h4 class="card-title">Aktifitas Quiz</h4>
          </div>
          <div class="table-responsive">
            <table class="card-table table table-striped table-vcenter text-nowrap table-hover">
              <thead>
                <tr>
                  <th> Tersubmit </th>
                  <th class="text-success"> Benar </th>
                  <th class="text-danger"> Salah </th>
                  <th class="text-primary"> Total </th>
                  <th> Status </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> <div>{{ $quiz->count()}}</div> <small class="text-muted">Quiz tersubmit</small> </td>
                  <td class="text-success"> <div>{{ $quiz->sum('benar') }} </div>
                    <small class="text-muted">Menjawab dengan benar</small>
                  <div class="progress progress-xs">
                <div class="progress-bar bg-success" style="width: {{ $quiz->sum('benar')/($quiz->sum('benar')+$quiz->sum('salah') == 0 ?: 1)*100 }}%"></div>
             </div>
                  </td>
                  <td class="text-danger"> <div>{{ $quiz->sum('salah') }} </div>
                    <small class="text-muted">Menjawab salah</small>
                  <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: {{ $quiz->sum('salah')/($quiz->sum('benar')+$quiz->sum('salah') == 0 ?: 1)*100 }}%"></div>
             </div>
                  </td>
                  <td class="text-primary"> <div>{{ $quiz->sum('benar')+$quiz->sum('salah') }}</div>
                    <small class="text-muted">Quizku di jawab sebanyak ↑</small>

                  </td>
                  <td> <div class="text-success"> {{ $quiz->where('approved',1)->count() }}</div><small class="text-muted"> Quiz diterima</small><br>

                   <div class="text-danger"> {{ $quiz->where('approved',0)->count() }}</div> <small class="text-muted"> Quiz ditolak</small><br>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>

      @if (session()->has('sukses'))
      <div class="alert alert-success">
        {{ session('sukses' )}}
      </div>
      @endif

@if ($quizzes->count() > 0)
      @foreach ($quizzes as $q)
      <div class="col-md-6" class="nyan-{{$q->id}}">
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
                <div class="progress-bar bg-success" style="width: {{ $q->benar/($q->benar+$q->salah == 0 ?: 1)*100 }}%"></div>
             </div>
              <b class="text-danger"> {{ $q->salah }} </b>x menjawab salah<br>
<div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: {{ $q->salah/($q->benar+$q->salah == 0 ?: 1)*100 }}%"></div>
             </div>

             <div class="form-group mt-5">
               <a href="/quiz/edit/{{$q->id}}" class="btn btn-secondary">edit</a>
               {!! form_open('/quiz/destroy', ['id'=>'hapus']) !!}
               @csrf
               @method("DELETE")
               <input type="hidden" value="{{$q->id}}" name="id" nyan="{{$q->id}}">
               <button type="submit" class="btn btn-outline-danger float-right">hapus</button>
               {!! form_close() !!}
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

@section('footer')

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $("#hapus").submit(function(e){
  	e.preventDefault();
    swal({
    	title: 'Hapus quiz ini?',
      	text:'',
      	icon: 'warning',
      	buttons: true,
    }).then((gas) => {
    	if(gas)
          {
            swal('menghapus');
            $.ajax({
            	url: $(this).attr('action'),
              	type:'post',
              	data: $(this).serialize(),
              	success:function(){
                  swal('dihapus');
                var rm = $(this).attr('nyan');
                  $(".nyan-"+rm).slideUp();
                },
              	error: function(r,t,y)
              {
                swal(r);
              }
            });
          }
      else
        {
          swal('aman gan!');
        }
    });
  });
</script>
@endsection