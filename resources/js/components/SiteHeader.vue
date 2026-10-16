<script setup>
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import ChatIcon from './ChatIcon.vue';
import PhoneIcon from './PhoneIcon.vue';
import { site, whatsappLink, phoneLink } from '../lib/site';

const links = [
    { to: '/services', label: 'Services' },
    { to: '/pricing', label: 'Prices' },
    { to: '/solutions', label: 'Solutions' },
    { to: '/portfolio', label: 'Our work' },
    { to: '/about', label: 'About us' },
    { to: '/contact', label: 'Contact' },
];

// Logo files live in public/images/ (growmiotech-logo.svg for light backgrounds, -white.svg for dark).
const logo = '/images/growmiotech-logo.svg';

const open = ref(false);
const route = useRoute();
watch(() => route.fullPath, () => (open.value = false));
</script>

<template>
    <header class="sticky top-0 z-40 border-b border-line bg-white/90 shadow-[0_6px_24px_-18px_rgba(15,23,42,0.35)] backdrop-blur">
        <div class="wrap flex h-[4.5rem] items-center justify-between gap-6">
            <RouterLink to="/" class="flex items-center">
                <img :src="logo" :alt="site.name" width="186" height="40" class="h-9 w-auto sm:h-10" />
            </RouterLink>

            <nav class="hidden items-center gap-7 lg:flex" aria-label="Main">
                <RouterLink
                    v-for="link in links"
                    :key="link.to"
                    :to="link.to"
                    class="font-semibold text-body hover:text-accent"
                    active-class="text-accent! underline decoration-accent decoration-[3px] underline-offset-8"
                >
                    {{ link.label }}
                </RouterLink>
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp py-2.5!">
                    <ChatIcon class="size-5" /> WhatsApp us
                </a>
            </nav>

            <button
                type="button"
                class="flex h-11 items-center gap-2 rounded-lg border border-line px-3 font-semibold text-ink lg:hidden"
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

        <nav v-show="open" id="mobile-menu" class="border-t border-line bg-white lg:hidden" aria-label="Mobile">
            <div class="wrap flex flex-col py-3">
                <RouterLink
                    v-for="link in links"
                    :key="link.to"
                    :to="link.to"
                    class="border-b border-line py-3.5 text-lg font-semibold text-ink"
                >
                    {{ link.label }}
                </RouterLink>
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg mt-4">
                    <ChatIcon class="size-6" /> WhatsApp us
                </a>
                <a :href="phoneLink()" class="btn btn-outline btn-lg my-3">
                    <PhoneIcon class="size-5" /> Call {{ site.phone }}
                </a>
            </div>
        </nav>
    </header>
</template>
