<!DOCTYPE html>
<html lang="ID">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="id-ID" />

<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#0066ff">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <meta name="apple-mobile-web-app-title" content="toram-id.info">
    <meta name="application-name" content="toram-id.info">

    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">

    <title>@yield('title') | Toram</title>

<!-- open graph -->
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="article" />
<meta content='Toram Online Indonesia' property='og:site_name'/>
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')" />
<meta property="og:image" content="@yield('image')" />
<meta property="fb:app_id" content="2008283499456981"/>

<!-- // open graph -->
<meta name="google-site-verification" content="da3qNV1VnD0nhZNfFMx3Ov_6dnyvYMlUT7OChWqSbmY" />
<meta name="description" content="@yield('description')">
<meta name='language' content='id_id'/>
<meta name='robots' content='all,index,follow'/>
<meta content='follow, all' name='alexabot'/>
<meta content='id' name='language'/>
<meta content='Indonesia' name='geo.placename'/>
<meta content='global' name='target'/>
<meta content='Indonesia' name='geo.country'/>
<meta content='all' name='googlebot'/>
<meta content='all' name='msnbot'/>
<meta content='all' name='Googlebot-Image'/>
<meta content='all' name='Slurp'/>
<meta content='all' name='ZyBorg'/>
<meta content='all' name='Scooter'/>
<meta content='ALL' name='spiders'/>
<meta content='general' name='rating'/>
<meta content='all' name='WEBCRAWLERS'/>


<script type='application/ld+json'>
{
	 "@context": "http://schema.org",
	 "@type": "WebSite",
	 "url": "{{ url('/') }}"
 }
</script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Dashboard Core -->
    <link href="/assets/css/app.min.css" rel="stylesheet" />
    <script src="/assets/js/jquery.min.js"></script>
     <script src="/assets/js/core.js"></script>

@auth
    <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase.js"></script>
     <script src="/assets/js/fcm.js"></script>
@endauth

    <script>
if('serviceWorker' in navigator)
{
  navigator.serviceWorker.register('/sw.js')
    .then(function() {
    console.log('Service Worker Registered');
  });
}
    </script>

    @yield('head')

    @includeWhen(env('APP_ENV') === 'production', 'inc.ads')
  </head>


  <body class="">
    <div class="page">
      <div class="page-main">

  @yield('content')
      </div>

   <!--   <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="text-center">
                <a href="/kebijakan-privasi">Kebijakan privasi</a> .
                <a href="/rules">Rules / Peraturan</a> .
                <a href="/tentang-kami">Tentang Kami</a>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2018 <a href="//id.toram.jp" rel="nofollow" target="_blank">Toram Online - ASOBIMO, INC</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
            </div>

            <div class="col-12 d-none d-md-block col-lg-auto mt-3 mt-lg-0 text-center">
              <b>{ }</b> with <b class="text-danger">&hearts;</b> in <b>Pekalongan, Indonesia</b>
            </div>
          </div>
        </div>
      </footer> -->
    </div>

    @yield('footer')

 <script src="/assets/js/lazy.js"></script>
 <script src="/assets/js/vendors/bootstrap.bundle.min.js"></script>


@if(env('APP_ENV') === 'production')
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