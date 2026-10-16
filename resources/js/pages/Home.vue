<script setup>
import { computed } from 'vue';
import HeroVisual from '../components/HeroVisual.vue';
import ServiceGrid from '../components/ServiceGrid.vue';
import ServiceIcon from '../components/ServiceIcon.vue';
import ProjectCard from '../components/ProjectCard.vue';
import NextSteps from '../components/NextSteps.vue';
import CallToAction from '../components/CallToAction.vue';
import TeamOrbit from '../components/TeamOrbit.vue';
import ChatIcon from '../components/ChatIcon.vue';
import { content } from '../lib/api';
import { planGroups, whatsappLink } from '../lib/site';
import { cycle } from '../lib/reveal';

const promises = ['Prices in PKR', 'Fast delivery', 'Free advice on WhatsApp'];

// Only our own projects go in "Recent work" (examples from the market are not shown here).
const featured = computed(() =>
    content.projects
        .filter((p) => !p.kind || p.kind === 'project')
        .sort((a, b) => Number(b.is_featured) - Number(a.is_featured))
        .slice(0, 3),
);
</script>

<template>
    <section class="band-light overflow-hidden">
        <div class="wrap grid items-center gap-16 py-14 lg:grid-cols-[1.2fr_1fr] lg:py-24">
            <div>
                <p v-reveal="'down'" class="inline-flex items-center gap-2 rounded-full border border-accent/25 bg-accent-soft px-4 py-1.5 text-sm font-bold text-accent-strong">
                    <span class="size-2 rounded-full bg-accent" aria-hidden="true"></span>
                    Web design agency in Multan, Pakistan
                </p>
                <h1 v-reveal="'left'" class="mt-6 text-[2.5rem] font-extrabold sm:text-6xl lg:text-[4rem]">
                    Websites that bring you <span class="text-glow">more customers.</span>
                </h1>
                <p v-reveal="{ dir: 'left', delay: 120 }" class="mt-6 max-w-xl text-xl text-body">
                    Websites, logos, videos and Facebook ads for shops, schools, restaurants, pharmacies, real estate and more. Simple work, clear prices, fast delivery.
                </p>
                <div v-reveal="{ dir: 'up', delay: 220 }" class="mt-9 flex flex-wrap gap-3">
                    <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg">
                        <ChatIcon class="size-6" /> WhatsApp us
                    </a>
                    <RouterLink to="/pricing" class="btn btn-sun btn-lg">See our prices</RouterLink>
                </div>
                <ul v-reveal="{ dir: 'up', delay: 320 }" class="mt-10 flex flex-wrap gap-x-7 gap-y-3 text-[0.95rem] font-semibold text-ink">
                    <li v-for="promise in promises" :key="promise" class="flex items-center gap-2">
                        <svg viewBox="0 0 20 20" class="size-5 text-accent" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 10.5l4 4 8-9" />
                        </svg>
                        {{ promise }}
                    </li>
                </ul>
            </div>
            <HeroVisual />
        </div>
    </section>

    <!-- Pick your type of business → goes straight to its 3 packages -->
    <section class="section">
        <div class="wrap">
            <h2 v-reveal class="h-section">What is your business?</h2>
            <p v-reveal="{ dir: 'up', delay: 80 }" class="lead mb-8 mt-3">Tap it to see 3 simple packages and prices.</p>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                <RouterLink
                    v-for="(item, i) in planGroups"
                    :key="item.key"
                    v-reveal="cycle(i, 80)"
                    :to="{ path: '/pricing', query: { type: item.key }, hash: '#packages' }"
                    class="card-lift group flex flex-col gap-3 rounded-2xl border-2 border-line bg-white p-5"
                >
                    <span class="grid size-14 place-items-center rounded-2xl bg-accent-soft text-accent transition-colors group-hover:bg-accent group-hover:text-white">
                        <ServiceIcon :name="item.icon" class="size-8" />
                    </span>
                    <span class="font-display text-lg font-bold leading-tight text-ink">{{ item.short }}</span>
                    <span class="text-sm font-bold text-accent">See packages →</span>
                </RouterLink>
                <a
                    v-reveal="cycle(planGroups.length, 80)"
                    :href="whatsappLink('Assalam o Alaikum! My business is: ')"
                    target="_blank"
                    rel="noopener"
                    class="card-lift flex flex-col justify-between gap-3 rounded-2xl bg-accent p-5 text-white"
                >
                    <span class="font-display text-lg font-bold leading-tight">Something else?</span>
                    <span class="text-sm text-white/90">Tell us your business on WhatsApp.</span>
                    <span class="flex items-center gap-2 text-sm font-bold"><ChatIcon class="size-5" /> Ask us</span>
                </a>
            </div>
        </div>
    </section>

    <section class="section border-t border-line bg-surface">
        <div class="wrap">
            <h2 v-reveal="'left'" class="h-section">What we do</h2>
            <p v-reveal="{ dir: 'left', delay: 80 }" class="lead mb-8 mt-3">Choose a service to see what you get and how long it takes.</p>
            <ServiceGrid />
        </div>
    </section>

    <NextSteps />

    <section class="section border-b border-line">
        <div class="wrap">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <div v-reveal="'left'">
                    <h2 class="h-section">Recent work</h2>
                    <p class="lead mt-3">Some of the websites our team has made.</p>
                </div>
                <RouterLink v-reveal="'right'" to="/portfolio" class="btn btn-outline">See all our work</RouterLink>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <ProjectCard v-for="(project, i) in featured" :key="project.id" v-reveal="cycle(i)" :project="project" />
            </div>
        </div>
    </section>

    <TeamOrbit />

    <CallToAction />
</template>
