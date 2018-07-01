<?php
use App\Barang;
use App\Crysta;

$item = new Barang;
$crysta = new Crysta;

?>

<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#06f">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

    <title>Toram {{ $title ?? 'Online Database Indonesia' }}</title>


<meta property="og:url"                content="{{ url()->current() }}" />
<meta property="og:type"               content="article" />
<meta content='Toram Online Indonesia' property='og:site_name'/>
<meta property="og:title"              content="{{ $title ?? 'Online Database Indonesia' }}" />
<meta property="og:description"        content="{{ $deskripsi ?? 'Toram online Database bahasa indonesia, items, weapon, armor, monster, etc' }}" />
<meta property="og:image"              content="http://toram-id.info/img/logo.gif" />
<meta property="fb:app_id" content="2008283499456981"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="/assets/js/require.min.js"></script>
    <script>
      requirejs.config({
    	baseUrl: "{{ url('/') }}",
		});
	 </script>
    <!-- Dashboard Core -->
    <link href="/assets/css/dashboard.css" rel="stylesheet" />
    <script src="/assets/js/dashboard.js"></script>

    <!-- Input Mask Plugin -->
    <script src="/assets/plugins/input-mask/plugin.js"></script>

    @yield('head')


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109854426-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-109854426-3');
</script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6056470544527952",
    enable_page_level_ads: true
  });
</script>

  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="/">
                <img src="https://d33wubrfki0l68.cloudfront.net/33da70e44301595ca96031b373a20ec38b20dceb/befb8/img/placeholder-sqr.svg" data-src="/img/potum.gif" class="header-brand-img lazyload" alt="Toram-id.info logo"> Toram-id.info
              </a>
              <div class="d-flex order-lg-2 ml-auto">
@guest
 				<div class="nav-item d-md-flex">
                   <a href="/fb-login" class="btn btn-sm btn-outline-primary"><i class="fe fe-facebook"></i> Login</a>
                 </div>
@else
               <div class="nav-item d-md-flex">
@include('inc.bell')
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(https://graph.facebook.com/{{ Auth::user()->provider_id }}/picture?type=normal"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ Auth::user()->name }}</span>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="/u">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#" onClick="alert('under development')">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="/ucapan/buat">

                     <i class="dropdown-icon fe fe-mail"></i> Tulis Ucapan
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
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Perlengkapan</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
@php
       $a = $item->select('type','typeslug')->distinct()->get();

        foreach($a as $b):
@endphp
                      <a href="/equips/{{ $b->typeslug }}" class="dropdown-item ">{{ $b->type }}</a>

                      @php endforeach; @endphp
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-star"></i> Crysta</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
 @php
       $c = $crysta->select('type','typeslug')->distinct()->get();

        foreach($c as $d):
  @endphp
                      <a href="/crystas/{{ $d->typeslug }}" class="dropdown-item ">{{ $d->type }}</a>

                      @php endforeach @endphp

                    </div>
                  </li>

<li class="nav-item">
                    <a href="/monster" class="nav-link"><i class="fe fe-github"></i> Monster</a>
                  </li>
                  <li class="nav-item">
                    <a href="/exp" class="nav-link"><i class="fe fe-bar-chart"></i> Exp calculator</a>
                  </li>

                  <li class="nav-item">
                    <a href="/fill_stats" class="nav-link"><i class="fe fe-edit-2"></i> Fill stats formula</a>
                  </li>

                  <li class="nav-item">
                    <a href="/forum" class="nav-link"><i class="fe fe-users"></i> Forum</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>


  @yield('content')


         </div>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2018 <a href="/">Toram Online</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
            </div>

            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              <b>{ }</b> with <b class="text-danger">&hearts;</b> in <b>Pekalongan, Indonesia</b>
            </div>
          </div>
        </div>
      </footer>
    </div>

    @yield('footer')


  </body>
</html>