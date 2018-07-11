@php
$scores = App\QuizScore::take(10)->get();

$scores = collect($scores)->sortByDesc('benar')->sortByDesc('point')->sortBy('salah');
$i=1;
@endphp
<tbody>
@foreach ($scores as $score)
   <tr>
     <td class="text-center">
      <div style="background-image: url(https://graph.facebook.com/{{$score->user->provider_id}}/picture?type=normal)" class="avatar d-block"></div></td>
     <td>
       <div> {{ $score->user->name }}</div>
       <div class="small text-muted">Peringkat {{ $i }} </div>
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
                <div class="progress-bar bg-primary" style="width: {{ $score->point/($score->benar+$score->salah)*100 }}%"></div>
             </div>
     </td>

   </tr>
@php
$i++;
@endphp
@endforeach
</tbody>