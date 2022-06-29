@extends('layouts.tabler')

@section('title', isset($type) ?  __($type) . ' App Showcase (Appearance)' : 'App Showcase (Appearance)')

@section('content')
<div class="my-5">
  <div class="container">

      @includeUnless(app()->isLocal(), 'inc.ads_article')

    <div class="page-header">
      <h1 class="page-title">{{ isset($type) ? __($type) : '' }} Appearance Showcase</h1>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="row">
              <div class="col-12">
<div class="card">
    <div class="card-body p-3">
        <strong class="d-block mb-2">Select Appearance to Show</strong>
    <div class=" row gutters-xs">
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/26" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/pedang.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px"> {{ __('Pedang 1 Tangan') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/27" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/pedang_raya.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">
        {{ __('Pedang 2 Tangan') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/28" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/tinju.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Tinju') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/29" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/tombak.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Tombak') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/13" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/alat_sihir.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Pesawat Sihir') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/30" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/tongkat.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Tongkat') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/14" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/bow.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Busur') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/15" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/bowgun.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Bowgun') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/25" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/katana.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Katana') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/31" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/zirah.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Zirah') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/33" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/pelengkap.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Perkakas Tambahan') }}</a>
      <a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance/43" class="d-block mb-1 col-6 col-md-4">
              <img src="/img/drop/tameng.jpg" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">{{ __('Tameng') }}</a>
    </div>
</div>
    </div>
              </div>

          <div class="col-12 text-center">
              <h3>Found {{ $apps->total() }} Results</h3>
          </div>
          @foreach ($apps as $app)
          @if (($loop->index+1)%6 == 0)
                @includeUnless(app()->isLocal(), 'inc.ads_mobile')
          @endif
        <div class="col-md-4">
            <div class="card p-0">
              <a href="{{ app()->isLocale('en') ? '/en' : '' }}/item/{{ $app->id }}">
                <img src="{{ $app->picture }}" alt="{{ $app->name }}" style="min-width: 100%; min-height: 370px; object-fit: cover">
              </a>

              <div class="d-flex align-items-center p-3">
                    <div class="mr-3" style=""><img src="{{ $app->dropType->url }}" class="avatar avatar-md lazyload"></div>
                    <div>
                      <div> <a href="{{ app()->isLocale('en') ? '/en' : '' }}/item/{{ $app->id }}"> {{ $app->name }} </a> </div>
                      <small class="d-block text-muted">{{ $app->dropType->name }}
                     </small>

                    </div>
                    <div class="ml-auto text-muted">
                        {{-- // --}}
                    </div>
                  </div>
            </div>
        </div>

        @if (! is_null($app->fullimage))
        <div class="col-md-4">
                <div class="card p-0">
              <a href="{{ app()->isLocale('en') ? '/en' : '' }}/item/{{ $app->id }}">
                <img src="//toram-id.info/{{ $app->fullimage }}" alt="{{ $app->name }}" style="min-width: 100%; min-height: 370px; object-fit: cover">
              </a>

              <div class="d-flex align-items-center p-3">
                    <div class="mr-3" style=""><img src="{{ $app->dropType->url }}" class="avatar avatar-md lazyload"></div>
                    <div>
                      <div>
                          <a href="{{ app()->isLocale('en') ? '/en' : '' }}/item/{{ $app->id }}">
                            {{ $app->name }}
                          </a>
                      </div>
                      <small class="d-block text-muted">{{ $app->dropType->name }}
                     </small>

                    </div>
                    <div class="ml-auto text-muted">
                        {{-- // --}}
                    </div>
                  </div>
        </div>
    </div>
    @endif
              @endforeach
            </div>

            {{ $apps->onEachSide(1)->links() }}

            @includeUnless(app()->isLocal(), 'inc.ads_article')

      </div>
    </div>

  </div>
</div>
@endsection
