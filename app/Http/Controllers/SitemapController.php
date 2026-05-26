<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $services = Service::whereNotNull('slug')->get();
        $cities = config('seo_cities.cities', []);
        
        $urls = [];
        
        // Base static URLs
        $urls[] = url('/');
        $urls[] = route('service');
        $urls[] = route('aboutus');
        $urls[] = route('contact');
        
        // SEO Combinations
        foreach ($cities as $cityKey => $cityName) {
            foreach ($services as $service) {
                // Ensure valid slug
                if (!empty($service->slug)) {
                    $urls[] = url("/{$cityKey}/{$service->slug}");
                }
            }
        }
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= "\n  <url>\n    <loc>" . htmlspecialchars($url) . "</loc>\n    <changefreq>weekly</changefreq>\n    <priority>0.8</priority>\n  </url>";
        }
        
        $xml .= "\n</urlset>";
        
        return response($xml)->header('Content-Type', 'text/xml');
    }
}
