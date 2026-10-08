import { createRouter, createWebHistory } from 'vue-router';
import { seoPages } from './lib/site';
import { applySeo, notFoundSeo } from './lib/seo';

const routes = [
    { path: '/', name: 'home', component: () => import('./pages/Home.vue') },
    { path: '/services', name: 'services', component: () => import('./pages/Services.vue') },
    { path: '/services/:slug', name: 'service', component: () => import('./pages/ServiceDetail.vue'), props: true },
    { path: '/portfolio', name: 'portfolio', component: () => import('./pages/Portfolio.vue') },
    { path: '/pricing', name: 'pricing', component: () => import('./pages/Pricing.vue') },
    { path: '/about', name: 'about', component: () => import('./pages/About.vue') },
    { path: '/contact', name: 'contact', component: () => import('./pages/Contact.vue') },
    { path: '/:pathMatch(.*)*', name: 'not-found', component: () => import('./pages/NotFound.vue') },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, saved) {
        if (saved) return saved;
        if (to.hash) return { el: to.hash, top: 90 };
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
