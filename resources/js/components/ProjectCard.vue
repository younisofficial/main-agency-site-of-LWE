<script setup>
import { categoryLabel } from '../lib/site';

defineProps({ project: { type: Object, required: true } });
</script>

<template>
    <!-- Becomes a link to the live site when the project has a url. -->
    <component
        :is="project.url ? 'a' : 'article'"
        :href="project.url || undefined"
        :target="project.url ? '_blank' : undefined"
        :rel="project.url ? 'noopener' : undefined"
        class="card-lift group block overflow-hidden rounded-2xl border border-line bg-white"
        :class="`tone-${project.category}`"
    >
        <span class="relative block aspect-[4/3] overflow-hidden bg-surface">
            <img
                :src="project.image"
                :alt="`${project.title} preview`"
                width="1200"
                height="900"
                loading="lazy"
                class="size-full object-cover transition-transform duration-500 group-hover:scale-105"
            />
            <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1 text-xs font-bold text-[var(--tone)] shadow">
                {{ categoryLabel(project.category) }}
            </span>
            <span
                v-if="project.url"
                class="absolute bottom-4 right-4 flex translate-y-2 items-center gap-1.5 rounded-full bg-night px-4 py-2 text-sm font-semibold text-white opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100 group-focus-visible:translate-y-0 group-focus-visible:opacity-100"
            >
                Visit site
                <svg viewBox="0 0 20 20" class="size-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M7 13l6-6M8 7h5v5" />
                </svg>
            </span>
        </span>

        <span class="block p-6">
            <span v-if="project.client" class="block text-sm font-semibold text-muted">{{ project.client }}</span>
            <span class="mt-0.5 block font-display text-xl font-bold text-ink">{{ project.title }}</span>
            <span class="mt-1.5 block text-[0.95rem] leading-relaxed text-body">{{ project.summary }}</span>
            <span class="mt-4 flex flex-wrap gap-2">
                <span v-for="tag in project.tags" :key="tag" class="rounded-full bg-surface px-3 py-1 text-xs font-semibold text-body">
                    {{ tag }}
                </span>
            </span>
        </span>
    </component>
</template>
