@if (config('ads.disable') == false || !(new \App\User)->isTopContributor())

<div class="my-5 container-fluid">
    <!-- Matched Pom -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:950px"
     data-ad-client="ca-pub-3650356173552443"
     data-ad-slot="3012467147"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
@endif
