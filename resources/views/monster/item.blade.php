@extends('layouts.tabler')

@section('title', $item->name)
@section('description', $item->name . ': ' . strip_tags(toHtml(optional($item->note)['monster'] ?? optional($item->note)['npc'])) ?? '' )
@section('image', !is_null($item->picture) ? asset($item->picture) : to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">{{ $item->name }}</h1>
    </div>

    <div class="row">
      <div class="col-md-8">
        @include('inc.cari')
      </div>

      <div class="col-md-8">
        @includeUnless(app()->isLocal(), 'inc.ads_article')

        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">

            <dl>
              <dt>
              <b class="h5"> <img src="{{$item->dropType->url}}" class="avatar avatar-sm mr-2"> <a href="/item/{{$item->id}}" class="text-primary">{{ $item->name }}</a></b>
                @if (auth()->check() && auth()->user()->isAdmin())
              <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-outline-secondary">edit</a>
           @endif
                <br>
              </dt>
              <dd>
                @if(!is_null($item->picture))
                <img src="/{{$item->picture}}" class="rounded my-2">
                @endif
                <div class="my-2">

         <!-- Item status -->
          <ul class="nav nav-tabs justify-content-center" id="statusTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link {{ !is_null(optional($item->note)['monster']) ? 'active' :  '' }}" id="status-monster-tab" data-toggle="tab" href="#status-monster" role="tab" aria-controls="status" aria-selected="{{ !is_null(optional($item->note)['monster']) ? 'true' : 'false' }}">
              Status
              @if(!is_null(optional($item->note)['monster']))
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ is_null(optional($item->note)['monster']) && !is_null(optional($item->note)['npc']) ? ' active' :  '' }}" id="status-npc-tab" data-toggle="tab" href="#status-npc" role="tab" aria-controls="status-npc" aria-selected="{{ is_null(optional($item->note)['monster']) && !is_null(optional($item->note)['npc']) ? 'true' :  'false' }}">Status: NPC
              @if(!is_null(optional($item->note)['npc']))
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="mats-tab" data-toggle="tab" href="#mats" role="tab" aria-controls="mats" aria-selected="false">Craft: Player
              @if($item->resep->count() > 0)
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
          </ul>

          <div class="tab-content" id="statusTabContent">
            <div class="tab-pane fade {{ !is_null(optional($item->note)['monster']) ? 'show active' :  '' }}" id="status-monster" role="tabpanel" aria-labelledby="status-monster-tab">
              <div class="my-5">
              @if(!is_null(optional($item->note)['monster']))
                <dl> <!-- dl start -->
                  {{ translate(toHtml(optional($item->note)['monster'])) }}
                </dl>
              @else
                <small class="text-muted">-- tidak ada --</small>
              @endif
              </div>
            </div>
            <div class="tab-pane fade{{ is_null(optional($item->note)['monster']) && !is_null(optional($item->note)['npc']) ? ' show active' :  '' }}" id="status-npc" role="tabpanel" aria-labelledby="status-npc-tab">

              <div class="my-5">
              @if(!is_null(optional($item->note)['npc']))
                <dl> <!-- dl start -->
                  {{ translate(toHtml(optional($item->note)['npc'])) }}
                </dl>
              @else
                <small class="text-muted">-- tidak ada --</small>
              @endif
              </div>

            </div>

            <div class="tab-pane fade" id="mats" role="tabpanel" aria-labelledby="mats-tab">


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
              </dd>
            </dl>
         <!-- using tab -->
          <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="drop-tab" data-toggle="tab" href="#drop" role="tab" aria-controls="drop" aria-selected="true">
                Drop dari
              @if($item->monsters->count() > 0)
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="from-quest-tab" data-toggle="tab" href="#from-quest" role="tab" aria-controls="from-quest" aria-selected="false">Dari quest
              @if ($item->fromQuest->count() > 0)
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
          </ul>


          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="drop" role="tabpanel" aria-labelledby="drop-tab">
              <div class="my-5">
              @if($item->monsters->count() > 0)
                <dl> <!-- dl start -->
              @foreach ($item->monsters as $mons)

               <div class="mb-5">
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
                   @if ($mons->picture != null)
                   <img src="/{{ $mons->picture }}" alt="{{ $mons->name }}" class="rounded my-2 d-block" width="150px" height="150px">
                   @endif
                  <b>{{ __('Unsur') }}:</b> <span> {{ __(ucfirst($mons->element->name)) }}</span> <br>
                   <b>{{ __('Peta') }}:</b> <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/peta/{{ $mons->map->id }}">{{ $mons->map->name }} </a>
                 </dd>
                 <b>Drop:</b><br>
                 @foreach ($mons->drops as $drop)
                 <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/item/{{ $drop->id }}"> <img src="{{ $drop->dropType->url }}" class="avatar avatar-sm"> {{ $drop->name }} </a>
                 @if ($drop->proses && $drop->sell)
                 <small class="text-muted">({{ $drop->proses ?? '-' }}pts / {{ $drop->sell ?? '-' }}s)</small>
                 @endif
                 <br>
                 @endforeach
                </div>
              @endforeach
          </dl>
              @else
                <small class="text-muted">-- tidak ada --</small>
              @endif
              </div>
            </div>
            <div class="tab-pane fade" id="from-quest" role="tabpanel" aria-labelledby="from-quest-tab">
              <div class="mt-5">
                @if ($item->fromQuest->count() > 0)
                  <b>Quest:</b> <br />
                  @foreach ($item->fromQuest as $quest)
                    - <a href="/npc/quest/{{ $quest->quest->id }}">{{ $quest->quest->name }}</a><br />
                  @endforeach
                @else
                   <small class="text-muted">-- Tidak ada --</small>
                @endif
              </div>

            </div>
          </div>

        <!-- end tab -->


        @includeUnless(app()->isLocal(), 'inc.ads_mobile')

          </div>
        </div>

        <div class="my-5">
        {{ $item->monsters()->paginate(20)->links() }}
        </div>

      </div>

      <div class="col-md-4">
      @include('inc.menu')
      </div>
    </div>
  </div>
</div>
@endsection