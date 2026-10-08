<script setup>
import { site } from '../lib/site';

// Hero picture. Replace public/images/hero-person.svg with a real photo
// (a PNG with a transparent background, about 800x840, looks best).
// Kept as a variable so Vite serves it from /public instead of trying to import it.
const photo = '/images/hero-person.svg';

const badges = [
    { label: 'Web development', tone: 'development', position: '-left-4 top-10 sm:-left-10', motion: 'float' },
    { label: 'UX/UI design', tone: 'design', position: '-right-3 top-1/3 sm:-right-8', motion: 'float-slow' },
    { label: 'SEO and marketing', tone: 'marketing', position: 'bottom-10 -left-2 sm:-left-12', motion: 'float-slow' },
];
</script>

<template>
    <div class="relative mx-auto w-full max-w-[26rem]">
        <span class="absolute -right-5 -top-5 size-28 rounded-3xl border-2 border-sun/70" aria-hidden="true"></span>
        <span class="absolute -bottom-6 -left-6 size-36 rounded-full bg-sun/20 blur-2xl" aria-hidden="true"></span>

        <div class="relative overflow-hidden rounded-[2.5rem] border border-white/15 bg-gradient-to-b from-mint to-accent shadow-[0_40px_80px_-30px_rgba(0,0,0,0.7)]">
            <span class="absolute left-1/2 top-10 size-72 -translate-x-1/2 rounded-full bg-white/25" aria-hidden="true"></span>
            <img
                :src="photo"
                :alt="`A member of the ${site.name} team`"
                width="400"
                height="420"
                fetchpriority="high"
                class="relative mx-auto mt-10 block w-[88%]"
            />
        </div>

        <span
            v-for="badge in badges"
            :key="badge.label"
            class="absolute flex items-center gap-2.5 rounded-2xl bg-white px-4 py-3 text-sm font-bold text-ink shadow-[0_18px_40px_-14px_rgba(0,0,0,0.55)]"
            :class="[badge.position, badge.motion, `tone-${badge.tone}`]"
        >
            <span class="size-2.5 rounded-full bg-[var(--tone)]" aria-hidden="true"></span>
            {{ badge.label }}
        </span>
    </div>
</template>
