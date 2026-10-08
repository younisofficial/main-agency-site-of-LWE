<script setup>
import { categories } from '../lib/site';

// Pill tabs: "All" plus the three groups. Used by services, portfolio and pricing.
defineProps({
    allLabel: { type: String, default: '' }, // leave empty to hide the "All" tab
    label: { type: String, required: true },
});
const active = defineModel({ type: String, required: true });
</script>

<template>
    <div class="inline-flex w-fit max-w-full flex-wrap gap-1 rounded-3xl border border-line bg-white p-1.5" role="group" :aria-label="label">
        <button
            v-for="tab in [...(allLabel ? [{ key: 'all', label: allLabel }] : []), ...categories]"
            :key="tab.key"
            type="button"
            :aria-pressed="active === tab.key"
            class="cursor-pointer rounded-full px-5 py-2.5 text-[0.95rem] font-semibold transition-colors"
            :class="active === tab.key ? 'bg-night text-white shadow-lg' : 'text-body hover:bg-surface hover:text-ink'"
            @click="active = tab.key"
        >
            {{ tab.label }}
        </button>
    </div>
</template>
