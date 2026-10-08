<?php

/*
 * Everything about your agency in one place.
 * The website, the SEO tags and Google's structured data all read from here.
 * After editing on a live server run: php artisan config:cache
 */
return [
    'name' => 'GrowmioTech',
    'domain' => 'growmiotech.com',
    'tagline' => 'Web, design and marketing under one roof.',

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
     * Team shown in the moving circle. DUMMY names and photos — replace them.
     * The first person sits in the centre; the rest circle around.
     * Photos: square images in public/images/team/ (400x400 is enough).
     */
    'team' => [
        ['name' => 'Founder Name', 'role' => 'Founder & CEO', 'photo' => '/images/team/member-1.svg'],
        ['name' => 'Ayesha Khan', 'role' => 'Lead developer', 'photo' => '/images/team/member-2.svg'],
        ['name' => 'Bilal Ahmed', 'role' => 'UX/UI designer', 'photo' => '/images/team/member-3.svg'],
        ['name' => 'Sara Malik', 'role' => 'SEO specialist', 'photo' => '/images/team/member-4.svg'],
        ['name' => 'Hamza Ali', 'role' => 'App developer', 'photo' => '/images/team/member-5.svg'],
        ['name' => 'Zainab Noor', 'role' => 'Content writer', 'photo' => '/images/team/member-6.svg'],
        ['name' => 'Usman Tariq', 'role' => 'Marketing manager', 'photo' => '/images/team/member-7.svg'],
    ],

    // Shown on the pricing page and sent to Google as FAQ structured data.
    'pricing_faqs' => [
        ['q' => 'Are these prices final?', 'a' => 'They are starting prices for the scope listed in each plan. If you need more pages, features or keywords, we send a fixed written quote before any work starts.'],
        ['q' => 'How do payments work?', 'a' => 'One-time projects are split 50% to start and 50% before launch. Monthly marketing plans are billed at the start of each month and you can cancel with 30 days notice.'],
        ['q' => 'Is the advertising budget included?', 'a' => 'No. Marketing plans cover our management, creative and reporting. The budget you spend on Google, Meta or TikTok is paid directly to those platforms.'],
        ['q' => 'Do I own the work?', 'a' => 'Yes. After the final payment you own the code, the designs and all source files, and we hand them over.'],
        ['q' => 'Are domain and hosting included?', 'a' => 'They are billed separately at cost. We can set them up in your name so you stay in control of the accounts.'],
        ['q' => 'Can I combine plans?', 'a' => 'Yes. Most clients pair a website with a marketing plan. Tell us which ones on the contact form and we will price them together.'],
    ],

    /*
     * SEO title and description for each page.
     * Title: keep under 60 characters. Description: 120–155 characters.
     */
    'seo' => [
        '/' => [
            'title' => 'GrowmioTech — Web Development, Design & SEO Agency',
            'description' => 'GrowmioTech builds custom websites, WordPress stores and mobile apps, designs brands and UX/UI, and grows traffic with SEO, ads and content marketing.',
            'heading' => 'One agency to build it, design it and get it found.',
        ],
        '/services' => [
            'title' => 'Services — Web, App, Design, SEO & Marketing | GrowmioTech',
            'description' => 'Custom web development, WordPress, app development, web design, UX/UI, graphic design, SEO, advertising, content writing and marketing from one team.',
            'heading' => 'Services',
        ],
        '/portfolio' => [
            'title' => 'Portfolio — Websites, Apps & Campaigns | GrowmioTech',
            'description' => 'See websites, online stores, mobile apps, brand designs and marketing campaigns delivered by the GrowmioTech team for clients.',
            'heading' => 'Our work',
        ],
        '/pricing' => [
            'title' => 'Pricing — Web, Design & Marketing Plans | GrowmioTech',
            'description' => 'Clear plans in US dollars for web development, design and digital marketing. Compare three plans in each category and pick the one that fits.',
            'heading' => 'Pricing',
        ],
        '/about' => [
            'title' => 'About GrowmioTech — Our Team and How We Work',
            'description' => 'GrowmioTech is a digital agency where developers, designers and marketers work as one team. Meet the people and see how we run projects.',
            'heading' => 'About GrowmioTech',
        ],
        '/contact' => [
            'title' => 'Contact GrowmioTech — Get a Free Quote',
            'description' => 'Tell GrowmioTech about your website, app, design or marketing project and get a written quote and timeline within one working day.',
            'heading' => 'Get a free quote',
        ],
    ],
];
