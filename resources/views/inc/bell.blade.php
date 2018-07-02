@auth
<div class="dropdown">
      <a class="nav-link icon" data-toggle="dropdown">
              <i class="fe fe-bell"></i>

@if (count(auth()->user()->notifications) > 0)
                 <span class="nav-unread"></span>
@endif
       </a>

  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
@if (count(auth()->user()->notifications))
    @foreach (collect(auth()->user()->notifications)->take(5) as $notify)
                    <a href="/forum/{{$notify->data['link']}}" class="dropdown-item d-flex">

                      <div>
                        <strong>{{ $notify->data['by'] }}</strong> {{ str_limit($notify->data['message'] ,25) }}
                        <div class="small text-muted">{{ $notify->created_at->diffForHumans() }} </div>
                      </div>
                    </a>

    	@endforeach

                    <div class="dropdown-divider"></div>
                    <a href="/profile/notifikasi" class="dropdown-item text-center text-muted-dark">Lihat semua</a>
    @else
    <span> Tidak ada notifikasi</span>
    @endif


  </div>
                </div>

@endauth