<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
      <loc>{{ $home }}</loc>
      <lastmod>{{ Illuminate\Support\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ $about }}</loc>
      <lastmod>{{ Illuminate\Support\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ $shopping }}</loc>
      <lastmod>{{ Illuminate\Support\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ $warranty }}</loc>
      <lastmod>{{ Illuminate\Support\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ $delivery }}</loc>
      <lastmod>{{ Illuminate\Support\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
  </url>
  <url>
      <loc>{{ $about }}</loc>
      <lastmod>{{ Illuminate\Support\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
  </url>
  @foreach ($posts as $post)
      <url>
          <loc>{{ $post->getLink() }}</loc>
          <lastmod>{{ $post->updated_at }}</lastmod>
          <changefreq>weekly</changefreq>
          <priority>0.8</priority>
      </url>
  @endforeach
  @foreach ($products as $product)
      <url>
          <loc>{{ $product->getLink() }}</loc>
          <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
          <changefreq>weekly</changefreq>
          <priority>0.8</priority>
      </url>
  @endforeach
</urlset>
