// Agency details come from config/agency.php (Laravel puts them on the page as window.__APP__).
// Edit that file to change the name, phone, email, team or FAQs.
const app = window.__APP__ ?? {};

export const site = app.site ?? { name: 'GrowmioTech', tagline: '', email: '', phone: '', whatsapp: '', address: '', hours: '' };
export const team = app.team ?? [];
export const pricingFaqs = app.faqs ?? [];
export const seoPages = app.seo ?? {};
export const baseUrl = app.baseUrl ?? window.location.origin;

export const whatsappLink = (text = 'Hello, I am interested in your services.') =>
    `https://wa.me/${site.whatsapp}?text=${encodeURIComponent(text)}`;

export const categories = [
    { key: 'development', label: 'Development', blurb: 'Websites, stores and apps.' },
    { key: 'design', label: 'Design', blurb: 'How it looks and how it works.' },
    { key: 'marketing', label: 'Marketing', blurb: 'Getting customers to find you.' },
];

export const categoryLabel = (key) => categories.find((c) => c.key === key)?.label ?? key;

export const formatUSD = (amount) => `$${Number(amount).toLocaleString('en-US')}`;
