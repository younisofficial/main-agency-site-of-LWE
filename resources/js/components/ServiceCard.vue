<script setup>
import ServiceIcon from './ServiceIcon.vue';
import { categoryLabel } from '../lib/site';

defineProps({ service: { type: Object, required: true } });
</script>

<template>
    <RouterLink
        :to="`/services/${service.slug}`"
        class="card-lift group relative flex flex-col overflow-hidden rounded-2xl border border-line bg-white p-6"
        :class="`tone-${service.category}`"
    >
        <span class="absolute inset-x-0 top-0 h-1 bg-[var(--tone)]" aria-hidden="true"></span>

        <span class="flex items-center justify-between">
            <span class="grid size-14 place-items-center rounded-2xl bg-[var(--tone-soft)] text-[var(--tone)] transition-colors duration-300 group-hover:bg-[var(--tone)] group-hover:text-white">
                <ServiceIcon :name="service.icon" class="size-7" />
            </span>
            <span class="rounded-full bg-[var(--tone-soft)] px-3 py-1 text-xs font-bold text-[var(--tone)]">
                {{ categoryLabel(service.category) }}
            </span>
        </span>

        <span class="mt-5 block font-display text-xl font-bold text-ink">{{ service.title }}</span>
        <span class="mt-2 block grow text-[0.95rem] leading-relaxed text-body">{{ service.summary }}</span>

        <span class="mt-6 flex items-center justify-between border-t border-line pt-4">
            <span class="text-sm font-bold text-[var(--tone)]">See details</span>
            <span class="grid size-10 place-items-center rounded-full bg-surface text-ink transition-all duration-300 group-hover:translate-x-1 group-hover:bg-[var(--tone)] group-hover:text-white" aria-hidden="true">
                <svg viewBox="0 0 20 20" class="size-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 10h10M11 6l4 4-4 4" />
                </svg>
            </span>
        </span>
    </RouterLink>
</template>
