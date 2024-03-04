@if (config('ads.show_head') || !(new \App\User)->isTopContributor())

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3650356173552443"
     crossorigin="anonymous"></script>
@endif
