<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

/**
 * Serves the Vue app for every page URL, with the right SEO tags already in the HTML
 * so search engines and social networks do not need to run JavaScript to read them.
 */
class PageController extends Controller
{
    public function show(Request $request)
    {
        $path = '/'.trim($request->path(), '/');
        $path = $path === '//' ? '/' : $path;

        $agency = config('agency');
        $base = rtrim(config('app.url'), '/');
        $services = $this->services();
        $service = null;
        $status = 200;

        if (isset($agency['seo'][$path])) {
            $meta = $agency['seo'][$path];
        } elseif (preg_match('#^/services/([a-z0-9-]+)$#', $path, $m) && ($service = $services->firstWhere('slug', $m[1]))) {
            $meta = [
                'title' => "{$service->title} Services | {$agency['name']}",
                'description' => str($service->summary.' '.$service->description)->limit(155)->toString(),
                'heading' => $service->title,
            ];
        } else {
            $status = 404;
            $meta = [
                'title' => "Page not found | {$agency['name']}",
                'description' => 'This page does not exist.',
                'heading' => 'This page does not exist',
            ];
        }

        $canonical = $base.($path === '/' ? '' : $path);

        return response()->view('app', [
            'agency' => $agency,
            'meta' => $meta,
            'canonical' => $canonical,
            'noindex' => $status === 404,
            'ogImage' => $base.'/images/og-cover.png',
            'schemas' => $this->schemas($agency, $base, $path, $canonical, $meta, $service),
            'services' => $services,
            'bootstrap' => [
                'site' => collect($agency)->except(['seo', 'team', 'pricing_faqs'])->all(),
                'team' => $agency['team'],
                'faqs' => $agency['pricing_faqs'],
                'seo' => $agency['seo'],
                'baseUrl' => $base,
            ],
        ], $status);
    }

    public function sitemap()
    {
        $base = rtrim(config('app.url'), '/');
        $urls = collect(array_keys(config('agency.seo')))->map(fn ($path) => [
            'loc' => $base.($path === '/' ? '/' : $path),
            'priority' => $path === '/' ? '1.0' : '0.8',
            'lastmod' => null,
        ]);

        foreach ($this->services() as $service) {
            $urls->push([
                'loc' => "{$base}/services/{$service->slug}",
                'priority' => '0.7',
                'lastmod' => $service->updated_at?->toDateString(),
            ]);
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots()
    {
        $base = rtrim(config('app.url'), '/');

        return response("User-agent: *\nAllow: /\nDisallow: /api/\n\nSitemap: {$base}/sitemap.xml\n")
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    private function services()
    {
        // Lets the site load (without service pages) before migrations have been run.
        return Schema::hasTable('services') ? Service::orderBy('sort_order')->get() : collect();
    }

    /** JSON-LD structured data for Google. */
    private function schemas(array $agency, string $base, string $path, string $canonical, array $meta, ?Service $service): array
    {
        $organization = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            '@id' => $base.'/#organization',
            'name' => $agency['name'],
            'url' => $base.'/',
            'logo' => $base.'/images/logo.png',
            'image' => $base.'/images/og-cover.png',
            'description' => $agency['seo']['/']['description'],
            'email' => $agency['email'],
            'telephone' => $agency['phone'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $agency['address'],
                'addressCountry' => $agency['country'],
            ],
            'sameAs' => array_values($agency['social']),
        ]);

        $schemas = [$organization, [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $base.'/#website',
            'name' => $agency['name'],
            'url' => $base.'/',
            'publisher' => ['@id' => $base.'/#organization'],
        ]];

        if ($path !== '/' && ! str_starts_with($meta['title'], 'Page not found')) {
            $crumbs = [['Home', $base.'/']];
            if ($service) {
                $crumbs[] = ['Services', $base.'/services'];
            }
            $crumbs[] = [$meta['heading'], $canonical];

            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => collect($crumbs)->map(fn ($crumb, $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $crumb[0],
                    'item' => $crumb[1],
                ])->all(),
            ];
        }

        if ($service) {
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $service->title,
                'serviceType' => $service->title,
                'description' => $service->description,
                'url' => $canonical,
                'provider' => ['@id' => $base.'/#organization'],
            ];
        }

        if ($path === '/pricing') {
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => collect($agency['pricing_faqs'])->map(fn ($faq) => [
                    '@type' => 'Question',
                    'name' => $faq['q'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
                ])->all(),
            ];
        }

        return $schemas;
    }
}
