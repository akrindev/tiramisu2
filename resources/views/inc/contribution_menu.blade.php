<div class="card">
  <div class="card-body p-3" style="font-size:13px">
  - <a href="/contribution/show">Data kontribusi</a> <br>
  - <a href="/contribution/submit">My Submited Contribution</a> <br>
@auth
  <hr class="my-1">
  <strong>Point:</strong> {{ auth()->user()->contribution->point ?? 0 }} <br>
  <strong class="text-success">Diterima:</strong> {{ auth()->user()->contributionDrop()->whereAccepted(1)->count() }} <br>
<strong class="text-danger">Pending:</strong> {{ auth()->user()->contributionDrop()->whereAccepted(0)->count() }} <br>
    <br>
  <small class="text-muted">1 kontribusi yang di terima akan mendapat 3 point <br> jika kontribusi terdapat gambar maka point akan ditambah + 5 <br>
    jika mengedit disertai dengan gambar, jangan lupa untuk mengecrop terlebih dahulu dengan rasio 1:1 <br> usahakan untuk memakai hanya equip tersebut </small> <br>
    <hr class="my-1">
    <strong>5 Top contributor</strong> <br>
    @foreach((new App\Contribution)->orderByDesc('point')->take(5)->get() as $con)
      - {{ $con->user->name }} ({{ $con->user->contribution->point }} point) <br>
    @endforeach
  @if(auth()->user()->isAdmin())
   <hr class="my-1">
    - <a href="/contribution/sudo">Moderasi</a>
  @endif
@endauth
  </div>
</div>