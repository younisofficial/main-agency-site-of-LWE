<script setup>
import { computed, ref } from 'vue';

const props = defineProps({ project: { type: Object, required: true } });

// A project with an .mp4 url shows a video player; other urls make the card a link.
const isVideo = computed(() => /\.mp4$/i.test(props.project.url || ''));
const link = computed(() => (isVideo.value ? null : props.project.url));
const isSample = computed(() => props.project.kind === 'concept');

// If an image file is missing on the server, hide the whole card instead of showing a broken picture.
const broken = ref(false);
</script>

<template>
    <!-- Becomes a link to the live site when the project has a url. -->
    <component
        :is="link ? 'a' : 'article'"
        v-if="!broken"
        :href="link || undefined"
        :target="link ? '_blank' : undefined"
        :rel="link ? 'noopener' : undefined"
        class="card-lift group block overflow-hidden rounded-2xl border border-line bg-white"
        :class="`tone-${project.category}`"
    >
        <span v-if="isVideo" class="relative block aspect-[9/16] overflow-hidden bg-night">
            <video
                :poster="project.image"
                controls
                muted
                playsinline
                loop
                preload="metadata"
                class="size-full object-cover"
                :aria-label="`${project.title} video`"
>
                <!-- WebM plays everywhere; the .mp4 is the fallback for older iPhones. -->
                <source :src="project.url.replace(/\.mp4$/i, '.webm')" type="video/webm" />
                <source :src="project.url" type="video/mp4" />
            </video>
        </span>
        <span v-else class="relative block overflow-hidden bg-surface" :class="isSample ? 'aspect-square' : 'aspect-[2/1]'">
            <img
                :src="project.image"
                :alt="`${project.title} preview`"
                width="1300"
                height="650"
                loading="lazy"
                @error="broken = true"
                class="size-full transition-transform duration-500 group-hover:scale-105"
                :class="isSample ? 'object-contain' : 'object-cover object-top'"
            />
            <span
                v-if="link"
                class="absolute bottom-4 right-4 flex translate-y-2 items-center gap-1.5 rounded-full bg-night px-4 py-2 text-sm font-semibold text-white opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100 group-focus-visible:translate-y-0 group-focus-visible:opacity-100"
            >
                Visit site
                <svg viewBox="0 0 20 20" class="size-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M7 13l6-6M8 7h5v5" />
                </svg>
            </span>
        </span>

        <span class="block p-6">
            <span v-if="isSample" class="mb-2 inline-block rounded-full bg-accent-soft px-3 py-1 text-xs font-bold text-accent-strong">
                Sample work (concept) — not a client project
            </span>
            <span v-if="project.kind === 'example'" class="mb-2 inline-block rounded-full bg-sun/25 px-3 py-1 text-xs font-bold text-ink">
                Example from the market — not our project
            </span>
            <span v-if="project.client" class="block text-sm font-semibold text-muted">{{ project.client }}</span>
            <span class="mt-0.5 block font-display text-xl font-bold text-ink">{{ project.title }}</span>
            <span class="mt-1.5 block text-[0.95rem] leading-relaxed text-body">{{ project.summary }}</span>
            <span v-if="project.kind === 'example'" class="mt-2 block text-[0.95rem] font-semibold text-accent">We can make a website like this for you.</span>
            <span v-if="project.tags?.length" class="mt-4 flex flex-wrap gap-2">
                <span v-for="tag in project.tags" :key="tag" class="rounded-full bg-surface px-3 py-1 text-xs font-semibold text-body">
                    {{ tag }}
                </span>
            </span>
        </span>
    </component>
</template>
