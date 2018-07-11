@php
$quiz = App\Quiz::get();
$score = App\QuizScore::get();
@endphp

<table class="table table-hover card-table" style="font-size:14px;font-weight:400">
  <tr>
    <td> Jumlah Quiz </td>
    <td class="text-right"> <span class="badge badge-default">{{ $quiz->count() }}</span> </td>
  </tr>
  <tr>
    <td> Quiz diterima </td>
    <td class="text-right"> <span class="badge badge-success">{{ $quiz->where('approved',1)->count() }}</span> </td>
  </tr>
  <tr>
    <td> Quiz ditolak </td>
    <td class="text-right"> <span class="badge badge-danger">{{ $quiz->where('approved',0)->count() }}</span> </td>
  </tr>
  <tr>
    <td> Jumlah Benar </td>
    <td class="text-right"> <span class="badge badge-success">{{ $quiz->sum('benar') }}</span> </td>
  </tr>
  <tr>
    <td> Jumlah Salah </td>
    <td class="text-right"> <span class="badge badge-danger">{{ $quiz->sum('salah') }}</span> </td>
  </tr>
  <tr>
    <td> Total point </td>
    <td class="text-right"> <span class="badge badge-primary">{{ $score->sum('point') }}</span> </td>
  </tr>
</table>