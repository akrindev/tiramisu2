<?php

namespace App\Http\Controllers;

use App\Drop;
use App\LogSearch;
use App\Map;
use App\Monster;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    private const MAX_URLS_PER_SITEMAP = 50000;

    private const MODEL_RECORDS_PER_SITEMAP = 25000;

    public function index()
    {
        $xml = Cache::remember('sitemap-index', now()->addHour(), function () {
            $entries = $this->sitemapIndexEntry('/sitemap-pages.xml')
                .$this->sitemapIndexEntries('/sitemap-items', Drop::count() * 2)
                .$this->sitemapIndexEntries('/sitemap-monsters', Monster::count() * 2)
                .$this->sitemapIndexEntries('/sitemap-maps', Map::count() * 2);

            return $this->sitemapIndexXml($entries);
        });

        return $this->xmlResponse($xml);
    }

    public function pages()
    {
        $xml = Cache::remember('sitemap-pages', now()->addHour(), function () {
            $urls = '';

            foreach (array_unique(array_map($this->normalizePath(...), $this->staticPaths())) as $path) {
                $urls .= $this->urlEntry($this->absoluteUrl($path), 'weekly', '0.7');
            }

            foreach ($this->monsterCategoryPaths() as $path) {
                $urls .= $this->urlEntry($this->absoluteUrl($path), 'weekly', '0.6');
            }

            return $this->urlSetXml($urls);
        });

        return $this->xmlResponse($xml);
    }

    public function items(int $page = 1)
    {
        return $this->entitySitemap('sitemap-items-'.$page, Drop::query(), $page, function ($item) {
            return $this->urlEntry($this->absoluteUrl('/item/'.$item->id), 'monthly', '0.8')
                .$this->urlEntry($this->absoluteUrl('/en/item/'.$item->id), 'monthly', '0.8');
        });
    }

    public function monsters(int $page = 1)
    {
        return $this->entitySitemap('sitemap-monsters-'.$page, Monster::query(), $page, function ($monster) {
            return $this->urlEntry($this->absoluteUrl('/monster/'.$monster->id), 'monthly', '0.8')
                .$this->urlEntry($this->absoluteUrl('/en/monster/'.$monster->id), 'monthly', '0.8');
        });
    }

    public function maps(int $page = 1)
    {
        return $this->entitySitemap('sitemap-maps-'.$page, Map::query(), $page, function ($map) {
            return $this->urlEntry($this->absoluteUrl('/peta/'.$map->id), 'monthly', '0.7')
                .$this->urlEntry($this->absoluteUrl('/en/peta/'.$map->id), 'monthly', '0.7');
        });
    }

    public function show()
    {
        $searchTotal = LogSearch::count();
        $searches = LogSearch::latest()->select('q')->paginate(250);

        return view('sitemap.latest_search', compact('searches', 'searchTotal'));
    }

    private function entitySitemap(string $cacheKey, $query, int $page, callable $urlBuilder)
    {
        $xml = Cache::remember($cacheKey, now()->addHour(), function () use ($query, $page, $urlBuilder) {
            $urls = '';

            foreach ($query->select('id')->orderBy('id')->forPage($page, self::MODEL_RECORDS_PER_SITEMAP)->cursor() as $record) {
                $urls .= $urlBuilder($record);
            }

            return $this->urlSetXml($urls);
        });

        return $this->xmlResponse($xml);
    }

    private function sitemapIndexEntries(string $basePath, int $urlCount): string
    {
        $entries = '';
        $pages = max(1, (int) ceil($urlCount / self::MAX_URLS_PER_SITEMAP));

        for ($page = 1; $page <= $pages; $page++) {
            $entries .= $this->sitemapIndexEntry($page === 1 ? $basePath.'.xml' : $basePath.'-'.$page.'.xml');
        }

        return $entries;
    }

    private function sitemapIndexEntry(string $path): string
    {
        return '    <sitemap>'.PHP_EOL
            .'        <loc>'.$this->escapeXml($this->absoluteUrl($path)).'</loc>'.PHP_EOL
            .'    </sitemap>'.PHP_EOL;
    }

    private function staticPaths(): array
    {
        return [
            '/',
            '/en/',
            '/registlet',
            '/mq_exp',
            '/refine',
            '/refine/simulasi',
            '/bgm',
            '/kebijakan-privasi',
            '/rules',
            '/tentang-kami',
            '/exp',
            '/potensi/kalkulator',
            '/leveling',
            '/peta',
            '/en/peta',
            '/monsters',
            '/items',
            '/en/items',
            '/skill',
            '/avatar',
            '/avatar/all',
            '/cooking/berteman',
            '/cooking/buff',
            '/fill_stats/formula',
            '/fill_stats/simulator',
            '/prestasi',
            '/appearance',
            '/en/appearance',
        ];
    }

    private function monsterCategoryPaths(): array
    {
        $paths = [];

        foreach (['boss', 'mini_boss', 'normal'] as $type) {
            $paths[] = '/monster/type/'.$type;
            $paths[] = '/en/monster/type/'.$type;
        }

        foreach (['air', 'angin', 'bumi', 'api', 'gelap', 'cahaya', 'netral'] as $element) {
            $paths[] = '/monster/unsur/'.$element;
            $paths[] = '/en/monster/unsur/'.$element;
        }

        return $paths;
    }

    private function urlEntry(string $url, string $changefreq, string $priority): string
    {
        return '    <url>'.PHP_EOL
            .'        <loc>'.$this->escapeXml($url).'</loc>'.PHP_EOL
            .'        <changefreq>'.$changefreq.'</changefreq>'.PHP_EOL
            .'        <priority>'.$priority.'</priority>'.PHP_EOL
            .'    </url>'.PHP_EOL;
    }

    private function urlSetXml(string $urls): string
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL
            .$urls
            .'</urlset>'.PHP_EOL;
    }

    private function sitemapIndexXml(string $entries): string
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
            .'<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL
            .$entries
            .'</sitemapindex>'.PHP_EOL;
    }

    private function xmlResponse(string $xml)
    {
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function absoluteUrl(string $path): string
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $path = $this->normalizePath($path);

        return $path === '/' ? $baseUrl : $baseUrl.$path;
    }

    private function normalizePath(string $path): string
    {
        $path = '/'.ltrim($path, '/');

        return $path === '/' ? $path : rtrim($path, '/');
    }

    private function escapeXml(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8');
    }
}
