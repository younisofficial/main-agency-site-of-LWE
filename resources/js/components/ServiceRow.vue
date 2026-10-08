<script setup>
import ServiceIcon from './ServiceIcon.vue';
import { formatPKR } from '../lib/site';

defineProps({ service: { type: Object, required: true } });
</script>

<template>
    <RouterLink
        :to="`/services/${service.slug}`"
        class="group flex gap-4 border-t border-line py-5 transition-colors hover:border-accent"
    >
        <span class="grid size-11 shrink-0 place-items-center rounded-lg bg-accent-soft text-accent transition-colors group-hover:bg-accent group-hover:text-white">
            <ServiceIcon :name="service.icon" class="size-6" />
        </span>
        <span class="min-w-0">
            <span class="block text-lg font-semibold leading-snug text-ink group-hover:text-accent">{{ service.title }}</span>
            <span class="mt-1 block text-[0.95rem] leading-normal text-body">{{ service.summary }}</span>
            <span class="mt-2 block text-sm font-semibold text-accent">From {{ formatPKR(service.starting_price) }}</span>
        </span>
    </RouterLink>
</template>
