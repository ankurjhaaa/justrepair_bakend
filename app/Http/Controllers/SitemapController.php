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
        $now = date('Y-m-d');
        
        // Priority 1.0: Home
        $urls[] = ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'];
        
        // Priority 0.9: Main Service Listing & Dedicated Service Pages
        $urls[] = ['loc' => route('service'), 'priority' => '0.9', 'changefreq' => 'daily'];
        foreach ($services as $service) {
            if (!empty($service->slug)) {
                $urls[] = ['loc' => url("/services/{$service->slug}"), 'priority' => '0.9', 'changefreq' => 'weekly'];
            }
        }
        
        // Priority 0.8: SEO Programmatic Pages (City + Service)
        foreach ($cities as $cityKey => $cityName) {
            foreach ($services as $service) {
                if (!empty($service->slug)) {
                    $urls[] = ['loc' => url("/{$cityKey}/{$service->slug}"), 'priority' => '0.8', 'changefreq' => 'weekly'];
                }
            }
        }
        
        // Priority 0.6: Static Info Pages
        $staticRoutes = ['aboutus', 'contact', 'helpcenter', 'termsandcondition', 'privacypolicy'];
        foreach ($staticRoutes as $route) {
            $urls[] = ['loc' => route($route), 'priority' => '0.6', 'changefreq' => 'monthly'];
        }
        
        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= "\n  <url>\n    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n    <lastmod>{$now}</lastmod>\n    <changefreq>{$url['changefreq']}</changefreq>\n    <priority>{$url['priority']}</priority>\n  </url>";
        }
        
        $xml .= "\n</urlset>";
        
        return response($xml)->header('Content-Type', 'text/xml');
    }
}
