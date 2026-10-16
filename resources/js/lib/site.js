// Agency details come from config/agency.php (Laravel puts them on the page as window.__APP__).
// Edit that file to change the name, phone, email, team or FAQs.
const app = window.__APP__ ?? {};

export const site = app.site ?? { name: 'GrowmioTech', tagline: '', email: '', phone: '', whatsapp: '', address: '', hours: '' };
export const team = app.team ?? [];
export const solutions = app.solutions ?? [];
export const pricingFaqs = app.faqs ?? [];
export const seoPages = app.seo ?? {};
export const baseUrl = app.baseUrl ?? window.location.origin;

export const whatsappLink = (text = 'Assalam o Alaikum! I want to know about your services.') =>
    `https://wa.me/${site.whatsapp}?text=${encodeURIComponent(text)}`;

export const phoneLink = () => `tel:${(site.phone || '').replace(/\s/g, '')}`;

// Colour groups for services and projects.
export const categories = [
    { key: 'development', label: 'Websites & apps' },
    { key: 'design', label: 'Design & video' },
    { key: 'marketing', label: 'Marketing' },
];

export const categoryLabel = (key) => categories.find((c) => c.key === key)?.label ?? key;

// Types of business on the pricing page (category key in the database → name, icon, short text).
export const planGroups = [
    { key: 'business', title: 'Business websites', short: 'Business', icon: 'shop', text: 'For shops, companies, clinics, offices and other businesses.' },
    { key: 'school', title: 'Schools, colleges and academies', short: 'School / Academy', icon: 'school', text: 'For schools, colleges, academies and tuition centres.' },
    { key: 'restaurant', title: 'Hotels and restaurants', short: 'Hotel / Restaurant', icon: 'restaurant', text: 'For hotels, restaurants, cafes and food points.' },
    { key: 'store', title: 'Clothes, shoes, jewellery and mobile shops', short: 'Online store', icon: 'bag', text: 'Sell clothes, shoes, jewellery, mobiles and devices online.' },
    { key: 'realestate', title: 'Real estate', short: 'Real estate', icon: 'home', text: 'For property dealers, real estate agencies and housing projects.' },
    { key: 'rental', title: 'Car showrooms and rent-a-car', short: 'Showroom / Rent-a-car', icon: 'car', text: 'For car showrooms, rent-a-car and booking businesses.' },
    { key: 'pharmacy', title: 'Pharmacies and medical stores', short: 'Pharmacy', icon: 'pharmacy', text: 'For pharmacies, medical stores and health shops.' },
];

export const formatPKR = (amount) => `Rs ${Number(amount).toLocaleString('en-US')}`;

// "Rs 12,000 – 15,000" for a range, "Rs 7,000" for a fixed price.
export const priceLabel = (plan) =>
    plan.price_max && plan.price_max > plan.price
        ? `${formatPKR(plan.price)} – ${Number(plan.price_max).toLocaleString('en-US')}`
        : formatPKR(plan.price);

// Ready-made WhatsApp message for a package.
export const planMessage = (plan) => {
    const group = planGroups.find((g) => g.key === plan.category)?.title ?? 'Website';
    return `Assalam o Alaikum! I want the ${group} – ${plan.name} package (${priceLabel(plan)}). Please tell me the next step.`;
};
