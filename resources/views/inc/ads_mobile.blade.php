@if (config('ads.disable') == false || !(new \App\User())->isTopContributor())
    <div class="ads">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3650356173552443"
            crossorigin="anonymous"></script>
        <!-- mobile ads~ -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-3650356173552443" data-ad-slot="1872592432"
            data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endif
