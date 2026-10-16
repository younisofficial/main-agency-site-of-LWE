<?php

/*
 * Everything about your agency in one place.
 * The website, the SEO tags and Google's structured data all read from here.
 * After editing on a live server run: php artisan config:cache
 */
return [
    'name' => 'GrowmioTech',
    'domain' => 'growmiotech.com',
    'tagline' => 'Websites, design and marketing for Pakistani businesses, schools and pharmacies.',

    // Contact details shown on the website.
    'email' => '',                          // empty = no email shown anywhere
    'phone' => '0309 7606706',
    'whatsapp' => '923097606706',          // digits only, with country code
    'address' => 'Multan, Pakistan',       // shown in the footer and on the contact page
    'city' => 'Multan',
    'region' => 'Punjab',
    'country' => 'PK',
    'hours' => 'Mon–Sat, 9am–7pm',

    // Full profile links. Leave empty to skip. Used in Google structured data.
    'social' => [
        // 'https://www.facebook.com/growmiotech',
        // 'https://www.instagram.com/growmiotech',
        // 'https://www.linkedin.com/company/growmiotech',
    ],

    /*
     * Hero (banner) photo. Put a normal JPG, PNG or WebP in public/images/
     * and write its path here — do NOT convert the photo to SVG, that makes it blurry.
     * Best size: a portrait photo at least 900 px wide and 1125 px tall (4:5).
     * A PNG with a transparent background also works.
     */
    'hero_photo' => '/images/ceo-lwe.webp',

    /*
     * Team shown in the moving circle.
     * The first person sits in the centre; the rest circle around.
     * Photos: square JPG/PNG/WebP in public/images/team/, at least 500x500 px,
     * face in the centre. To swap two photos, just swap the 'photo' lines.
     */
    'team' => [
        ['name' => 'Imran Sheikh', 'role' => 'Project Manager', 'photo' => '/images/team/imran-sheikh.webp'],
        ['name' => 'Muhammad Younis', 'role' => 'Full Stack Web Developer', 'photo' => '/images/team/muhammad-younis.webp'],
        ['name' => 'Talha Mughal', 'role' => 'Advertiser & Marketer', 'photo' => '/images/team/talha.webp'],
        ['name' => 'Hassan', 'role' => 'Graphic Designer', 'photo' => '/images/team/hassan.webp'],
        ['name' => 'Shumaila', 'role' => 'Video Editor', 'photo' => '/images/team/shumaila.webp'],
        ['name' => 'Muhammad Danish', 'role' => 'App Developer', 'photo' => '/images/team/muhammad-danish.webp'],
        ['name' => 'Muhammad Amir', 'role' => 'SEO Specialist', 'photo' => '/images/team/muhammad-amir.webp'],
    ],

    // Shown on the pricing page and sent to Google as FAQ structured data.
    // Keep the answers short and simple.
    'pricing_faqs' => [
        ['q' => 'How do I order?', 'a' => 'Choose a package and press "Order on WhatsApp". Or call us. We will ask you a few simple questions about your business and tell you the exact price.'],
        ['q' => 'How fast will my website be ready?', 'a' => 'Small websites are ready in 3 to 7 days. Bigger websites take 2 to 4 weeks. We tell you the date before we start.'],
        ['q' => 'Do you make pharmacy websites?', 'a' => 'Yes. We make pharmacy and medical store websites with your medicines list, timings, location and a WhatsApp order button.'],
        ['q' => 'Why is the price a range, like Rs 12,000 – 15,000?', 'a' => 'The final price depends on how many pages and features you need. We tell you the exact price before we start work.'],
        ['q' => 'Are domain and hosting included?', 'a' => 'No, they are paid separately. We help you buy them in your own name and tell you the cost before we start.'],
        ['q' => 'What do I need to give you?', 'a' => 'Your business name, phone number, logo, some photos and a little information about your work. No logo? We can make one for you.'],
        ['q' => 'Can I change my website later?', 'a' => 'Yes. Standard and Premium websites have an easy admin panel to change text and photos. For bigger changes, just message us.'],
        ['q' => 'Will the website be mine?', 'a' => 'Yes. After the final payment the website, domain and all files are yours.'],
    ],

    /*
     * "Solutions" page: every type of business, its problems, our solution and why choose us.
     * Keep the words short and simple. 'key' must match the pricing groups.
     */
    'solutions' => [
        [
            'key' => 'business', 'title' => 'Shops, offices and clinics', 'image' => '/images/samples/seo-local-maps.webp',
            'problem' => 'People search "near me" on Google, but your shop does not show up. They go to the shop next door.',
            'problems' => ['Not on Google Maps', 'No place to show your work and prices', 'Same questions on the phone all day'],
            'solutions' => ['Your shop on Google Maps with timings, photos and a call button', 'A 5-page website with your work and prices', 'WhatsApp button on every page'],
            'package' => 'Basic', 'price' => 'Rs 12,000 – 15,000',
            'math' => 'If only 3 new customers a month find you on Google, the website pays for itself in 2–3 months.',
        ],
        [
            'key' => 'school', 'title' => 'Schools, colleges and academies', 'image' => '/images/samples/school-admission-ai.webp',
            'problem' => 'Parents check schools online before admission. They find only a Facebook page, so they choose the school that has a website.',
            'problems' => ['Parents cannot see the school before visiting', 'Fee and admission details only on paper', 'Fewer admissions than nearby schools'],
            'solutions' => ['5–7 page website: classes, teachers, gallery, fee structure', 'Online admission form', 'Admission poster for every session'],
            'package' => 'Standard', 'price' => 'Rs 25,000 – 30,000',
            'math' => 'The fee of just one extra student for one year is more than the price of the website.',
        ],
        [
            'key' => 'restaurant', 'title' => 'Hotels and restaurants', 'image' => '/images/samples/reel-thumbnail-hungry.webp',
            'problem' => 'Food apps often take around 25–30% commission. On a Rs 1,000 order, about Rs 250–300 goes to the app.',
            'problems' => ['Big commission on every app order', 'Menu and prices not online', 'Orders lost in phone calls'],
            'solutions' => ['Your own website with menu, photos and prices', 'Orders and table booking straight on WhatsApp', 'Food reels and posts that bring people to your page'],
            'package' => 'Standard / Premium', 'price' => 'Rs 25,000 – 35,000',
            'math' => 'If just 100 orders a month come on WhatsApp instead of the app, you can save Rs 25,000 or more in commission.',
        ],
        [
            'key' => 'store', 'title' => 'Clothes, shoes, jewellery and mobile shops', 'image' => '/images/samples/zaviya-ai.webp',
            'problem' => 'Orders come in Instagram DMs. Size, colour and address get lost, and customers leave while waiting for a reply.',
            'problems' => ['Orders lost in DMs', 'Sales only to people who walk in', 'Customers do not trust a shop without a website'],
            'solutions' => ['Online store with sizes, colours and prices', 'Cart, cash on delivery and order on WhatsApp', 'Orders saved in your admin panel'],
            'package' => 'Standard', 'price' => 'Rs 30,000',
            'math' => 'Your shop stays open at 12 at night too, and orders come from all of Pakistan, not only your area.',
        ],
        [
            'key' => 'realestate', 'title' => 'Real estate and property dealers', 'image' => '/images/samples/estate-post.webp',
            'problem' => 'Every buyer asks the same on WhatsApp: send photos, what size, what price. Half your day goes in this. On big portals, other dealers show next to you.',
            'problems' => ['Sending photos again and again', 'Listings lost in Facebook groups', 'Competitors next to you on portals'],
            'solutions' => ['Your own website with every plot, house and shop', 'Photos, size, price and location — send one link', 'Call and WhatsApp button on every property'],
            'package' => 'Standard', 'price' => 'Rs 35,000',
            'math' => 'The commission from just one deal is many times more than the price of the website.',
        ],
        [
            'key' => 'rental', 'title' => 'Car showrooms and rent-a-car', 'image' => '/images/samples/speedway-post.webp',
            'problem' => 'People call all day to ask which car you have and how much. Bookings are on paper and sometimes get double-booked.',
            'problems' => ['Too many phone calls for prices', 'Customers cannot see your cars', 'Paper bookings and mistakes'],
            'solutions' => ['Every car with photo, seats and price per day', 'Book on WhatsApp in one click', 'Change cars and prices yourself'],
            'package' => 'Standard', 'price' => 'Rs 24,000',
            'math' => 'At Rs 5,000 per day, just 5 extra bookings pay for the website.',
        ],
        [
            'key' => 'pharmacy', 'title' => 'Pharmacies and medical stores', 'image' => '/images/samples/shifaline-flyer.webp',
            'problem' => 'People order medicines from big online pharmacies. Your neighbours do not even know you deliver at home.',
            'problems' => ['Customers going to online pharmacies', 'Nobody knows you deliver', 'Prescriptions only in person'],
            'solutions' => ['Pharmacy website with medicines and timings', 'Send prescription photo on WhatsApp', 'Show up in "pharmacy near me" on Google Maps'],
            'package' => 'Standard', 'price' => 'Rs 22,000',
            'math' => 'A customer who orders once from home usually buys the monthly medicines from you again and again.',
        ],
    ],

    /*
     * SEO title and description for each page.
     * Title: keep under 60 characters. Description: 120–155 characters.
     */
    'seo' => [
        '/' => [
            'title' => 'Website Design in Multan, Pakistan | GrowmioTech',
            'description' => 'GrowmioTech is a web design agency in Multan. Websites for shops, schools, restaurants and pharmacies from Rs 7,000, plus SEO, logos and Facebook ads.',
            'heading' => 'Websites that bring you more customers.',
        ],
        '/services' => [
            'title' => 'Web Design, SEO & Ads Services in Multan | GrowmioTech',
            'description' => 'Website development, school and pharmacy websites, online stores, mobile apps, logo design, video editing, SEO and Facebook ads in Multan and all Pakistan.',
            'heading' => 'Services',
        ],
        '/portfolio' => [
            'title' => 'Our Work — Websites, Design, Video & SEO | GrowmioTech',
            'description' => 'Websites made by the GrowmioTech team in Multan, plus sample graphic design, video editing and SEO work. See our style before you order.',
            'heading' => 'Our work',
        ],
        '/pricing' => [
            'title' => 'Website Price in Pakistan from Rs 7,000 | GrowmioTech',
            'description' => 'Website packages for shops, schools, restaurants, online stores, real estate, rent-a-car and pharmacies from Rs 7,000. Prices in PKR, fast delivery.',
            'heading' => 'Our prices',
        ],
        '/solutions' => [
            'title' => 'Website Solutions for Every Business | GrowmioTech',
            'description' => 'Problems shops, schools, restaurants, stores, real estate, rent-a-car and pharmacies face online, and how a GrowmioTech website solves them.',
            'heading' => 'Solutions for your business',
        ],
        '/about' => [
            'title' => 'About GrowmioTech — Web Design Team in Multan, Pakistan',
            'description' => 'Meet the GrowmioTech team in Multan: project manager, web and app developers, SEO specialist, marketer, graphic designer and video editor.',
            'heading' => 'About GrowmioTech',
        ],
        '/contact' => [
            'title' => 'Contact GrowmioTech Multan — WhatsApp 0309 7606706',
            'description' => 'Message GrowmioTech on WhatsApp, call us or fill a short form. Tell us what you need and we will tell you the price and time.',
            'heading' => 'Contact us',
        ],
    ],
];
