<script setup>
import { computed } from 'vue';
import HeroVisual from '../components/HeroVisual.vue';
import ServiceGrid from '../components/ServiceGrid.vue';
import ProjectCard from '../components/ProjectCard.vue';
import CallToAction from '../components/CallToAction.vue';
import TeamOrbit from '../components/TeamOrbit.vue';
import { content } from '../lib/api';

const promises = ['Fixed written quotes', 'Reply in one working day', 'You own all the files'];

const steps = [
    { title: 'Tell us what you need', text: 'A short call or a WhatsApp message. We ask about your business, your customers and your deadline.' },
    { title: 'Get a fixed quote', text: 'Within one working day you have a written scope, a timeline and a price. No hourly surprises.' },
    { title: 'Review as we build', text: 'You see designs and working pages every week and ask for changes while they are still easy to make.' },
    { title: 'Launch with support', text: 'We put it live, train your team and stay on call after launch.' },
];

// Homepage shows featured projects first, three in total.
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
                    Web, design and marketing agency
                </p>
                <h1 class="mt-6 text-[2.6rem] font-extrabold sm:text-6xl lg:text-[4.3rem]">
                    One agency to build it, design it and <span class="text-glow">get it found.</span>
                </h1>
                <p class="mt-6 max-w-xl text-lg text-white/75">
                    Websites, apps, branding, SEO and ads from a single team that plans, builds and grows your business online.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <RouterLink to="/contact" class="btn btn-sun">Get a free quote</RouterLink>
                    <RouterLink to="/portfolio" class="btn btn-ghost">See our work</RouterLink>
                </div>
                <ul class="mt-10 flex flex-wrap gap-x-7 gap-y-3 text-[0.95rem] font-medium text-white/80">
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
            <h2 class="h-section">Ten services, three teams.</h2>
            <p class="lead mb-8 mt-3">Hire us for one thing or for all of it. Each service comes with a clear list of what you get.</p>
            <ServiceGrid />
        </div>
    </section>

    <section class="section border-y border-line bg-surface">
        <div class="wrap">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <div>
                    <h2 class="h-section">Recent work</h2>
                    <p class="lead mt-3">A few of the sites, designs and campaigns we have delivered.</p>
                </div>
                <RouterLink to="/portfolio" class="btn btn-outline">See all projects</RouterLink>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <ProjectCard v-for="project in featured" :key="project.id" :project="project" />
            </div>
        </div>
    </section>

    <section class="band-night section">
        <div class="wrap">
            <h2 class="h-section">How a project runs</h2>
            <ol class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <li v-for="(step, index) in steps" :key="step.title" class="rounded-2xl border border-white/10 bg-white/5 p-6">
                    <span class="text-glow font-display text-5xl font-extrabold" aria-hidden="true">0{{ index + 1 }}</span>
                    <h3 class="mt-4 text-xl">{{ step.title }}</h3>
                    <p class="mt-2 text-white/70">{{ step.text }}</p>
                </li>
            </ol>
        </div>
    </section>

    <CallToAction />

    <TeamOrbit />
</template>
