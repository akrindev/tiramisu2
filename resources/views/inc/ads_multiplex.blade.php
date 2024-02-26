@if (!(new \App\User)->isTopContributor() || config('ads.disable') == false)

<div class="my-3 ads">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3650356173552443"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="autorelaxed"
     data-ad-client="ca-pub-3650356173552443"
     data-ad-slot="6399909006"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
@endif
