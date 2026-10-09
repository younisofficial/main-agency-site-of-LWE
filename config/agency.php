<?php

/*
 * Everything about your agency in one place.
 * The website, the SEO tags and Google's structured data all read from here.
 * After editing on a live server run: php artisan config:cache
 */
return [
    'name' => 'GrowmioTech',
    'domain' => 'growmiotech.com',
    'tagline' => 'Websites, design and marketing for Pakistani businesses and schools.',

    // Placeholders — replace with your real details.
    'email' => 'hello@growmiotech.com',
    'phone' => '+92 300 0000000',
    'whatsapp' => '923000000000',          // digits only, with country code
    'address' => 'Your office address, City, Pakistan',
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
        ['name' => 'Talha', 'role' => 'Advertiser & Marketer', 'photo' => '/images/team/talha.webp'],
        ['name' => 'Hassan', 'role' => 'Graphic Designer', 'photo' => '/images/team/hassan.webp'],
        ['name' => 'Shumaila', 'role' => 'Video Editor', 'photo' => '/images/team/shumaila.webp'],
    ],

    // Shown on the pricing page and sent to Google as FAQ structured data.
    // Keep the answers short and simple.
    'pricing_faqs' => [
        ['q' => 'How do I order?', 'a' => 'Choose a package and press "Order on WhatsApp". Or call us. We will ask you a few simple questions about your business and tell you the exact price.'],
        ['q' => 'How do I pay?', 'a' => 'Pay 50% before we start. Pay the other 50% when your website is ready and you are happy with it. We send the payment details on WhatsApp.'],
        ['q' => 'Why is the price a range, like Rs 12,000 – 15,000?', 'a' => 'The final price depends on how many pages and features you need. We tell you the exact price before we start work.'],
        ['q' => 'Are domain and hosting included?', 'a' => 'No, they are paid separately. We help you buy them in your own name and tell you the cost before we start.'],
        ['q' => 'What do I need to give you?', 'a' => 'Your business name, phone number, logo, some photos and a little information about your work. No logo? We can make one for you.'],
        ['q' => 'Can I change my website later?', 'a' => 'Yes. Standard and Premium websites have an easy admin panel to change text and photos. For bigger changes, just message us.'],
        ['q' => 'Will the website be mine?', 'a' => 'Yes. After the final payment the website, domain and all files are yours.'],
    ],

    /*
     * SEO title and description for each page.
     * Title: keep under 60 characters. Description: 120–155 characters.
     */
    'seo' => [
        '/' => [
            'title' => 'GrowmioTech — Website Design in Pakistan | Business & School Sites',
            'description' => 'GrowmioTech makes websites for businesses and schools in Pakistan, plus logos, video editing, SEO and Facebook ads. Simple prices in PKR.',
            'heading' => 'Websites that bring you more customers.',
        ],
        '/services' => [
            'title' => 'Services — Websites, Design, Video & Ads | GrowmioTech',
            'description' => 'Business websites, school websites, WordPress, mobile apps, logo and graphic design, video editing, SEO, Facebook and Google ads from one team.',
            'heading' => 'Services',
        ],
        '/portfolio' => [
            'title' => 'Portfolio — Websites, Apps & Campaigns | GrowmioTech',
            'description' => 'See websites made by the GrowmioTech team: online stores, education platforms, software and company websites.',
            'heading' => 'Our work',
        ],
        '/pricing' => [
            'title' => 'Website Prices in Pakistan (PKR) | GrowmioTech',
            'description' => 'Business websites from Rs 12,000 and school websites from Rs 7,000. Clear packages in PKR, 50% advance, and easy ordering on WhatsApp.',
            'heading' => 'Our prices',
        ],
        '/about' => [
            'title' => 'About GrowmioTech — Our Team and How We Work',
            'description' => 'Meet the GrowmioTech team: project manager, web developer, marketer, graphic designer and video editor working together for your business.',
            'heading' => 'About GrowmioTech',
        ],
        '/contact' => [
            'title' => 'Contact GrowmioTech — WhatsApp, Call or Send a Message',
            'description' => 'Message GrowmioTech on WhatsApp, call us or fill a short form. Tell us what you need and we will tell you the price and time.',
            'heading' => 'Contact us',
        ],
    ],
];
