<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';
import { site } from '../lib/site';

// The photo path is set in config/agency.php → 'hero_photo'.
// A normal photo fills the frame; an SVG illustration or a transparent PNG
// cut-out ("-cutout.png") sits on the coloured background instead.
const photo = site.hero_photo || '/images/ceo-lwe.webp';
const isCutout = /\.svg$|-cutout\.png$/i.test(photo);

const badges = [
    { label: 'Business websites', tone: 'development', position: '-left-4 top-10 sm:-left-10', motion: 'float' },
    { label: 'Logo & video', tone: 'design', position: '-right-3 top-1/3 sm:-right-8', motion: 'float-slow' },
    { label: 'Facebook & Google ads', tone: 'marketing', position: 'bottom-10 -left-2 sm:-left-12', motion: 'float-slow' },
];

// The photo and badges move a little with the mouse (desktop only).
const root = ref(null);
function onMove(event) {
    if (!root.value) return;
    const x = event.clientX / window.innerWidth - 0.5;
    const y = event.clientY / window.innerHeight - 0.5;
    root.value.style.setProperty('--mx', x.toFixed(3));
    root.value.style.setProperty('--my', y.toFixed(3));
}
onMounted(() => window.addEventListener('mousemove', onMove, { passive: true }));
onBeforeUnmount(() => window.removeEventListener('mousemove', onMove));
</script>

<template>
    <div ref="root" v-reveal="'right'" class="relative mx-auto w-full max-w-[26rem]">
        <span class="parallax-back absolute -right-5 -top-5 size-28 rounded-3xl border-2 border-accent/50" aria-hidden="true"></span>
        <span class="parallax-back absolute -bottom-6 -left-6 size-36 rounded-full bg-sky/20 blur-2xl" aria-hidden="true"></span>

        <div class="parallax">
            <!-- Real photo: fills the frame edge to edge, with a thin gradient border -->
            <div
                v-if="!isCutout"
                class="relative rounded-[2.5rem] bg-gradient-to-br from-accent via-mint to-sky p-1.5 shadow-[0_40px_80px_-30px_rgba(15,23,42,0.55)]"
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
            <div v-else class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-b from-accent-soft to-accent shadow-[0_40px_80px_-30px_rgba(15,23,42,0.55)]">
                <img :src="photo" :alt="`${site.name} founder`" width="400" height="420" fetchpriority="high" class="relative mx-auto mt-10 block w-[88%]" />
            </div>
        </div>

        <span
            v-for="badge in badges"
            :key="badge.label"
            class="parallax-back absolute"
            :class="badge.position"
        >
            <span
                class="flex items-center gap-2.5 rounded-2xl border border-line bg-white px-4 py-3 text-sm font-bold text-ink shadow-[0_18px_40px_-14px_rgba(15,23,42,0.4)]"
                :class="[badge.motion, `tone-${badge.tone}`]"
            >
                <span class="size-2.5 rounded-full bg-[var(--tone)]" aria-hidden="true"></span>
                {{ badge.label }}
            </span>
        </span>
    </div>
</template>
