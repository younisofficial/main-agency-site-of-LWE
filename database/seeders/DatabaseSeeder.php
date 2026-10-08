<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * All website content lives here. Edit the text or prices, then run:
 *   php artisan migrate:fresh --seed
 *
 * Plan prices are in US dollars and are DUMMY figures — replace them with your own.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->services() as $i => $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service + ['sort_order' => $i]);
        }

        PricingPlan::query()->delete();
        foreach ($this->plans() as $i => $plan) {
            PricingPlan::create($plan + ['sort_order' => $i]);
        }

        Project::query()->delete();
        foreach ($this->projects() as $i => $project) {
            Project::create($project + ['sort_order' => $i]);
        }
    }

    private function services(): array
    {
        return [
            [
                'slug' => 'custom-web-development',
                'title' => 'Custom web development',
                'category' => 'development',
                'icon' => 'code',
                'summary' => 'Web apps, portals and dashboards built around how your business actually works.',
                'description' => 'When a template cannot do the job, we build it from scratch in Laravel and Vue. You get a fast, secure system that fits your process — booking engines, customer portals, inventory tools, admin dashboards — and code your next developer can read.',
                'deliverables' => ['Requirements and technical plan', 'Laravel back end with Vue front end', 'Admin panel for your team', 'Payment and third-party integrations', 'Deployment and 30 days of support'],
                'timeline' => '4–8 weeks',
            ],
            [
                'slug' => 'wordpress-development',
                'title' => 'WordPress development',
                'category' => 'development',
                'icon' => 'wordpress',
                'summary' => 'Business sites and WooCommerce stores you can update yourself, without calling a developer.',
                'description' => 'We build WordPress sites that stay fast and stay yours. Custom themes instead of bloated page-builder stacks, WooCommerce set up with local payment gateways, and a short training session so your team can add pages, posts and products on day one.',
                'deliverables' => ['Custom or customised theme', 'WooCommerce store setup', 'Speed and security hardening', 'Plugin setup and migration', 'Training session for your team'],
                'timeline' => '1–3 weeks',
            ],
            [
                'slug' => 'app-development',
                'title' => 'App development',
                'category' => 'development',
                'icon' => 'phone',
                'summary' => 'Android and iOS apps from one codebase, published to both stores.',
                'description' => 'We design and build mobile apps with Flutter, so one codebase runs on Android and iOS. We handle the API, push notifications, in-app payments and the store submissions — you get a published app and the source code.',
                'deliverables' => ['Android and iOS app', 'API and admin panel', 'Push notifications', 'Play Store and App Store submission', 'Source code handover'],
                'timeline' => '8–12 weeks',
            ],
            [
                'slug' => 'web-design',
                'title' => 'Web design',
                'category' => 'design',
                'icon' => 'layout',
                'summary' => 'Page designs that make it obvious what you do and what to click next.',
                'description' => 'We design the pages before anyone writes code: the layout, the type, the photography and the words on the buttons. You review real mockups on desktop and mobile, ask for changes, and sign off a design your developers can build exactly.',
                'deliverables' => ['Homepage and inner page designs', 'Desktop and mobile layouts', 'Two rounds of revisions', 'Figma source files', 'Developer handover notes'],
                'timeline' => '1–2 weeks',
            ],
            [
                'slug' => 'ux-ui-design',
                'title' => 'UX/UI design',
                'category' => 'design',
                'icon' => 'cursor',
                'summary' => 'Flows and screens for apps and software, tested with real users before you build.',
                'description' => 'For products with more than a few screens. We map what your users are trying to do, sketch the flows, build a clickable prototype and test it with five real people. Problems get fixed in Figma, where changes cost minutes, not in code.',
                'deliverables' => ['User flows and wireframes', 'Clickable prototype', 'Usability test with five users', 'Component library in Figma', 'Design system documentation'],
                'timeline' => '2–4 weeks',
            ],
            [
                'slug' => 'graphic-design',
                'title' => 'Graphic design',
                'category' => 'design',
                'icon' => 'pen',
                'summary' => 'Logos, brand kits, social posts and print — one consistent look everywhere.',
                'description' => 'From a first logo to a full brand kit. We design the pieces your business uses every week — social media posts, brochures, company profiles, packaging and banners — so they all look like they come from the same company.',
                'deliverables' => ['Logo and brand guidelines', 'Social media post templates', 'Brochure and company profile', 'Print-ready files', 'Editable source files'],
                'timeline' => '3–7 days',
            ],
            [
                'slug' => 'seo',
                'title' => 'SEO',
                'category' => 'marketing',
                'icon' => 'search',
                'summary' => 'Rank for the searches your customers make, and see the numbers every month.',
                'description' => 'We start with an audit that shows what is holding your site back, then fix it: technical issues, page content, local listings and links. Every month you get a plain report — which keywords moved, how much traffic came in, and what we do next.',
                'deliverables' => ['Technical and content audit', 'Keyword research', 'On-page optimisation', 'Google Business Profile setup', 'Monthly ranking report'],
                'timeline' => 'Monthly',
            ],
            [
                'slug' => 'advertising',
                'title' => 'Advertising',
                'category' => 'marketing',
                'icon' => 'megaphone',
                'summary' => 'Google, Facebook and Instagram ads managed against one number: cost per lead.',
                'description' => 'We plan, write, design and manage paid campaigns on Google, Meta and TikTok. Conversion tracking goes in first, so every dollar is tied to a call, a form or a sale. You see spend and results in a live dashboard.',
                'deliverables' => ['Campaign strategy and setup', 'Ad copy and creatives', 'Conversion tracking', 'Weekly optimisation', 'Live results dashboard'],
                'timeline' => 'Monthly',
            ],
            [
                'slug' => 'content-writing',
                'title' => 'Content writing',
                'category' => 'marketing',
                'icon' => 'document',
                'summary' => 'Website copy, blogs and product descriptions in clear English or Urdu.',
                'description' => 'Writers who learn your business before they write about it. Website pages that explain what you do in plain words, blog articles written to rank, and product descriptions that answer the questions buyers actually ask.',
                'deliverables' => ['Website page copy', 'SEO blog articles', 'Product descriptions', 'English and Urdu', 'One round of edits included'],
                'timeline' => '2–5 days',
            ],
            [
                'slug' => 'digital-marketing',
                'title' => 'Marketing',
                'category' => 'marketing',
                'icon' => 'chart',
                'summary' => 'Social media, email and WhatsApp campaigns run as one monthly plan.',
                'description' => 'A full marketing plan run by one team. We manage your social pages, send email and WhatsApp campaigns, and plan each month around what you are selling. One calendar, one report, one person to call.',
                'deliverables' => ['Monthly content calendar', 'Social media management', 'Email and WhatsApp campaigns', 'Community replies', 'Monthly performance report'],
                'timeline' => 'Monthly',
            ],
        ];
    }

    private function plans(): array
    {
        return [
            // Development
            ['category' => 'development', 'name' => 'Starter site', 'best_for' => 'New businesses that need to be online this month', 'price' => 499, 'billing' => 'one-time',
                'features' => ['Up to 5 pages on WordPress', 'Mobile-friendly design', 'Contact form and WhatsApp button', 'Basic on-page SEO', '2 weeks of support']],
            ['category' => 'development', 'name' => 'Business site', 'best_for' => 'Growing companies and online stores', 'price' => 1499, 'billing' => 'one-time', 'is_popular' => true,
                'features' => ['Up to 15 pages, custom design', 'WooCommerce store or blog', 'Payment gateway integration', 'Speed and security setup', 'Team training session', '30 days of support']],
            ['category' => 'development', 'name' => 'Custom build', 'best_for' => 'Web apps, portals and mobile apps', 'price' => 3999, 'billing' => 'one-time',
                'features' => ['Laravel and Vue web app or Flutter app', 'Custom admin dashboard', 'API and third-party integrations', 'Dedicated project manager', 'Source code handover', '60 days of support']],

            // Design
            ['category' => 'design', 'name' => 'Brand basics', 'best_for' => 'A logo and the essentials', 'price' => 199, 'billing' => 'one-time',
                'features' => ['3 logo concepts', 'Colour palette and fonts', 'Business card design', '2 rounds of revisions', 'Print-ready and source files']],
            ['category' => 'design', 'name' => 'Website design', 'best_for' => 'A full site designed before it is built', 'price' => 799, 'billing' => 'one-time', 'is_popular' => true,
                'features' => ['Homepage and up to 8 inner pages', 'Desktop and mobile layouts', 'Clickable Figma prototype', '3 rounds of revisions', 'Developer handover notes']],
            ['category' => 'design', 'name' => 'Product UX/UI', 'best_for' => 'Apps and software with many screens', 'price' => 1999, 'billing' => 'one-time',
                'features' => ['User flows and wireframes', 'Up to 40 designed screens', 'Usability test with 5 users', 'Component library', 'Design system documentation']],

            // Marketing
            ['category' => 'marketing', 'name' => 'Local', 'best_for' => 'Shops and services in one city', 'price' => 349, 'billing' => 'per month',
                'features' => ['SEO for 10 keywords', 'Google Business Profile management', '8 social media posts', '2 blog articles', 'Monthly report']],
            ['category' => 'marketing', 'name' => 'Growth', 'best_for' => 'Businesses ready to run ads', 'price' => 749, 'billing' => 'per month', 'is_popular' => true,
                'features' => ['SEO for 25 keywords', 'Google and Meta ad management', '16 social media posts', '4 blog articles', 'Conversion tracking', 'Fortnightly review call']],
            ['category' => 'marketing', 'name' => 'Full team', 'best_for' => 'Brands that want marketing fully handled', 'price' => 1499, 'billing' => 'per month',
                'features' => ['SEO for 50 keywords', 'Ads on Google, Meta and TikTok', 'Daily social media posts', 'Email and WhatsApp campaigns', '8 blog articles', 'Dedicated account manager']],
        ];
    }

    /**
     * Portfolio. These nine are DUMMY projects with placeholder images.
     * Replace each one with a real site you worked on:
     *   1. Put a screenshot in public/images/portfolio/ (1200x900 looks best).
     *   2. Set 'image' to its path, 'url' to the live site, and edit the text.
     *   3. Run: php artisan db:seed
     * 'is_featured' => true shows the project on the homepage (first three are used).
     */
    private function projects(): array
    {
        return [
            ['title' => 'Online fashion store', 'category' => 'development', 'client' => 'Sample client', 'summary' => 'WooCommerce store with local payment gateways and a faster checkout.', 'image' => '/images/portfolio/sample-1.svg', 'url' => null, 'tags' => ['WordPress', 'WooCommerce'], 'is_featured' => true],
            ['title' => 'Food delivery app', 'category' => 'design', 'client' => 'Sample client', 'summary' => 'Ordering flow and 32 app screens, tested with real customers.', 'image' => '/images/portfolio/sample-2.svg', 'url' => null, 'tags' => ['UX/UI', 'Mobile app'], 'is_featured' => true],
            ['title' => 'Clinic growth campaign', 'category' => 'marketing', 'client' => 'Sample client', 'summary' => 'Local SEO and Google Ads to fill the appointment calendar.', 'image' => '/images/portfolio/sample-3.svg', 'url' => null, 'tags' => ['SEO', 'Google Ads'], 'is_featured' => true],
            ['title' => 'School management portal', 'category' => 'development', 'client' => 'Sample client', 'summary' => 'Fees, attendance and results in one Laravel and Vue web app.', 'image' => '/images/portfolio/sample-4.svg', 'url' => null, 'tags' => ['Laravel', 'Vue', 'Dashboard']],
            ['title' => 'Beauty brand identity', 'category' => 'design', 'client' => 'Sample client', 'summary' => 'Logo, packaging and a social media kit for a new skincare line.', 'image' => '/images/portfolio/sample-5.svg', 'url' => null, 'tags' => ['Branding', 'Graphic design']],
            ['title' => 'Real estate lead engine', 'category' => 'marketing', 'client' => 'Sample client', 'summary' => 'Meta ads, landing pages and WhatsApp follow-ups for a property developer.', 'image' => '/images/portfolio/sample-6.svg', 'url' => null, 'tags' => ['Meta Ads', 'WhatsApp']],
            ['title' => 'Restaurant website', 'category' => 'development', 'client' => 'Sample client', 'summary' => 'Menu, table booking and online ordering on a custom WordPress theme.', 'image' => '/images/portfolio/sample-7.svg', 'url' => null, 'tags' => ['WordPress', 'Booking']],
            ['title' => 'Organic grocery redesign', 'category' => 'design', 'client' => 'Sample client', 'summary' => 'A cleaner storefront design that makes reordering take two taps.', 'image' => '/images/portfolio/sample-8.svg', 'url' => null, 'tags' => ['Web design', 'E-commerce']],
            ['title' => 'SaaS content programme', 'category' => 'marketing', 'client' => 'Sample client', 'summary' => 'Blog articles and email sequences written to rank and convert.', 'image' => '/images/portfolio/sample-9.svg', 'url' => null, 'tags' => ['Content writing', 'Email']],
        ];
    }
}
