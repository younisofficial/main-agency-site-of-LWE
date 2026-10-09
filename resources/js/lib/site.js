// Agency details come from config/agency.php (Laravel puts them on the page as window.__APP__).
// Edit that file to change the name, phone, email, team or FAQs.
const app = window.__APP__ ?? {};

export const site = app.site ?? { name: 'GrowmioTech', tagline: '', email: '', phone: '', whatsapp: '', address: '', hours: '' };
export const team = app.team ?? [];
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

// Price tables on the pricing page (category key in the database → heading).
export const planGroups = [
    { key: 'business', title: 'Business websites', text: 'For shops, companies, clinics, restaurants and other businesses.' },
    { key: 'school', title: 'School websites', text: 'For schools, colleges and academies.' },
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
