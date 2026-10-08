<script setup>
import { computed } from 'vue';
import { site, whatsappLink } from '../lib/site';
import { content } from '../lib/api';

const year = new Date().getFullYear();
const half = computed(() => Math.ceil(content.services.length / 2));
</script>

<template>
    <footer class="band-night">
        <div class="wrap grid gap-12 py-16 md:grid-cols-[1.3fr_2fr_1.2fr]">
            <div>
                <p class="flex items-center gap-2.5 font-display text-2xl font-bold">
                    <span class="grid size-10 place-items-center rounded-lg bg-sun text-night" aria-hidden="true">{{ site.name.charAt(0) }}</span>
                    {{ site.name }}
                </p>
                <p class="mt-4 max-w-xs text-white/70">{{ site.tagline }}</p>
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-sun mt-6">Chat on WhatsApp</a>
            </div>

            <div>
                <h2 class="font-sans text-base font-bold tracking-normal text-mint!">Services</h2>
                <div class="mt-4 grid gap-x-8 gap-y-2.5 sm:grid-cols-2">
                    <ul v-for="(column, index) in [content.services.slice(0, half), content.services.slice(half)]" :key="index" class="space-y-2.5">
                        <li v-for="service in column" :key="service.slug">
                            <RouterLink :to="`/services/${service.slug}`" class="text-white/80 hover:text-sun">
                                {{ service.title }}
                            </RouterLink>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <h2 class="font-sans text-base font-bold tracking-normal text-mint!">Contact</h2>
                <ul class="mt-4 space-y-2.5 text-white/80">
                    <li><a :href="`tel:${site.phone.replace(/\s/g, '')}`" class="hover:text-sun">{{ site.phone }}</a></li>
                    <li><a :href="`mailto:${site.email}`" class="hover:text-sun">{{ site.email }}</a></li>
                    <li>{{ site.address }}</li>
                    <li>{{ site.hours }}</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10">
            <div class="wrap flex flex-col gap-3 py-6 text-sm text-white/60 sm:flex-row sm:justify-between">
                <p>© {{ year }} {{ site.name }}. All rights reserved.</p>
                <nav class="flex flex-wrap gap-6" aria-label="Footer">
                    <RouterLink to="/portfolio" class="hover:text-white">Portfolio</RouterLink>
                    <RouterLink to="/pricing" class="hover:text-white">Pricing</RouterLink>
                    <RouterLink to="/about" class="hover:text-white">About</RouterLink>
                    <RouterLink to="/contact" class="hover:text-white">Contact</RouterLink>
                </nav>
            </div>
        </div>
    </footer>
</template>
