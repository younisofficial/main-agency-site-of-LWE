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
     * Icons: code, wordpress, school, pharmacy, restaurant, home, car, phone, pen, video, search, megaphone, chart.
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
                'slug' => 'pharmacy-websites',
                'title' => 'Pharmacy website',
                'category' => 'development',
                'icon' => 'pharmacy',
                'summary' => 'A website for your pharmacy or medical store, so customers can find you and order on WhatsApp.',
                'description' => 'Customers search for medicines and the nearest pharmacy on their phone. We make a simple website with your medicines and products, timings, location and delivery area. Customers can send their order or prescription photo to you on WhatsApp in one click.',
                'deliverables' => ['Medicines and products list', 'Order on WhatsApp button', 'Send prescription photo on WhatsApp', 'Timings and delivery area', 'Google Map of your pharmacy', 'Works on every mobile phone'],
                'timeline' => '5–14 days',
            ],
            [
                'slug' => 'restaurant-websites',
                'title' => 'Hotel and restaurant website',
                'category' => 'development',
                'icon' => 'restaurant',
                'summary' => 'A website for your hotel, restaurant or cafe with menu, photos, booking and WhatsApp orders.',
                'description' => 'Hungry customers check the menu and photos on their phone before they come. We make a website with your menu and prices, food and room photos, location and timings. Customers can book a table or room, or order on WhatsApp in one click.',
                'deliverables' => ['Menu with prices', 'Food and room photos', 'Table or room booking', 'Order on WhatsApp', 'Google Map and timings', 'Works on every mobile phone'],
                'timeline' => '5–14 days',
            ],
            [
                'slug' => 'real-estate-websites',
                'title' => 'Real estate website',
                'category' => 'development',
                'icon' => 'home',
                'summary' => 'A property website for your real estate agency with listings, photos, prices and enquiry buttons.',
                'description' => 'Show your plots, houses, flats and shops with photos, prices and location. Buyers can search by city, area and price, and call or WhatsApp your agent from each listing. You add and remove properties yourself.',
                'deliverables' => ['Property listings with photos', 'Search by city, area and price', 'Call and WhatsApp on every listing', 'Add properties yourself', 'Agent profiles', 'Google Map of each property'],
                'timeline' => '2–4 weeks',
            ],
            [
                'slug' => 'showroom-car-rental-websites',
                'title' => 'Showroom and car rental website',
                'category' => 'development',
                'icon' => 'car',
                'summary' => 'A website for your car showroom or rent-a-car with cars, prices per day and booking on WhatsApp.',
                'description' => 'Show every car with photos, seats, price per day or sale price. Customers choose a car and book it on WhatsApp in one click. You add cars and change prices yourself from an easy admin panel.',
                'deliverables' => ['Cars with photos and prices', 'Filter by type: economy, sedan, SUV', 'Book on WhatsApp', 'Add cars yourself', 'Locations and timings', 'Works on every mobile phone'],
                'timeline' => '7–14 days',
            ],
            [
                'slug' => 'wordpress-websites',
                'title' => 'Online store',
                'category' => 'development',
                'icon' => 'bag',
                'summary' => 'Sell clothes, shoes, jewellery or mobiles online with a store you can manage yourself.',
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
     * Prices on the pricing page: 3 packages for every type of business.
     * 'category' = which group the package shows in (see planGroups in resources/js/lib/site.js).
     * 'price' = lowest price, 'price_max' = highest (leave out for one fixed price).
     * 'is_popular' => true puts a "Most chosen" badge on that package.
     */
    private function plans(): array
    {
        $p = fn ($category, $name, $bestFor, $price, $features, $max = null, $popular = false) => array_filter([
            'category' => $category, 'name' => $name, 'best_for' => $bestFor,
            'price' => $price, 'price_max' => $max, 'billing' => 'one-time',
            'features' => $features, 'is_popular' => $popular,
        ], fn ($v) => $v !== null);

        return [
            // Business websites (shops, companies, clinics, offices)
            $p('business', 'Basic', 'Small shop or new business', 12000, ['Up to 5 pages', 'Works on mobile and computer', 'WhatsApp and call buttons', 'Contact form', 'Google Map of your location', 'Ready in about 7 days', '1 month free support'], 15000),
            $p('business', 'Standard', 'Business that wants more customers', 25000, ['Up to 10 pages', 'Everything in Basic', 'Logo design', 'Admin panel: change text and photos yourself', 'Basic Google SEO setup', 'Ready in about 10–14 days', '3 months free support'], 30000, true),
            $p('business', 'Premium', 'Business that wants to grow fast', 40000, ['15+ pages', 'Everything in Standard', 'Facebook and Instagram ads setup', 'Full SEO setup', 'Social media post designs', 'Promo video', '6 months free support'], 45000),

            // Schools, colleges and academies
            $p('school', 'Basic', 'Small school or academy', 7000, ['Landing page or 3 pages', 'School introduction and photos', '"Admissions open" section', 'WhatsApp and call buttons', 'Google Map of your campus', 'Ready in about 3–7 days'], 12000),
            $p('school', 'Standard', 'Growing school or college', 25000, ['5 to 7 pages', 'Admissions, classes, teachers, gallery', 'Online admission form', 'News and events', 'Change text and photos yourself', 'Logo design', 'Ready in about 2 weeks'], 30000, true),
            $p('school', 'Premium', 'Big school, college or school system', 40000, ['10+ pages', 'Everything in Standard', 'Results and fee structure pages', 'Downloads: date sheet, syllabus', 'Facebook ads for admissions', 'Full SEO setup', 'Ready in about 3–4 weeks'], 45000),

            // Hotels and restaurants
            $p('restaurant', 'Basic', 'Small cafe or restaurant', 15000, ['Website up to 5 pages', 'Menu with prices', 'Food photos gallery', 'Order and book on WhatsApp', 'Google Map and timings', '1 month free support']),
            $p('restaurant', 'Standard', 'Restaurant or hotel that wants more customers', 25000, ['Everything in Basic', 'Table or room booking form', 'Logo and menu card design', 'Social media post designs', 'Basic Google SEO setup', '3 months free support'], null, true),
            $p('restaurant', 'Premium', 'Everything done for you', 35000, ['Full website with booking', 'Facebook and Instagram ads', 'Influencer video for your place', 'Full SEO setup', 'Logo and all designs', 'Customer support for your website', '6 months free support']),

            // Clothes, shoes, jewellery and mobile shops
            $p('store', 'Basic', 'Small shop starting online', 18000, ['Online store up to 50 products', 'Product photos and prices', 'Order on WhatsApp', 'Cash on delivery', 'Works on every mobile phone', '1 month free support']),
            $p('store', 'Standard', 'Shop that wants online sales', 30000, ['Up to 300 products', 'Cart and checkout', 'Sizes, colours and categories', 'Add products yourself', 'Logo and banner designs', 'Basic Google SEO setup', '3 months free support'], null, true),
            $p('store', 'Premium', 'Brand that wants to sell all over Pakistan', 45000, ['Unlimited products', 'Everything in Standard', 'Online payment option', 'Facebook and Instagram ads', 'Product promo video', 'Full SEO setup', '6 months free support']),

            // Real estate
            $p('realestate', 'Basic', 'New property dealer', 20000, ['Website up to 5 pages', 'Up to 30 property listings', 'Photos, price and location', 'Call and WhatsApp on every listing', 'Works on every mobile phone', '1 month free support']),
            $p('realestate', 'Standard', 'Growing real estate agency', 35000, ['Unlimited listings', 'Search by city, area and price', 'Add properties yourself', 'Agent profiles', 'Logo design', 'Basic Google SEO setup', '3 months free support'], null, true),
            $p('realestate', 'Premium', 'Big agency or housing project', 50000, ['Everything in Standard', 'Project pages with maps and plans', 'Facebook and Instagram ads', 'Property promo video', 'Full SEO setup', 'Logo and all designs', '6 months free support']),

            // Car showrooms and rent-a-car
            $p('rental', 'Basic', 'Small rent-a-car or showroom', 14000, ['Website up to 5 pages', 'Up to 15 cars with photos', 'Price per day or sale price', 'Book on WhatsApp', 'Google Map and timings', '1 month free support']),
            $p('rental', 'Standard', 'Growing rental or showroom', 24000, ['Unlimited cars', 'Filter by type: economy, sedan, SUV', 'Add cars and change prices yourself', 'Logo design', 'Basic Google SEO setup', '3 months free support'], null, true),
            $p('rental', 'Premium', 'Everything done for you', 35000, ['Everything in Standard', 'Facebook and Instagram ads', 'Car promo video', 'Full SEO setup', 'Logo and all designs', 'Customer support for your website', '6 months free support']),

            // Pharmacies and medical stores
            $p('pharmacy', 'Basic', 'Small pharmacy or medical store', 13000, ['Website up to 5 pages', 'Medicines and products list', 'Order on WhatsApp', 'Send prescription photo on WhatsApp', 'Timings and delivery area', '1 month free support']),
            $p('pharmacy', 'Standard', 'Pharmacy that wants home delivery orders', 22000, ['Everything in Basic', 'Medicine search', 'Add products and prices yourself', 'Categories: medicines, baby care, personal care', 'Logo design', 'Basic Google SEO setup', '3 months free support'], null, true),
            $p('pharmacy', 'Premium', 'Everything done for you', 35000, ['Full online pharmacy with cart', 'Upload prescription on the website', 'Facebook and Instagram ads', 'Full SEO setup', 'Logo and all designs', 'Customer support for your website', '6 months free support']),
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
            ['title' => 'Digital skills training platform', 'category' => 'development', 'kind' => 'project', 'industry' => 'school', 'client' => 'Learning With Earning',
                'summary' => 'Website for a digital skills training institute, with courses, student results, login and registration.',
                'image' => '/images/portfolio/learning-with-earning.webp', 'tags' => ['Education', 'Student login', 'Courses'], 'is_featured' => true],
            ['title' => 'Online store for mobile accessories', 'category' => 'development', 'kind' => 'project', 'industry' => 'store', 'client' => 'OneTechSmart',
                'summary' => 'Online store with product pages, discounts, prices in rupees and quick "Buy Now" buttons.',
                'image' => '/images/portfolio/onetechsmart.webp', 'tags' => ['Online store', 'Products', 'Rupee prices'], 'is_featured' => true],
            ['title' => 'Restaurant software website', 'category' => 'development', 'kind' => 'project', 'industry' => 'restaurant', 'client' => 'RestroManage',
                'summary' => 'Website for restaurant management software, with features, pricing and a free trial sign-up.',
                'image' => '/images/portfolio/restromanage.webp', 'tags' => ['Software', 'Free trial', 'Restaurants'], 'is_featured' => true],
            ['title' => 'Mentor finding platform', 'category' => 'development', 'kind' => 'project', 'industry' => 'school', 'client' => 'LWE MentorNet',
                'summary' => 'Students find verified mentors across Pakistan, see their profiles and send a request in one click.',
                'image' => '/images/portfolio/lwe-mentornet.webp', 'tags' => ['Education', 'Profiles', 'Requests']],
            ['title' => 'IT company website', 'category' => 'development', 'kind' => 'project', 'industry' => 'business', 'client' => 'NetOPZ',
                'summary' => 'Website for an IT company offering domain and hosting, design, development and marketing.',
                'image' => '/images/portfolio/netopz.webp', 'tags' => ['Company website', 'Services', 'Quote form']],
            ['title' => 'International company website', 'category' => 'development', 'kind' => 'project', 'industry' => 'business', 'client' => 'ZAHA Global',
                'summary' => 'Company website for a group working in Germany, Australia and Pakistan, in English and German.',
                'image' => '/images/portfolio/zaha-global.webp', 'tags' => ['Corporate', 'Two languages']],

            // Examples from the market (NOT our projects) — shown as design ideas for each type of business.
            ['title' => 'Dawaai', 'category' => 'development', 'kind' => 'example', 'industry' => 'pharmacy', 'client' => null,
                'summary' => 'Online pharmacy with medicine search, prescription upload and home delivery.', 'image' => '/images/examples/pharmacy/dawaai.webp', 'tags' => []],
            ['title' => 'DVAGO', 'category' => 'development', 'kind' => 'example', 'industry' => 'pharmacy', 'client' => null,
                'summary' => 'Pharmacy and wellness store with categories, offers and instant order.', 'image' => '/images/examples/pharmacy/dvago.webp', 'tags' => []],
            ['title' => 'Milkiyat.com', 'category' => 'development', 'kind' => 'example', 'industry' => 'realestate', 'client' => null,
                'summary' => 'Property portal to buy and rent across Pakistan, with city search and filters.', 'image' => '/images/examples/realestate/milkiyat.webp', 'tags' => []],
            ['title' => 'Trulia', 'category' => 'development', 'kind' => 'example', 'industry' => 'realestate', 'client' => null,
                'summary' => 'Home search website with a big photo banner and simple Buy / Rent / Sold search.', 'image' => '/images/examples/realestate/trulia.webp', 'tags' => []],
            ['title' => 'Maqsad', 'category' => 'development', 'kind' => 'example', 'industry' => 'school', 'client' => null,
                'summary' => 'Exam preparation platform with clear course choices and student photos.', 'image' => '/images/examples/school/maqsad.webp', 'tags' => []],
            ['title' => 'Sabaq', 'category' => 'development', 'kind' => 'example', 'industry' => 'school', 'client' => null,
                'summary' => 'Free e-learning website with videos, tests and simple numbers that build trust.', 'image' => '/images/examples/school/sabaq.webp', 'tags' => []],
            ['title' => "Tom's Court Hotel", 'category' => 'development', 'kind' => 'example', 'industry' => 'restaurant', 'client' => null,
                'summary' => 'Hotel website with room photos and a booking box right on the first screen.', 'image' => '/images/examples/restaurant/toms-court-hotel.webp', 'tags' => []],
            ['title' => 'Gin Long Canteen', 'category' => 'development', 'kind' => 'example', 'industry' => 'restaurant', 'client' => null,
                'summary' => 'Restaurant website with a full-screen food photo and a "Book a table" button.', 'image' => '/images/examples/restaurant/gin-long-canteen.webp', 'tags' => []],
            ['title' => 'Wasai Japanese Kitchen', 'category' => 'development', 'kind' => 'example', 'industry' => 'restaurant', 'client' => null,
                'summary' => 'Restaurant website with menu buttons, timings, location and online booking.', 'image' => '/images/examples/restaurant/wasai-kitchen.webp', 'tags' => []],
            ['title' => 'LAAM', 'category' => 'development', 'kind' => 'example', 'industry' => 'store', 'client' => null,
                'summary' => 'Clothing store with categories, big sale banner and prices in PKR.', 'image' => '/images/examples/store/laam.webp', 'tags' => []],
            ['title' => 'Insignia', 'category' => 'development', 'kind' => 'example', 'industry' => 'store', 'client' => null,
                'summary' => 'Shoes and fashion store with a large photo banner and new arrivals.', 'image' => '/images/examples/store/insignia.webp', 'tags' => []],
            ['title' => 'Wild Earth', 'category' => 'development', 'kind' => 'example', 'industry' => 'store', 'client' => null,
                'summary' => 'Shoes and outdoor store with filters for size, gender and brand.', 'image' => '/images/examples/store/wildearth.webp', 'tags' => []],
            ['title' => 'Flight Deck', 'category' => 'development', 'kind' => 'example', 'industry' => 'store', 'client' => null,
                'summary' => 'Clothing store with filters by category, size, colour and price.', 'image' => '/images/examples/store/flight-deck.webp', 'tags' => []],
            ['title' => 'WinStore', 'category' => 'development', 'kind' => 'example', 'industry' => 'store', 'client' => null,
                'summary' => 'Mobile phone store with brands, filters by price, RAM and storage.', 'image' => '/images/examples/store/winstore.webp', 'tags' => []],
            ['title' => 'Fast Mobile', 'category' => 'development', 'kind' => 'example', 'industry' => 'store', 'client' => null,
                'summary' => 'Mobile phone website with brand logos and best phones by price.', 'image' => '/images/examples/store/fast-mobile.webp', 'tags' => []],
            ['title' => 'MobileMate', 'category' => 'development', 'kind' => 'example', 'industry' => 'store', 'client' => null,
                'summary' => 'Mobile marketplace to buy, sell, compare phones and find repairers.', 'image' => '/images/examples/store/mobilemate.webp', 'tags' => []],
            ['title' => 'Faisal Rent a Car', 'category' => 'development', 'kind' => 'example', 'industry' => 'rental', 'client' => null,
                'summary' => 'Rent-a-car website in Multan with cars, price per day and "Book via WhatsApp".', 'image' => '/images/examples/rental/faisal-rent-a-car.webp', 'tags' => []],
            ['title' => 'Car rental marketplace', 'category' => 'development', 'kind' => 'example', 'industry' => 'rental', 'client' => null,
                'summary' => 'Car rental website with self-drive, with-driver and wedding car options.', 'image' => '/images/examples/rental/car-rental-lahore.webp', 'tags' => []],

            // Sample work (concepts) for graphic design, video editing and SEO — NOT client projects.
            // tags[0] = which service it shows: 'Graphic design', 'Video editing' or 'SEO'.
            ['title' => 'Restaurant social media post', 'category' => 'design', 'kind' => 'concept', 'industry' => 'restaurant', 'client' => 'Saffron Bites (concept)',
                'summary' => 'Instagram and Facebook post for a "Family Deal", with price, menu and WhatsApp order.', 'image' => '/images/samples/saffron-post.webp', 'url' => null, 'tags' => ['Graphic design']],
            ['title' => 'Pharmacy flyer', 'category' => 'design', 'kind' => 'concept', 'industry' => 'pharmacy', 'client' => 'ShifaLine Pharmacy (concept)',
                'summary' => 'Flyer for home delivery of medicines, with clear points and a big call button.', 'image' => '/images/samples/shifaline-flyer.webp', 'url' => null, 'tags' => ['Graphic design']],
            ['title' => 'School admission poster', 'category' => 'design', 'kind' => 'concept', 'industry' => 'school', 'client' => 'Bright Future School (concept)',
                'summary' => '"Admissions open" poster with happy students, classes and highlights, ready for print and Facebook.', 'image' => '/images/samples/school-admission-ai.webp', 'url' => null, 'tags' => ['Graphic design']],
            ['title' => 'Clothing brand sale post', 'category' => 'design', 'kind' => 'concept', 'industry' => 'store', 'client' => 'Zaviya (concept)',
                'summary' => 'Fashion sale post for a clothing brand: model photo, 40% off winter collection and a Shop Now button.', 'image' => '/images/samples/zaviya-ai.webp', 'url' => null, 'tags' => ['Graphic design']],
            ['title' => 'Rent-a-car post', 'category' => 'design', 'kind' => 'concept', 'industry' => 'rental', 'client' => 'SpeedWay Rent a Car (concept)',
                'summary' => 'Social media post with price per day, car options and a WhatsApp button.', 'image' => '/images/samples/speedway-post.webp', 'url' => null, 'tags' => ['Graphic design']],
            ['title' => 'Logo designs', 'category' => 'design', 'kind' => 'concept', 'industry' => null, 'client' => '4 brands (concept)',
                'summary' => 'Logos for a restaurant, pharmacy, school and clothing brand.', 'image' => '/images/samples/logos.webp', 'url' => null, 'tags' => ['Graphic design']],
            ['title' => 'Restaurant promo reel', 'category' => 'design', 'kind' => 'concept', 'industry' => 'restaurant', 'client' => 'Saffron Bites (concept)',
                'summary' => 'Short vertical reel for Instagram, TikTok and Facebook with smooth transitions.', 'image' => '/images/samples/reel-a-poster.webp', 'url' => '/videos/reel-a.mp4', 'tags' => ['Video editing']],
            ['title' => 'School admission reel', 'category' => 'design', 'kind' => 'concept', 'industry' => 'school', 'client' => 'Bright Future School (concept)',
                'summary' => 'Vertical reel for admissions with key points and a clear call to action.', 'image' => '/images/samples/reel-b-poster.webp', 'url' => '/videos/reel-b.mp4', 'tags' => ['Video editing']],
            ['title' => 'Before and after colour grading', 'category' => 'design', 'kind' => 'concept', 'industry' => 'store', 'client' => 'Clothing shop video (concept)',
                'summary' => 'A dull phone video made bright and sharp, with colour grading and sale text added.', 'image' => '/images/samples/video-before-after.webp', 'url' => null, 'tags' => ['Video editing']],
            ['title' => 'Food reel thumbnail', 'category' => 'design', 'kind' => 'concept', 'industry' => 'restaurant', 'client' => 'Restaurant reel (concept)',
                'summary' => 'Eye-catching cover for a restaurant reel on Instagram and TikTok, made to stop people scrolling.', 'image' => '/images/samples/reel-thumbnail-hungry.webp', 'url' => null, 'tags' => ['Video editing']],
            ['title' => 'Local SEO on Google Maps', 'category' => 'marketing', 'kind' => 'concept', 'industry' => null, 'client' => 'How local SEO works',
                'summary' => 'We put your shop on Google Maps with reviews, call and directions buttons, so nearby customers find you first.', 'image' => '/images/samples/seo-local-maps.webp', 'url' => null, 'tags' => ['SEO']],
            ['title' => 'Higher Google ranking', 'category' => 'marketing', 'kind' => 'concept', 'industry' => null, 'client' => 'How SEO works',
                'summary' => 'Better titles, faster pages and useful content move your website up in Google search results.', 'image' => '/images/samples/seo-ranking-growth.webp', 'url' => null, 'tags' => ['SEO']],
            ['title' => 'SEO tracking dashboard', 'category' => 'marketing', 'kind' => 'concept', 'industry' => null, 'client' => 'Sample dashboard',
                'summary' => 'We track your speed, SEO score and visitors every month and show you what improved.', 'image' => '/images/samples/seo-dashboard.webp', 'url' => null, 'tags' => ['SEO']],
            ['title' => 'Website health check report', 'category' => 'marketing', 'kind' => 'concept', 'industry' => null, 'client' => 'Sample report',
                'summary' => 'What you get after our free SEO check: speed, Google and mobile scores with a list of fixes.', 'image' => '/images/samples/seo-audit.webp', 'url' => null, 'tags' => ['SEO']],
            ['title' => 'Monthly SEO report', 'category' => 'marketing', 'kind' => 'concept', 'industry' => null, 'client' => 'Sample report (sample data)',
                'summary' => 'The simple monthly report you get: visitors from Google, Maps ranking and calls.', 'image' => '/images/samples/seo-growth.webp', 'url' => null, 'tags' => ['SEO']],
        ];
    }
}
