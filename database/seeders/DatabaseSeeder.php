<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * All website content lives here: services, prices and recent work.
 * Edit the text or prices, then run:
 *   php artisan db:seed
 *
 * Prices are in Pakistani Rupees (PKR).
 * 'price' = lowest price, 'price_max' = highest price. Leave 'price_max' out for one fixed price.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $services = $this->services();
        Service::whereNotIn('slug', array_column($services, 'slug'))->delete();
        foreach ($services as $i => $service) {
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

    /**
     * Services. 'category' sets the colour: development (green), design (orange), marketing (red).
     * Icons: code, wordpress, school, phone, pen, video, search, megaphone, chart.
     */
    private function services(): array
    {
        return [
            [
                'slug' => 'website-development',
                'title' => 'Business website',
                'category' => 'development',
                'icon' => 'code',
                'summary' => 'A website for your shop, company, clinic or restaurant, so customers can find and contact you.',
                'description' => 'We make a fast website that works on every mobile phone. Customers can see your work, prices and location, and contact you on WhatsApp in one click. You get an easy admin panel to change text and photos yourself.',
                'deliverables' => ['Works on mobile and computer', 'WhatsApp and call buttons', 'Contact form', 'Google Map of your location', 'Basic Google SEO', 'Free support after launch'],
                'timeline' => '7–14 days',
            ],
            [
                'slug' => 'school-websites',
                'title' => 'School website',
                'category' => 'development',
                'icon' => 'school',
                'summary' => 'A website for your school, college or academy with admissions, gallery and contact details.',
                'description' => 'Parents want to see your school before they visit. We make a simple website with your classes, teachers, photos, admission details and fee information. Parents can call or WhatsApp you straight from the website.',
                'deliverables' => ['Admission information and form', 'Photo gallery', 'Classes and teachers pages', 'News and events', 'WhatsApp and call buttons', 'Google Map of your campus'],
                'timeline' => '3 days – 4 weeks',
            ],
            [
                'slug' => 'wordpress-websites',
                'title' => 'WordPress and online store',
                'category' => 'development',
                'icon' => 'wordpress',
                'summary' => 'Sell your products online with a WordPress or WooCommerce store you can manage yourself.',
                'description' => 'We set up your online store with products, cart and order system. Customers can pay online or choose cash on delivery. We show you how to add products and check orders yourself.',
                'deliverables' => ['Product pages and cart', 'Cash on delivery and online payment', 'Order emails', 'Speed and security setup', 'Training on how to add products'],
                'timeline' => '2–4 weeks',
            ],
            [
                'slug' => 'mobile-apps',
                'title' => 'Mobile app',
                'category' => 'development',
                'icon' => 'phone',
                'summary' => 'An Android and iPhone app for your business, with an admin panel to manage it.',
                'description' => 'We make mobile apps for orders, bookings, schools and businesses. We plan the app with you first, show you the design, then build it and help you put it on Google Play and the App Store.',
                'deliverables' => ['Android and iPhone app', 'Admin panel', 'Login and notifications', 'Play Store and App Store upload', 'Support after launch'],
                'timeline' => '4–8 weeks',
            ],
            [
                'slug' => 'graphic-design',
                'title' => 'Logo and graphic design',
                'category' => 'design',
                'icon' => 'pen',
                'summary' => 'Logo, social media posts, banners, flyers and visiting cards that make your business look professional.',
                'description' => 'A good logo and clean designs make people trust your business. We design your logo, Facebook and Instagram posts, banners, flyers and visiting cards in your brand colours, ready to print or post.',
                'deliverables' => ['Logo design', 'Social media posts', 'Banners and flyers', 'Visiting cards', 'Print-ready files'],
                'timeline' => '2–7 days',
            ],
            [
                'slug' => 'video-editing',
                'title' => 'Video editing',
                'category' => 'design',
                'icon' => 'video',
                'summary' => 'Reels, TikTok and YouTube videos and video ads, edited to look clean and catch attention.',
                'description' => 'Send us your raw videos and we turn them into short reels, YouTube videos or video ads. We add text, music, your logo and subtitles, in the right size for each platform.',
                'deliverables' => ['Reels and TikTok videos', 'YouTube videos', 'Video ads', 'Text, music and subtitles', 'Your logo on every video'],
                'timeline' => '1–3 days per video',
            ],
            [
                'slug' => 'seo',
                'title' => 'SEO (Google ranking)',
                'category' => 'marketing',
                'icon' => 'search',
                'summary' => 'Help people find your business when they search on Google.',
                'description' => 'We set up your Google Business Profile, fix your website for Google and write content for the words your customers search. You get a simple monthly report showing what changed.',
                'deliverables' => ['Google Business Profile setup', 'Website SEO fixes', 'Keyword research', 'Content for your pages', 'Monthly report'],
                'timeline' => 'Monthly',
            ],
            [
                'slug' => 'facebook-google-ads',
                'title' => 'Facebook and Google ads',
                'category' => 'marketing',
                'icon' => 'megaphone',
                'summary' => 'Ads on Facebook, Instagram, TikTok and Google that bring messages and calls to your business.',
                'description' => 'We make the ad designs, choose the right people in the right cities and manage your ads every day. You only pay the ad budget to Facebook or Google and our fee to us.',
                'deliverables' => ['Ad designs and text', 'Right audience and cities', 'Daily ad checking', 'WhatsApp and call leads', 'Simple weekly report'],
                'timeline' => 'Monthly',
            ],
            [
                'slug' => 'social-media-marketing',
                'title' => 'Social media management',
                'category' => 'marketing',
                'icon' => 'chart',
                'summary' => 'We run your Facebook, Instagram and TikTok pages with regular posts and replies.',
                'description' => 'We plan your posts for the month, design them, post them on time and help you reply to customers. Your pages stay active and look professional.',
                'deliverables' => ['Monthly post plan', 'Post designs', 'Posting on time', 'Page setup and cover photos', 'Monthly report'],
                'timeline' => 'Monthly',
            ],
        ];
    }

    /**
     * Prices on the pricing page.
     * 'category' = which table the package shows in: business or school.
     * 'is_popular' => true puts a "Most chosen" badge on that package.
     */
    private function plans(): array
    {
        return [
            // Business websites
            ['category' => 'business', 'name' => 'Basic', 'best_for' => 'Small shop or new business', 'price' => 12000, 'price_max' => 15000, 'billing' => 'one-time',
                'features' => ['Up to 5 pages', 'Works on mobile and computer', 'WhatsApp and call buttons', 'Contact form', 'Google Map of your location', 'Ready in about 7 days', '1 month free support']],
            ['category' => 'business', 'name' => 'Standard', 'best_for' => 'Business that wants more customers', 'price' => 25000, 'price_max' => 30000, 'billing' => 'one-time', 'is_popular' => true,
                'features' => ['Up to 10 pages', 'Everything in Basic', 'Admin panel: change text and photos yourself', 'Basic Google SEO setup', 'Facebook and Instagram links', 'Ready in about 10–14 days', '3 months free support']],
            ['category' => 'business', 'name' => 'Premium', 'best_for' => 'Online store or special features', 'price' => 40000, 'price_max' => 45000, 'billing' => 'one-time',
                'features' => ['15+ pages or an online store', 'Everything in Standard', 'Products, cart and orders', 'Cash on delivery or online payment', 'Speed and security setup', 'Ready in about 3–4 weeks', '6 months free support']],

            // School websites
            ['category' => 'school', 'name' => 'Landing page', 'best_for' => 'One page about your school', 'price' => 7000, 'billing' => 'one-time',
                'features' => ['1 page', 'School introduction and photos', '"Admissions open" section', 'WhatsApp and call buttons', 'Google Map of your campus', 'Ready in about 3–5 days']],
            ['category' => 'school', 'name' => '3-page website', 'best_for' => 'Small school or academy', 'price' => 12000, 'billing' => 'one-time',
                'features' => ['3 pages: Home, About, Contact', 'Admission information', 'Photo gallery', 'WhatsApp and call buttons', 'Ready in about 7 days']],
            ['category' => 'school', 'name' => '5–7 page website', 'best_for' => 'Growing school', 'price' => 25000, 'price_max' => 30000, 'billing' => 'one-time', 'is_popular' => true,
                'features' => ['5 to 7 pages', 'Admissions, classes, teachers, gallery', 'Online admission form', 'News and events', 'Change text and photos yourself', 'Ready in about 2 weeks']],
            ['category' => 'school', 'name' => '10+ page website', 'best_for' => 'Big school or school system', 'price' => 40000, 'price_max' => 45000, 'billing' => 'one-time',
                'features' => ['10 or more pages', 'Everything in 5–7 pages', 'Results and fee structure pages', 'Downloads: date sheet, syllabus', 'Campus and teacher pages', 'Ready in about 3–4 weeks']],
        ];
    }

    /**
     * Recent work. Screenshots are in public/images/portfolio/ (2:1 size looks best, e.g. 1300x650).
     * Add 'url' => 'https://...' to make a card open the live website.
     * 'is_featured' => true shows the project on the homepage (first three are used).
     */
    private function projects(): array
    {
        return [
            ['title' => 'Digital skills training platform', 'category' => 'development', 'client' => 'Learning With Earning',
                'summary' => 'Website for a digital skills training institute, with courses, student results, login and registration.',
                'image' => '/images/portfolio/learning-with-earning.webp', 'tags' => ['Education', 'Student login', 'Courses'], 'is_featured' => true],
            ['title' => 'Online store for mobile accessories', 'category' => 'development', 'client' => 'OneTechSmart',
                'summary' => 'Online store with product pages, discounts, prices in rupees and quick "Buy Now" buttons.',
                'image' => '/images/portfolio/onetechsmart.webp', 'tags' => ['Online store', 'Products', 'Rupee prices'], 'is_featured' => true],
            ['title' => 'Restaurant software website', 'category' => 'development', 'client' => 'RestroManage',
                'summary' => 'Website for restaurant management software, with features, pricing and a free trial sign-up.',
                'image' => '/images/portfolio/restromanage.webp', 'tags' => ['Software', 'Free trial', 'Restaurants'], 'is_featured' => true],
            ['title' => 'Mentor finding platform', 'category' => 'development', 'client' => 'LWE MentorNet',
                'summary' => 'Students find verified mentors across Pakistan, see their profiles and send a request in one click.',
                'image' => '/images/portfolio/lwe-mentornet.webp', 'tags' => ['Education', 'Profiles', 'Requests']],
            ['title' => 'IT company website', 'category' => 'development', 'client' => 'NetOPZ',
                'summary' => 'Website for an IT company offering domain and hosting, design, development and marketing.',
                'image' => '/images/portfolio/netopz.webp', 'tags' => ['Company website', 'Services', 'Quote form']],
            ['title' => 'International company website', 'category' => 'development', 'client' => 'ZAHA Global',
                'summary' => 'Company website for a group working in Germany, Australia and Pakistan, in English and German.',
                'image' => '/images/portfolio/zaha-global.webp', 'tags' => ['Corporate', 'Two languages']],
        ];
    }
}
