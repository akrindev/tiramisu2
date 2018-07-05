<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
  @foreach ($equips as $equip)
    <url>
      <loc>{{ url('/equip/' . $equip->slug) }}</loc>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
      <image:image>
        <image:loc>
          {{ url('/'.$equip->pics) }}
        </image:loc>
      </image:image>
    </url>
  @endforeach

  @foreach ($crystas as $crysta)
    <url>
      <loc>{{ url('/crysta/' . $crysta->slug) }}</loc>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
    </url>
  @endforeach

  @foreach ($tags as $tag)
    <url>
      <loc>{{ url('/forum/tag/' . $tag->name) }}</loc>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
    </url>
  @endforeach

  @foreach ($forums as $forum)
    <url>
      <loc>{{ url('/forum/' . $forum->slug) }}</loc>
      <lastmod> {{ $forum->created_at->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
      <image:image>
        <image:loc>
          {{ to_img($forum->body) }}
        </image:loc>
      </image:image>
    </url>
  @endforeach

  @foreach ($images as $img)
    <url>
      <loc>{{ url('/gallery/' . $img->id) }}</loc>
      <lastmod>{{ $img->created_at->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
      <image:image>
        <image:loc>
          {{ $img->gambar }}
        </image:loc>
      </image:image>
    </url>
  @endforeach

</urlset>