<div class="col-md-8">

    <div class="card">
        <div class="card-body p-3">
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="id" class="selectgroup-input" checked="" wire:click="switchLocalization('id')">
                    <span class="selectgroup-button">Indonesia</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="en" class="selectgroup-input" wire:click="switchLocalization('en')">
                    <span class="selectgroup-button">English</span>
                </label>
            </div>
        </div>
    </div>

        @if(strpos(strtolower($q), 'dye') !== false)
        <div class="card">
          <div class="card-body p-3" style="font-size:15px;font-weight:400">
            Barangkali kamu mencari <b><a href="/dye">Info dye bulan {{ now()->formatLocalized('%B %Y') }}</a></b>
            </div>
        </div>
        @endif

          @if(count($forums) == 0 && count($drops) == 0 && count($monsters) == 0 && count($maps) == 0)
        <div class="card">
          <div class="card-body p-3" style="font-size:15px;font-weight:400">
            <b>Pencarian <u>{{ $q }}</u> tidak di temukan.</b>
            <div class="my-3"></div>

            Barangkali kamu mencari <b><a href="/leveling">Toram leveling finder</a></b>
            </div>
        </div>
          @else

          @includeWhen(!app()->isLocal(), 'inc.ads_article')

          @endif

       @forelse($drops as $item)
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
              <img src="{{ $item->dropType->url }}" alt="{{ $item->dropType->name }}" class="avatar avatar-sm mr-1" style="max-width:21px;max-height:21px">
              <b class="h6"><a class="text-primary" href="/item/{{ $item->id }}">{{ $item->name }}</a></b>
           @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif

            <div class="row">
            @if(! is_null($item->picture))
              <div class="col-md-3">
              <img src="/img/ball-triangle.svg" data-src="/{{ $item->picture }}" class="rounded my-2 d-block lazyload" width="170px" height="170px"> </div>
            @endif

            @if(! is_null($item->note))
              <div class="col-md-9 my-1">
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
                  {{ toHtml($item->note['monster']) }}
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
                  {{ toHtml($item->note['npc']) }}
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

            <!-- details -->

            <details>
              <summary class="text-danger">
                <strong>{{ __('Bisa di peroleh dari') }}... </strong>
              </summary>

              <div class="my-2">
                @forelse($item->monsters as $monster)
                <i class="fe fe-github mr-2"></i><a href="/monster/{{ $monster->id }}" class="mr-1">{{ $monster->name }} (Lv {{ $monster->level }})</a> <small><a class="text-muted" href="/peta/{{ $monster->map->id }}"> [{{ $monster->map->name }}]</a></small> <br >
                @empty
                  <i class="fe fe-eye mr-2"></i><a href="/item/{{ $item->id }}">{{ __('Lihat') }} ... </a>
                @endforelse
              </div>
            </details>

            </div>
        </div>
        @empty

       @endforelse


        @includeUnless(app()->isLocal(), 'inc.ads_article')

          @forelse ($monsters as $mons)
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">

          <dl> <!-- dl start -->
          <div class="">
           <dt class="mb-1">
           <b class="h6"> <a class="text-primary" href="/monster/{{ $mons->id }}">{{ $mons->name }} (Lv {{ $mons->level }}) </a>
          @switch($mons->type)
             @case(2)
               <img src="/img/f_boss.png" alt="mini boss" style="display:inline;max-width:120px;max-height:15px;">
               @break
             @case(3)
               <img src="/img/boss.png" class="boss" style="display:inline;max-width:120px;max-height:15px;">
          @endswitch
            </b>
           </dt>
            <dd>
            <div class="row">
               @if ($mons->picture != null)
               <div class="col-md-3"><img src="/{{ $mons->picture }}" alt="{{ $mons->name }}" class="rounded my-2 d-block" width="170px" height="170px"></div>
               @endif

               <div class="col-md-9">
               <b>Unsur:</b> <span> {{ ucfirst($mons->element->name) }}</span> <br>
               <b>HP:</b> <span class="text-muted"> {{ $mons->hp ?? '-- unknown --' }} </span>

              @if($mons->type == 3 || $mons->type == 2)
                 <br>
                <b>Leveling:</b> {{ $mons->level-3 }} <span class="text-muted">s/d</span> {{ $mons->level+3 }}
              @endif
                 <br>
               <b>Peta: </b> <a href="/peta/{{ $mons->map->id }}">{{ $mons->map->name }}</a>
               </div>
            </div>
            </dd>
            </div>
          </dl> <!-- // dl end -->
          </div>
        </div>
          @empty
          @endforelse


                @if(count($maps))
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div>
              <strong class="h4">Peta</strong> <br>
              @foreach($maps as $map)
             <i class="fe fe-github mr-2"></i> <a href="/peta/{{ $map->id }}">{{ $map->name }}</a> <br>
              @endforeach
            </div>
          </div>
        </div>
                @endif

        @includeUnless(app()->isLocal(), 'inc.ads_mobile')


       @if(count($forums))
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div>
              <strong class="h4">Forum Artikel</strong> <br>

              @foreach($forums as $forum)
             <i class="fe fe-chevron-right mr-2"></i> <a href="/forum/{{ $forum->slug }}">{{ $forum->judul }}</a> <br>
              @endforeach
            </div>

          </div>
        </div>

        @includeUnless(app()->isLocal(), 'inc.ads_mobile')
       @endif

        {{-- $drops->appends(['q' => request('q'), 'type' => request('type') ])->links() --}}


      </div>