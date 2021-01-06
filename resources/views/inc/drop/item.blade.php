<div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div>
              <img src="{{ $item->dropType->url }}" alt="{{ $item->dropType->name }}" class="avatar avatar-sm mr-1" style="max-width:21px;max-height:21px">
              <b class="h6"><a class="text-primary" href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/item/{{ $item->id }}">{{ $item->name }}</a></b>
           @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif

            <div class="row">


@if(! is_null($item->picture) && ! is_null($item->fullimage))
<div class="col-md-4 my-2">
<div id="carousel-controls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="my-2 d-block lazyload" src="/img/ball-triangle.svg" data-src="/{{ $item->picture}}" data-holder-rendered="true" width="200px" height="200px">
        </div>
        <div class="carousel-item">
            <img class="my-2 d-block lazyload" src="/img/ball-triangle.svg" data-src="/{{ $item->fullimage }}" data-holder-rendered="true" width="200px" height="200px">
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
    <img src="/img/ball-triangle.svg" data-src="/{{ $item->picture }}" class="rounded my-2 d-block lazyload" width="200px" height="200px">
</div>
@endif

            @if(! is_null($item->note))
              <div class="col-md-8 my-1">
                <!-- Item status -->
          <ul class="nav nav-tabs justify-content-center" id="statusTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link {{ !is_null($item->note['monster']) ? 'active' :  '' }}" id="status-monster-tab" data-toggle="tab" href="#status-monster{{ $loop->index }}" role="tab" aria-controls="status" aria-selected="true">
              Status
              @if(!is_null($item->note['monster']))
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ is_null($item->note['monster']) && !is_null($item->note['npc']) ? ' active' :  '' }}" id="status-npc-tab" data-toggle="tab" href="#status-npc{{ $loop->index }}" role="tab" aria-controls="status-npc" aria-selected="false">Status: NPC
              @if(!is_null($item->note['npc']))
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="mats-tab" data-toggle="tab" href="#mats{{ $loop->index }}" role="tab" aria-controls="mats" aria-selected="false">Craft: Player
              @if($item->resep->count() > 0)
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
          </ul>

          <div class="tab-content" id="statusTabContent">
            <div class="tab-pane fade {{ !is_null($item->note['monster']) ? 'show active' :  '' }}" id="status-monster{{ $loop->index }}" role="tabpanel" aria-labelledby="status-monster-tab">
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
            <div class="tab-pane fade{{ is_null($item->note['monster']) && !is_null($item->note['npc']) ? ' show active' :  '' }}" id="status-npc{{ $loop->index }}" role="tabpanel" aria-labelledby="status-npc-tab">

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

            <div class="tab-pane fade" id="mats{{ $loop->index }}" role="tabpanel" aria-labelledby="mats-tab">


             <div class="mt-5">
        @if($item->resep->count() > 0)
              <strong>Resep</strong><br>
                @foreach($item->resep as $resep)
                  <b>Fee:</b> {{ $resep->fee ?? '-' }}s <span class="ml-5"></span>
                  <b>Level:</b> {{ $resep->level ?? '-' }} <br>
                  <b>Diff:</b> {{ $resep->diff ?? '-' }} <span class="ml-5"></span>
                  <b>Set:</b> {{ $resep->set ?? '-'}}pcs <br>
                 <b>Base pot:</b> {{ $resep->pot }} <span class="ml-5"></span>
                 <b>Base atk/def:</b> {{ $resep->base }}
               <div class="mt-5"></div>
               <b>Bahan:</b> <br><br>
                    @foreach (explode(',',$resep->material) as $mat)
             <img src="{{ App\Drop::find($mat)->dropType->url }}" class="avatar avatar-sm" style="max-width:16px;max-height:16px"> <a href="/item/{{ App\Drop::find($mat)->id }}"> {{ App\Drop::find($mat)->name }}</a> x{{ explode(',',$resep->jumlah)[$loop->index] }}<br>

                    @endforeach
                  @endforeach
         @else
            <small class="text-muted">-- Tidak ada --</small>
         @endif
                </div>

            </div>
          </div>

              </div>
            @endif
             </div>

            </div>

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
