<div class="card">
    <div class="card-body p-3" style="font-size:14px;font-weight:400">
        <a rel="nofollow" target="_blank" href="/temp/monster/edit/{{ $mons->id }}"
            class="small text-muted float-right"> <span data-nosnippet>[<i>sarankan edit</i>]</span>
        </a>

        <dl> <!-- dl start -->

            <div class="mb-5">
                <dt class="mb-1">
                    <b class="h6">
                        <a class="text-primary" href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/monster/{{$mons->id}}">
                            {{ $mons->name }} (Lv {{$mons->level}})
                        </a>
                        @switch($mons->type)
                            @case(2)
                            <img src="/img/f_boss.png" alt="mini boss" style="display:inline;max-width:120px;max-height:15px;">
                            @break
                            @case(3)
                            <img src="/img/boss.png" class="boss" style="display:inline;max-width:120px;max-height:15px;">
                        @endswitch
                    </b>
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="/monster/{{ $mons->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
                    @endif
                </dt>

                <div class="row">
                    @if(! is_null($mons->picture))
                    <div class="col-md-3">
                        <img src="/img/ball-triangle.svg" data-src="{{ $mons->picture }}"
                            class="rounded my-2 d-block lazyload" width="170px" height="170px" alt="{{ $mons->name }}">
                    </div>
                    @endif

                    <div class="col-md-9">
                        <b>{{ __('Unsur') }}:</b>  <span class="">{{ __(ucfirst($mons->element->name)) }}</span> <br>
                        <b>HP:</b> <span class="text-muted"> {{ $mons->hp ?? '-- unknown--' }} </span> <br>
                        <b>XP:</b> <span class="text-muted"> {{ $mons->xp ?? '-- unknown --' }} </span>
                        @if ($mons->type == 3 || $mons->type == 2)
                        <br>
                        <b>Leveling:</b> {{ $mons->level-3 }} <span class="text-muted">s/d</span> {{ $mons->level+3 }}
                        @endif
                        <br>
                        <b>{{ __('Peta') }}:</b>
                        <a href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/peta/{{ $mons->map->id }}">
                            {{ $mons->map->name }}
                        </a>
                        @if($mons->drops->count() > 0)
                            <div class="my-2"></div>
                            <b>Drop:</b><br>
                            @foreach ($mons->drops as $drop)
                                <a href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/item/{{$drop->id}}">
                                    <img src="{{$drop->dropType->url}}" class="avatar avatar-sm">
                                        {{$drop->name}}
                                </a>
                            @if ($drop->proses && $drop->sell)
                                <small class="text-muted">({{ $drop->proses ?? '-' }}pts / {{ $drop->sell ?? '-' }}s)</small>
                            @endif
                            <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </dl> <!-- // dl end -->
    </div>
</div>
