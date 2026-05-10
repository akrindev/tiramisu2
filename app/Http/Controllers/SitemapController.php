<?php

namespace App\Http\Controllers;

use App\Drop;
use App\LogSearch;
use App\Map;
use App\Monster;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $xml = Cache::remember('sitemap.xml.v2.'.sha1(url('/')), now()->addHour(), function () {
            $urls = [];

            foreach ($this->staticPaths() as $path) {
                $urls[] = $this->urlEntry(url($path), 'weekly', '0.7');
            }

            foreach ($this->monsterCategoryPaths() as $path) {
                $urls[] = $this->urlEntry(url($path), 'weekly', '0.6');
            }

            Drop::select('id')->orderBy('id')->chunk(500, function ($items) use (&$urls) {
                foreach ($items as $item) {
                    $urls[] = $this->urlEntry(url('/item/'.$item->id), 'monthly', '0.8');
                    $urls[] = $this->urlEntry(url('/en/item/'.$item->id), 'monthly', '0.8');
                }
            });

            Monster::select('id')->orderBy('id')->chunk(500, function ($monsters) use (&$urls) {
                foreach ($monsters as $monster) {
                    $urls[] = $this->urlEntry(url('/monster/'.$monster->id), 'monthly', '0.8');
                    $urls[] = $this->urlEntry(url('/en/monster/'.$monster->id), 'monthly', '0.8');
                }
            });

            Map::select('id')->orderBy('id')->chunk(500, function ($maps) use (&$urls) {
                foreach ($maps as $map) {
                    $urls[] = $this->urlEntry(url('/peta/'.$map->id), 'monthly', '0.7');
                    $urls[] = $this->urlEntry(url('/en/peta/'.$map->id), 'monthly', '0.7');
                }
            });

            return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
                .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL
                .implode('', $urls)
                .'</urlset>'.PHP_EOL;
        });

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function show()
    {
        $searchTotal = LogSearch::count();
        $searches = LogSearch::latest()->select('q')->paginate(250);

        return view('sitemap.latest_search', compact('searches', 'searchTotal'));
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
            .'        <loc>'.e($url).'</loc>'.PHP_EOL
            .'        <changefreq>'.$changefreq.'</changefreq>'.PHP_EOL
            .'        <priority>'.$priority.'</priority>'.PHP_EOL
            .'    </url>'.PHP_EOL;
    }
}
