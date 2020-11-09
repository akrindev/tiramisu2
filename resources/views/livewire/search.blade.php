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

    @include('inc.drop.item', $item)

        @empty

       @endforelse


          @forelse ($monsters as $mons)

          @include('inc.drop.monster', $mons)

          @empty
          @endforelse


                @if(count($maps))
        <div class="card">
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
            <div>
              <strong class="h4">{{ __('Peta') }}</strong> <br>
              @foreach($maps as $map)
             <i class="fe fe-github mr-2"></i> <a href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/peta/{{ $map->id }}">{{ $map->name }}</a> <br>
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