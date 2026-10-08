<script setup>
import { ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import { site } from '../lib/site';

const links = [
    { to: '/services', label: 'Services' },
    { to: '/portfolio', label: 'Portfolio' },
    { to: '/pricing', label: 'Pricing' },
    { to: '/about', label: 'About' },
    { to: '/contact', label: 'Contact' },
];

const open = ref(false);
const route = useRoute();
watch(() => route.fullPath, () => (open.value = false));
</script>

<template>
    <header class="sticky top-0 z-40 border-b border-white/10 bg-night/95 backdrop-blur">
        <div class="wrap flex h-[4.5rem] items-center justify-between gap-6">
            <RouterLink to="/" class="flex items-center gap-2.5 font-display text-xl font-bold text-white">
                <span class="grid size-9 place-items-center rounded-lg bg-sun text-night" aria-hidden="true">
                    {{ site.name.charAt(0) }}
                </span>
                {{ site.name }}
            </RouterLink>

            <nav class="hidden items-center gap-8 md:flex" aria-label="Main">
                <RouterLink
                    v-for="link in links"
                    :key="link.to"
                    :to="link.to"
                    class="font-medium text-white/75 hover:text-white"
                    active-class="text-white! underline decoration-sun decoration-[3px] underline-offset-8"
                >
                    {{ link.label }}
                </RouterLink>
                <RouterLink to="/contact" class="btn btn-sun py-2.5!">Get a free quote</RouterLink>
            </nav>

            <button
                type="button"
                class="grid size-11 place-items-center rounded-lg border border-white/25 text-white md:hidden"
                :aria-expanded="open"
                aria-controls="mobile-menu"
                @click="open = !open"
            >
                <span class="sr-only">{{ open ? 'Close menu' : 'Open menu' }}</span>
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path v-if="open" d="M6 6l12 12M18 6L6 18" />
                    <path v-else d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>

        <nav v-show="open" id="mobile-menu" class="border-t border-white/10 bg-night md:hidden" aria-label="Mobile">
            <div class="wrap flex flex-col py-3">
                <RouterLink
                    v-for="link in links"
                    :key="link.to"
                    :to="link.to"
                    class="border-b border-white/10 py-3.5 text-lg font-medium text-white"
                >
                    {{ link.label }}
                </RouterLink>
                <RouterLink to="/contact" class="btn btn-sun my-4">Get a free quote</RouterLink>
            </div>
        </nav>
    </header>
</template>
