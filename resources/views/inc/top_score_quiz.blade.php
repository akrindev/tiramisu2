@php
$scores = App\QuizScore::take(10)->get();

$scores = collect($scores)->sortByDesc('benar')->sortByDesc('point');
$i=1;
@endphp
<tbody>
@foreach ($scores as $score)
   <tr>
     <td cass="text-center">
      <img src="https://graph.facebook.com/{{$score->user->provider_id}}/picture?type=normal" class="avatar avatar-md d-block"/></td>
     <td>
       <div> {{ $score->user->name }}</div>
       <small class="text-muted">Peringkat {{ $i }} </small>
     </td>
     <td>  <b>{{ $score->benar }}</b>
       <div class="progress progress-xs">
                <div class="progress-bar bg-green" style="width: {{ $score->benar/($score->benar+$score->salah)*100 }}%"></div>
             </div>
     </td>
     <td>
       <b>{{ $score->salah }}</b>
       <div class="progress progress-xs">
                <div class="progress-bar bg-red" style="width: {{ $score->salah/($score->benar+$score->salah)*100 }}%"></div>
             </div>
     </td>
     <td>
       <div>{{ $score->point }}</div>
       <small class="text-muted">{{ $score->created_at->diffForHumans() }}</small>
       <div class="progress progress-xs">
                <div class="progress-bar bg-primary" style="width: {{ $score->salah/($score->benar+$score->salah)*100 }}%"></div>
             </div>
     </td>

   </tr>
@php
$i++;
@endphp
@endforeach
</tbody>