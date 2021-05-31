<div class="col-12 my-3">
<div class="card">
    <div class="card-body p-2" style="font-size:14px;font-weight:400">
      <div>
        <img src="{{ $item->dropType->url }}" alt="{{ $item->dropType->name }}" class="avatar avatar-sm mr-1" style="width:21px; height:21px; border-radius: 50%">
        <b class="h6"><a class="text-primary" href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/item/{{ $item->id }}">{{ $item->name }} ({{ $item->name_en }})</a></b>

        <button class="float-right btn btn-secondary" onclick="var y = window.open('/item/{{ $item->id }}/edit'); y.onbeforeunload = () => refresh();"> edit </button>
      <div class="row">


@if(! is_null($item->picture) && ! is_null($item->fullimage))
<div class="col-md-4 my-2">
<div id="carousel-controls" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
  <div class="carousel-item active">
      <img class="d-block lazyload" src="/img/ball-triangle.svg" data-src="/{{ $item->picture}}" data-holder-rendered="true" width="210px" height="210px">
  </div>
  <div class="carousel-item">
      <img class="d-block lazyload" src="/img/ball-triangle.svg" data-src="/{{ $item->fullimage }}" data-holder-rendered="true" width="210px" height="210px">
  </div>
</div>
                <a class="carousel-control-prev" href="#carousel-controls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-controls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
</div>
@endif

@if(! is_null($item->picture) && is_null($item->fullimage))
<div class="col-md-4 my-2">
<img src="/img/ball-triangle.svg" data-src="/{{ $item->picture }}" class="rounded my-2 d-block lazyload" width="210px" height="210px">
</div>
@endif

      @if(! is_null($item->note))
        <div class="col-md-8 my-1">
          <!-- Item status -->
    <ul class="nav nav-tabs justify-content-center" id="statusTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link {{ !is_null($item->note['monster']) ? 'active' :  '' }}" id="status-monster-tab" data-toggle="tab" href="#status-monster{{ $item->id }}" role="tab" aria-controls="status" aria-selected="true">
        Status
        @if(!is_null($item->note['monster']))
        <span class="nav-unread"></span>
        @endif
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link{{ is_null($item->note['monster']) && !is_null($item->note['npc']) ? ' active' :  '' }}" id="status-npc-tab" data-toggle="tab" href="#status-npc{{ $item->id }}" role="tab" aria-controls="status-npc" aria-selected="false">Status: NPC
        @if(!is_null($item->note['npc']))
        <span class="nav-unread"></span>
        @endif
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" id="mats-tab" data-toggle="tab" href="#mats{{ $item->id }}" role="tab" aria-controls="mats" aria-selected="false">Craft: Player
        @if($item->resep->count() > 0)
        <span class="nav-unread"></span>
        @endif
        </a>
      </li>
    </ul>

    <div class="tab-content" id="statusTabContent">
      <div class="tab-pane fade {{ !is_null($item->note['monster']) ? 'show active' :  '' }}" id="status-monster{{ $item->id }}" role="tabpanel" aria-labelledby="status-monster-tab">
        <div class="my-5">
        @if(!is_null($item->note['monster']))
          <dl> <!-- dl start -->
            {{ toHtml(translate($item->note['monster'])) }}
          </dl>
        @else
          <small class="text-muted">-- tidak ada --</small>
        @endif
        </div>
      </div>
      <div class="tab-pane fade{{ is_null($item->note['monster']) && !is_null($item->note['npc']) ? ' show active' :  '' }}" id="status-npc{{ $item->id }}" role="tabpanel" aria-labelledby="status-npc-tab">

        <div class="my-5">
        @if(!is_null($item->note['npc']))
          <dl> <!-- dl start -->
            {{ toHtml(translate($item->note['npc'])) }}
          </dl>
        @else
          <small class="text-muted">-- tidak ada --</small>
        @endif
        </div>

      </div>

      <div class="tab-pane fade" id="mats{{ $item->id }}" role="tabpanel" aria-labelledby="mats-tab">


       <div class="mt-5">

          </div>

      </div>
    </div>

        </div>
      @endif
       </div>

      </div>

      Released date: {{ $item->released ?? 'unknown' }}
      <details>
        <summary class="text-danger">
          <strong> {{ __('Bisa di peroleh dari') }}... </strong>
        </summary>

        <div class="my-2">
          @forelse($item->monsters as $monster)
          <i class="fe fe-github mr-2"></i><a href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/monster/{{ $monster->id }}" class="mr-1">{{ $monster->name }} (Lv {{ $monster->level }})</a> <small><a class="text-muted" href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/peta/{{ $monster->map->id }}"> [{{ $monster->map->name }}]</a></small> <br >
          @empty
            <i class="fe fe-eye mr-2"></i><a href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/item/{{ $item->id }}">{{ __('Lihat') }}... </a>
          @endforelse
        </div>
      </details>
    </div>
  </div>
</div>
