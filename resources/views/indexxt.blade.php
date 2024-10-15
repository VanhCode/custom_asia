<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @php
        $lang = App::getLocale();
        if ($lang == 'vi') {
            $lang = '';
        } else {
            $lang = '.' . $lang;
        }
    @endphp

    <url>
        <loc>{{ url($lang . '/') }}</loc>
        <lastmod>{{ Carbon::now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ url($lang . '/contact') }}</loc>
        <lastmod>{{ Carbon::now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>


    @if (isset($product) && $product->count() > 0)
        @foreach ($product as $item)
            @php
                $link = route('checkKey', ['slug' => $item->slug]);
            @endphp
            <url>
                <loc>{{ $link }}</loc>
                <lastmod>{{ $item->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    @if (isset($cateProduct) && $cateProduct->count() > 0)
        @foreach ($cateProduct as $item)
            @php
                $link = route('checkKey', ['slug' => $item->slug]);
            @endphp
            <url>
                <loc>{{ $link }}</loc>
                <lastmod>{{ $item->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    @if (isset($post) && $post->count() > 0)
        @foreach ($post as $item)
            @php
                $link = route('checkKey', ['slug' => $item->slug]);
            @endphp
            <url>
                <loc>{{ $link }}</loc>
                <lastmod>{{ $item->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    @if (isset($catePost) && $catePost->count() > 0)
        @foreach ($catePost as $item)
            @php
                $link = route('checkKey', ['slug' => $item->slug]);
            @endphp
            <url>
                <loc>{{ $link }}</loc>
                <lastmod>{{ $item->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    <!-- Các vòng lặp cho product, cateProduct, post, catePost ở đây -->

</urlset>
