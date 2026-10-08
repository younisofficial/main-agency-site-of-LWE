import { baseUrl, site } from './site';

// Keeps the browser tab title and the SEO tags correct when moving between pages
// without a full reload. (On first load Laravel has already put them in the HTML.)
function setMeta(selector, value) {
    document.head.querySelector(selector)?.setAttribute('content', value);
}

export function applySeo({ title, description, path, noindex = false }) {
    const url = baseUrl + (path === '/' ? '' : path);

    document.title = title;
    setMeta('meta[name="description"]', description);
    setMeta('meta[name="robots"]', noindex ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1');
    setMeta('meta[property="og:title"]', title);
    setMeta('meta[property="og:description"]', description);
    setMeta('meta[property="og:url"]', url);
    setMeta('meta[name="twitter:title"]', title);
    setMeta('meta[name="twitter:description"]', description);
    document.head.querySelector('link[rel="canonical"]')?.setAttribute('href', url);
}

export const notFoundSeo = (path) => ({
    title: `Page not found | ${site.name}`,
    description: 'This page does not exist.',
    path,
    noindex: true,
});
