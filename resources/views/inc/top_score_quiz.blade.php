@php
$scores = App\QuizScore::take(20)->get();

$scores = collect($scores)->sortByDesc(['point']);

$i=1;
@endphp

<tbody>
@foreach ($scores as $score)
   <tr>
     <td class="text-center mr-1 ml-1">
      <div style="background-image: url(https://graph.facebook.com/{{$score->user->provider_id}}/picture?type=normal)" class="avatar d-block"></div></td>
     <td>
       <div> {{ str_limit($score->user->name,15) }}</div>
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
       <small class="text-muted">Last seen: {{ $score->updated_at->diffForHumans() }}</small>
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