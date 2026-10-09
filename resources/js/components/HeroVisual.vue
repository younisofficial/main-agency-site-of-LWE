<script setup>
import { site } from "../lib/site";

// The photo path is set in config/agency.php → 'hero_photo'.
// A normal photo fills the frame; an SVG illustration or a transparent PNG
// cut-out ("-cutout.png") sits on the coloured background instead.
const photo = site.hero_photo || "/images/ceo-lwe.webp";
const isCutout = /\.svg$|-cutout\.png$/i.test(photo);

const badges = [
    {
        label: "Business websites",
        tone: "development",
        position: "-left-4 top-10 sm:-left-10",
        motion: "float",
    },
    {
        label: "Logo & video",
        tone: "design",
        position: "-right-3 top-1/3 sm:-right-8",
        motion: "float-slow",
    },
    {
        label: "Facebook & Google ads",
        tone: "marketing",
        position: "bottom-10 -left-2 sm:-left-12",
        motion: "float-slow",
    },
];
</script>

<template>
    <div class="relative mx-auto w-full max-w-[26rem]">
        <span
            class="absolute -right-5 -top-5 size-28 rounded-3xl border-2 border-sun/70"
            aria-hidden="true"
        ></span>
        <span
            class="absolute -bottom-6 -left-6 size-36 rounded-full bg-sun/20 blur-2xl"
            aria-hidden="true"
        ></span>

        <!-- Real photo: fills the frame edge to edge, with a thin gradient border -->
        <div
            v-if="!isCutout"
            class="relative rounded-[2.5rem] bg-gradient-to-br from-mint via-accent to-sun p-1.5 shadow-[0_40px_80px_-30px_rgba(0,0,0,0.7)]"
        >
            <img
                :src="photo"
                :alt="`${site.name} founder`"
                width="900"
                height="1125"
                fetchpriority="high"
                decoding="async"
                class="block aspect-[4/5] w-full rounded-[2.2rem] object-cover object-top"
            />
        </div>

        <!-- Illustration or transparent cut-out: sits on a coloured background -->
        <div
            v-else
            class="relative overflow-hidden rounded-[2.5rem] border border-white/15 bg-gradient-to-b from-mint to-accent shadow-[0_40px_80px_-30px_rgba(0,0,0,0.7)]"
        >
            <span
                class="absolute left-1/2 top-10 size-72 -translate-x-1/2 rounded-full bg-white/25"
                aria-hidden="true"
            ></span>
            <img
                :src="photo"
                :alt="`${site.name} founder`"
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
            <span
                class="size-2.5 rounded-full bg-[var(--tone)]"
                aria-hidden="true"
            ></span>
            {{ badge.label }}
        </span>
    </div>
</template>
