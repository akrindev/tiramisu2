<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#0066ff">
    <meta name="theme-color" content="#0066ff">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <meta name="apple-mobile-web-app-title" content="toram-id">
    <meta name="application-name" content="toram-id.info">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">

    <link rel="preconnect" href="https://www.google-analytics.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>

    <title>@yield('title') | RPG Toram Online Database & Wiki</title>

    <!-- open graph -->
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />
    <meta content='Toram Online Indonesia' property='og:site_name'/>
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="fb:app_id" content="2008283499456981"/>

    <!-- // open graph -->

    {{-- tw card --}}
    <meta name="twitter:image:src" content="@yield('image')">
    <meta name="twitter:site" content="@toramidinfo">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    {{-- tw --}}

    <meta name="google-site-verification" content="da3qNV1VnD0nhZNfFMx3Ov_6dnyvYMlUT7OChWqSbmY" />
    <meta name="description" content="@yield('description')">
	<meta name="keywords" content="Toram Id, Toram Online Wiki, Toram Online Database, Drop list, Monster list, Fill Stat formula, Fill stat simulator, calculator, forum, Toram Online Indonesia, MMORPG Android and iOS game" />

@stack('canonical')

    <script type='application/ld+json'>
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "url": "{{ url('/') }}",
          "potentialAction": {
              "@type": "SearchAction",
              "target": "{{ url('/') }}/search?q={q}",
              "query-input": "required name=q"
           }
    }
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <!-- Dashboard Core -->
    <link href="/assets/css/app.min.css?v=1" rel="stylesheet" />
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/core.js?1"></script>

@auth
    <script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-messaging.js"></script>
    <script src="/assets/js/fcm.js?v2"></script>
@endauth

<script>
  window.addEventListener("load",function() {
    setTimeout(function(){
      // This hides the address bar:
      window.scrollTo(0, 1);
    }, 0);
  });
</script>
    @yield('head')

    @includeUnless(app()->isLocal(), 'inc.ads')
  </head>

  <body itemscope itemtype="https://schema.org/WebSite">
    <meta itemprop="url" content="{{ url('/') }}">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="/{{ request()->segment(1) === 'en' || app()->isLocale('en') ? 'en' : '' }}">
                <img src="/img/logo.png" class="header-brand-img lazyload animated rotateIn" alt="Toram-id.info logo"> Toram Online
              </a>
              <div class="d-flex order-lg-2 ml-auto">
@guest
 				@include('inc.login')
@else
               <div class="nav-item d-md-flex">
@include('inc.bell')
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url({{ Auth::user()->getAvatar() }})"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ Auth::user()->name }}</span>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="/profile">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="/setting/profile">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="#" onClick="alert('under development')">
                      <i class="dropdown-icon fe fe-send"></i> Message
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onClick="alert('under development')">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                  </div>
                </div>
              </div>
