<script setup>
import { computed } from 'vue';
import HeroVisual from '../components/HeroVisual.vue';
import ServiceGrid from '../components/ServiceGrid.vue';
import ProjectCard from '../components/ProjectCard.vue';
import NextSteps from '../components/NextSteps.vue';
import CallToAction from '../components/CallToAction.vue';
import TeamOrbit from '../components/TeamOrbit.vue';
import ChatIcon from '../components/ChatIcon.vue';
import { content } from '../lib/api';
import { whatsappLink } from '../lib/site';

const promises = ['Prices in PKR', '50% advance, 50% on delivery', 'Free advice on WhatsApp'];

const featured = computed(() =>
    [...content.projects].sort((a, b) => Number(b.is_featured) - Number(a.is_featured)).slice(0, 3),
);
</script>

<template>
    <section class="band-night">
        <div class="wrap grid items-center gap-16 py-16 lg:grid-cols-[1.2fr_1fr] lg:py-24">
            <div>
                <p class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-1.5 text-sm font-semibold text-mint">
                    <span class="size-2 rounded-full bg-sun" aria-hidden="true"></span>
                    Websites for businesses and schools in Pakistan
                </p>
                <h1 class="mt-6 text-[2.5rem] font-extrabold sm:text-6xl lg:text-[4rem]">
                    Websites that bring you <span class="text-glow">more customers.</span>
                </h1>
                <p class="mt-6 max-w-xl text-xl text-white/80">
                    We make websites, logos, videos and Facebook ads for your business or school. Simple work, clear prices.
                </p>
                <div class="mt-9 flex flex-wrap gap-3">
                    <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg">
                        <ChatIcon class="size-6" /> WhatsApp us
                    </a>
                    <RouterLink to="/pricing" class="btn btn-sun btn-lg">See our prices</RouterLink>
                </div>
                <ul class="mt-10 flex flex-wrap gap-x-7 gap-y-3 text-[0.95rem] font-medium text-white/85">
                    <li v-for="promise in promises" :key="promise" class="flex items-center gap-2">
                        <svg viewBox="0 0 20 20" class="size-5 text-mint" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 10.5l4 4 8-9" />
                        </svg>
                        {{ promise }}
                    </li>
                </ul>
            </div>
            <HeroVisual />
        </div>
    </section>

    <section class="section">
        <div class="wrap">
            <h2 class="h-section">What we do</h2>
            <p class="lead mb-8 mt-3">Choose a service to see what you get and how long it takes.</p>
            <ServiceGrid />
        </div>
    </section>

    <NextSteps />

    <section class="section border-b border-line bg-surface">
        <div class="wrap">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <div>
                    <h2 class="h-section">Recent work</h2>
                    <p class="lead mt-3">Some of the websites our team has made.</p>
                </div>
                <RouterLink to="/portfolio" class="btn btn-outline">See all our work</RouterLink>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <ProjectCard v-for="project in featured" :key="project.id" :project="project" />
            </div>
        </div>
    </section>

    <TeamOrbit />

    <CallToAction />
</template>
