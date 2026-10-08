<script setup>
import { computed, ref } from 'vue';
import { content } from '../lib/api';
import { formatPKR } from '../lib/site';

// Visitors tick what they need and see a starting price before they talk to anyone.
const picked = ref([]);

const total = computed(() =>
    content.services.filter((s) => picked.value.includes(s.slug)).reduce((sum, s) => sum + s.starting_price, 0),
);

const quoteLink = computed(() => ({
    path: '/contact',
    query: picked.value.length ? { services: picked.value.join(',') } : {},
}));
</script>

<template>
    <div class="rounded-3xl border border-white/10 bg-white p-6 text-body shadow-[0_40px_80px_-30px_rgba(0,0,0,0.6)] sm:p-8">
        <h2 class="text-2xl text-ink!">What do you need?</h2>
        <p class="mt-1.5">Pick one or more. The price updates as you go.</p>

        <fieldset class="mt-6">
            <legend class="sr-only">Services</legend>
            <div v-if="content.ready" class="flex flex-wrap gap-2">
                <label
                    v-for="service in content.services"
                    :key="service.slug"
                    class="cursor-pointer rounded-full border px-3.5 py-2 text-[0.95rem] font-medium transition-colors has-[:focus-visible]:outline-3 has-[:focus-visible]:outline-accent"
                    :class="picked.includes(service.slug)
                        ? 'border-accent bg-accent text-white'
                        : 'border-line bg-white text-body hover:border-accent hover:bg-accent-soft'"
                >
                    <input v-model="picked" type="checkbox" :value="service.slug" class="sr-only" />
                    {{ service.title }}
                </label>
            </div>
            <p v-else class="text-muted">Loading services…</p>
        </fieldset>

        <div class="mt-7 rounded-2xl bg-night p-5 text-white" aria-live="polite">
            <p class="text-sm text-white/65">{{ picked.length ? 'Starting from' : 'Nothing picked yet' }}</p>
            <p class="font-display text-4xl font-extrabold tabular-nums text-sun">
                {{ picked.length ? formatPKR(total) : 'PKR 0' }}
            </p>
            <p class="mt-2 text-xs text-white/60">Starting prices added together. Your exact quote depends on scope.</p>
        </div>

        <RouterLink :to="quoteLink" class="btn btn-primary mt-5 w-full">
            {{ picked.length ? 'Get a quote for these' : 'Get a free quote' }}
        </RouterLink>
    </div>
</template>