@endauth
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">

              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="/" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> {{ __('Perlengkapan') }}</a>
                    <div class="dropdown-menu dropdown-menu-arrow">

                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/26" class="dropdown-item ">{{ __('Pedang 1 Tangan') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/27" class="dropdown-item ">{{ __('Pedang 2 Tangan') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/28" class="dropdown-item ">{{ __('Tinju') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/29" class="dropdown-item ">{{ __('Tombak') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/13" class="dropdown-item ">{{ __('Pesawat Sihir') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/30" class="dropdown-item ">{{ __('Tongkat') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/14" class="dropdown-item ">{{ __('Busur') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/15" class="dropdown-item ">{{ __('Bowgun') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/25" class="dropdown-item ">{{ __('Katana') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/31" class="dropdown-item ">{{ __('Zirah') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/33" class="dropdown-item ">{{ __('Perkakas Tambahan') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/32" class="dropdown-item ">{{ __('Perkakas Spesial') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/43" class="dropdown-item ">{{ __('Tameng') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/44" class="dropdown-item ">{{ __('Belati') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/46" class="dropdown-item ">{{ __('Panah') }}</a>

                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-star"></i> Crysta</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/34" class="dropdown-item ">{{ __('Crysta Normal') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/35" class="dropdown-item ">{{ __('Crysta Senjata') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/36" class="dropdown-item ">{{ __('Crysta Zirah') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/37" class="dropdown-item ">{{ __('Crysta Perkakas Spesial') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/38" class="dropdown-item ">{{ __('Crysta Perkakas Tambahan') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/39" class="dropdown-item ">{{ __('Crysta Penguat') }}</a>
                      <a href="{{ request()->segment(1) == 'en' ? '/en' : '' }}/items/41" class="dropdown-item ">{{ __('Permata') }}</a>

                    </div>
                  </li>

<li class="nav-item dropdown">
      <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-github"></i> Peta &amp; NPC</a>
  <div class="dropdown-menu dropdown-menu-arrow">
    <a href="/monster" class="dropdown-item">Peta</a>
    <a href="/npc" class="dropdown-item">NPC</a>
  </div>
                  </li>


                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-folder"></i>Tools</a>
                    <div class="dropdown-menu dropdown-menu-arrow">

                      <a href="/fill_stats/formula" class="dropdown-item">Fill Stats Formula</a>
                      <a href="/fill_stats/simulator" class="dropdown-item ">Fill Stats Simulator</a>
                      <a href="/leveling" class="dropdown-item">Leveling Finder</a>
                      <a href="/exp" class="dropdown-item">Exp Calculator</a>
                      <a href="/mq_exp" class="dropdown-item">Main Quest (MQ) Exp Calculator</a>
                      <a href="/potensi/kalkulator" class="dropdown-item"> Potensi Kalkulator </a>
                      <a href="/refine/simulasi" class="dropdown-item">Simulasi Refine</a>
                      <a href="/cb" class="dropdown-item">Papan Market Calculator</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a href="/forum" class="nav-link"><i class="fe fe-users"></i> Forum</a>
                  </li>

                  <li class="nav-item">
                    <a href="/quiz" class="nav-link"><i class="fe fe-award"></i> Quiz</a>
                  </li>

                  <li class="nav-item">
                    <a href="/skill" class="nav-link"><i class="fe fe-droplet"></i>Skill</a>
                  </li>

                  <li class="nav-item">
                    <a href="/gallery" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
                  </li>


                  <li class="nav-item">
                    <a href="/avatar" class="nav-link"><i class="fe fe-shopping-bag"></i> Avatar</a>
                  </li>

                  <li class="nav-item">
                    <a href="/bgm" class="nav-link"><i class="fe fe-music"></i>Background music</a>
                  </li>

            <li class="nav-item dropdown">
                  <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-list"></i> Lainnya</a>
              <div class="dropdown-menu dropdown-menu-arrow">
                <a href="/prestasi" class="dropdown-item">Emblem / Prestasi</a>
                <a href="/cooking" class="dropdown-item">Cooking / Masakan</a>
                <a href="/dye" class="dropdown-item">Dye Bulanan</a>
				<a href="{{ app()->isLocale('en') ? '/en' : '' }}/appearance" class="dropdown-item">App Showcase (Appearance)</a>
				<a href="/registlet" class="dropdown-item">Registlet Gem Case List</a>
				<a href="/guilds" class="dropdown-item">Guild List</a>
              </div>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>

        @auth
        <div class="alert alert-info">
            <div class="container">
                Hello, <strong> {{ Auth::user()->name }}</strong>. Punya ide untuk berbagi tutorial Toram Online?<br>
                Yuk bagiin tutorial atau cerita Toram Onlinemu <br>

                <a href="/forum/baru" class="mt-3 btn btn-sm btn-primary">Tulis ah!</a>
            </div>
        </div>
        @endauth


  @yield('content')


         </div>
      <footer class="footer">
        <div class="container">
          @include('partnerSite.show')
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="text-center">
                <a href="/kebijakan-privasi">Kebijakan privasi</a> .
                <a href="/rules">Rules / Peraturan</a> .
                <a href="/tentang-kami">Tentang Kami</a>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright &copy; 2018 - {{ now()->year }} <a href="//id.toram.jp" rel="nofollow" target="_blank">Toram Online - ASOBIMO, INC</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
            </div>

            <div class="col-12 d-block col-lg-auto mt-3 mt-lg-0 text-center">
              <b>{ }</b> with <b class="text-danger animated pulse infinite">&hearts;</b> in <b>Pekalongan, Indonesia</b>
            </div>
          </div>
        </div>
      </footer>
    </div>
    @yield('footer')

 <script src="/assets/js/lazy.js"></script>
 <script src="/assets/js/vendors/bootstrap.bundle.min.js"></script>

@if(!app()->isLocal())
<!-- Google Analytics -->
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-109854426-2', 'auto');
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<!-- End Google Analytics -->
@endif
  </body>
</html>
