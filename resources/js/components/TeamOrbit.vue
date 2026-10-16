<script setup>
import { team } from '../lib/site';

// First person is the centre; everyone else is spaced evenly around the circle.
const [lead, ...members] = team;
const RADIUS = 39; // % of the circle's width

const spot = (index) => {
    const angle = (index / members.length) * 2 * Math.PI - Math.PI / 2;
    return {
        left: `${50 + RADIUS * Math.cos(angle)}%`,
        top: `${50 + RADIUS * Math.sin(angle)}%`,
    };
};
</script>

<template>
    <section v-if="lead" class="section overflow-hidden border-t border-line bg-white" aria-labelledby="team-heading">
        <div class="wrap">
            <div v-reveal="'down'" class="mx-auto max-w-2xl text-center">
                <h2 id="team-heading" class="h-section">Meet our team</h2>
                <p class="mt-3 text-lg text-body">Real people who will work on your project — from planning to design, website, video and ads.</p>
            </div>

            <!-- Phones: a simple grid -->
            <div class="mt-12 md:hidden">
                <figure v-reveal="'zoom'" class="text-center">
                    <img :src="lead.photo" :alt="lead.name" width="400" height="400" loading="lazy" class="mx-auto size-36 rounded-full border-4 border-white object-cover ring-4 ring-accent" />
                    <figcaption class="mt-3">
                        <span class="block font-display text-xl font-bold text-ink">{{ lead.name }}</span>
                        <span class="text-sm font-semibold text-accent">{{ lead.role }}</span>
                    </figcaption>
                </figure>
                <ul class="mt-10 grid grid-cols-2 gap-x-4 gap-y-8">
                    <li v-for="(member, i) in members" :key="member.name" v-reveal="{ dir: i % 2 ? 'right' : 'left', delay: i * 80 }" class="text-center">
                        <img :src="member.photo" :alt="member.name" width="400" height="400" loading="lazy" class="mx-auto size-24 rounded-full border-4 border-white object-cover ring-2 ring-accent" />
                        <span class="mt-3 block font-bold text-ink">{{ member.name }}</span>
                        <span class="text-sm text-muted">{{ member.role }}</span>
                    </li>
                </ul>
            </div>

            <!-- Tablets and up: the moving circle. It pauses when you hover it. -->
            <div v-reveal="'zoom'" class="orbit relative mx-auto mb-14 mt-14 hidden aspect-square w-full max-w-[40rem] md:block">
                <span class="absolute inset-0 rounded-full border border-line" aria-hidden="true"></span>
                <span class="absolute inset-[11%] rounded-full border border-dashed border-accent/40" aria-hidden="true"></span>
                <span class="absolute inset-[26%] rounded-full bg-accent-soft/60" aria-hidden="true"></span>

                <figure class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
                    <img :src="lead.photo" :alt="lead.name" width="400" height="400" loading="lazy" class="mx-auto size-40 rounded-full border-4 border-white object-cover shadow-xl ring-4 ring-accent" />
                    <figcaption class="mt-3">
                        <span class="block font-display text-xl font-bold text-ink">{{ lead.name }}</span>
                        <span class="text-sm font-bold text-accent">{{ lead.role }}</span>
                    </figcaption>
                </figure>

                <ul class="orbit-ring absolute inset-0">
                    <li
                        v-for="(member, index) in members"
                        :key="member.name"
                        class="absolute size-24 -translate-x-1/2 -translate-y-1/2"
                        :style="spot(index)"
                    >
                        <div class="orbit-upright relative size-full">
                            <img :src="member.photo" :alt="member.name" width="400" height="400" loading="lazy" class="size-full rounded-full border-4 border-white object-cover shadow-lg ring-2 ring-accent" />
                            <div class="absolute left-1/2 top-full mt-2 w-40 -translate-x-1/2 text-center leading-tight">
                                <span class="block text-[0.95rem] font-bold text-ink">{{ member.name }}</span>
                                <span class="text-xs font-semibold text-muted">{{ member.role }}</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>
