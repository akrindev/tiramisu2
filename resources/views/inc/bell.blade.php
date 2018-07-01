@auth
<div class="dropdown">
      <a class="nav-link icon" data-toggle="dropdown">
              <i class="fe fe-bell"></i>
                 <span class="nav-unread"></span>
       </a>

  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
@if (count(auth()->user()->notifications))
    @foreach (auth()->user()->notifications as $notify)
                    <a href="/forum/{{$notify->data['link']}}" class="dropdown-item d-flex">

                      <div>
                        <strong>{{ $notify->data['by'] }}</strong> {{ str_limit($notify->data['message'] ,25) }}
                        <div class="small text-muted">{{ $notify->created_at->diffForHumans() }} </div>
                      </div>
                    </a>
    	@endforeach
    @endif


  </div>
                </div>

@endauth