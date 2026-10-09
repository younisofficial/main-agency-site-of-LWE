<script setup>
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import ChatIcon from './ChatIcon.vue';
import PhoneIcon from './PhoneIcon.vue';
import { site, whatsappLink, phoneLink } from '../lib/site';

const links = [
    { to: '/services', label: 'Services' },
    { to: '/pricing', label: 'Prices' },
    { to: '/portfolio', label: 'Our work' },
    { to: '/about', label: 'About us' },
    { to: '/contact', label: 'Contact' },
];

// Logo files live in public/images/ (growmiotech-logo-white.svg is for dark backgrounds).
const logo = '/images/growmiotech-logo-white.svg';

const open = ref(false);
const route = useRoute();
watch(() => route.fullPath, () => (open.value = false));
</script>

<template>
    <header class="sticky top-0 z-40 border-b border-white/10 bg-night/95 backdrop-blur">
        <div class="wrap flex h-[4.5rem] items-center justify-between gap-6">
            <RouterLink to="/" class="flex items-center">
                <img :src="logo" :alt="site.name" width="186" height="40" class="h-9 w-auto sm:h-10" />
            </RouterLink>

            <nav class="hidden items-center gap-7 lg:flex" aria-label="Main">
                <RouterLink
                    v-for="link in links"
                    :key="link.to"
                    :to="link.to"
                    class="font-medium text-white/80 hover:text-white"
                    active-class="text-white! underline decoration-sun decoration-[3px] underline-offset-8"
                >
                    {{ link.label }}
                </RouterLink>
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp py-2.5!">
                    <ChatIcon class="size-5" /> WhatsApp us
                </a>
            </nav>

            <button
                type="button"
                class="flex h-11 items-center gap-2 rounded-lg border border-white/25 px-3 font-semibold text-white lg:hidden"
                :aria-expanded="open"
                aria-controls="mobile-menu"
                @click="open = !open"
            >
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path v-if="open" d="M6 6l12 12M18 6L6 18" />
                    <path v-else d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                {{ open ? 'Close' : 'Menu' }}
            </button>
        </div>

        <nav v-show="open" id="mobile-menu" class="border-t border-white/10 bg-night lg:hidden" aria-label="Mobile">
            <div class="wrap flex flex-col py-3">
                <RouterLink
                    v-for="link in links"
                    :key="link.to"
                    :to="link.to"
                    class="border-b border-white/10 py-3.5 text-lg font-medium text-white"
                >
                    {{ link.label }}
                </RouterLink>
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg mt-4">
                    <ChatIcon class="size-6" /> WhatsApp us
                </a>
                <a :href="phoneLink()" class="btn btn-ghost btn-lg my-3">
                    <PhoneIcon class="size-5" /> Call {{ site.phone }}
                </a>
            </div>
        </nav>
    </header>
</template>
