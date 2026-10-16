import { createRouter, createWebHistory } from 'vue-router';
import { seoPages } from './lib/site';
import { applySeo, notFoundSeo } from './lib/seo';

// Pages are loaded together with the site (not one by one), so moving between pages is instant
// and never shows an empty page with only the footer.
import Home from './pages/Home.vue';
import Services from './pages/Services.vue';
import ServiceDetail from './pages/ServiceDetail.vue';
import Portfolio from './pages/Portfolio.vue';
import Pricing from './pages/Pricing.vue';
import Solutions from './pages/Solutions.vue';
import About from './pages/About.vue';
import Contact from './pages/Contact.vue';
import NotFound from './pages/NotFound.vue';

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/services', name: 'services', component: Services },
    { path: '/services/:slug', name: 'service', component: ServiceDetail, props: true },
    { path: '/portfolio', name: 'portfolio', component: Portfolio },
    { path: '/pricing', name: 'pricing', component: Pricing },
    { path: '/solutions', name: 'solutions', component: Solutions },
    { path: '/about', name: 'about', component: About },
    { path: '/contact', name: 'contact', component: Contact },
    { path: '/:pathMatch(.*)*', name: 'not-found', component: NotFound },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, saved) {
        if (saved) return saved;
        // Wait for the page fade to finish before scrolling to a #section.
        if (to.hash) return new Promise((resolve) => setTimeout(() => resolve({ el: to.hash, top: 90 }), 200));
        return { top: 0 };
    },
});

// Titles and descriptions live in config/agency.php → 'seo'.
// Service pages set their own in ServiceDetail.vue.
router.afterEach((to) => {
    const page = seoPages[to.path];
    if (page) applySeo({ ...page, path: to.path });
    else if (to.name === 'not-found') applySeo(notFoundSeo(to.path));
});

export default router;
