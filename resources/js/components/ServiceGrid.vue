<script setup>
import { computed, ref } from 'vue';
import ServiceCard from './ServiceCard.vue';
import FilterTabs from './FilterTabs.vue';
import LoadState from './LoadState.vue';
import { content } from '../lib/api';

const filter = ref('all');
const shown = computed(() =>
    filter.value === 'all' ? content.services : content.services.filter((s) => s.category === filter.value),
);
</script>

<template>
    <div>
        <FilterTabs v-model="filter" all-label="All services" label="Filter services" />

        <div class="mt-8">
            <LoadState what="services">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <ServiceCard v-for="service in shown" :key="service.slug" :service="service" />

                    <div class="band-night flex flex-col justify-between gap-6 rounded-2xl p-7 sm:col-span-2 lg:flex-row lg:items-center">
                        <div>
                            <h3 class="text-2xl">Need something that is not listed?</h3>
                            <p class="mt-2 text-white/70">Tell us the problem. We will say honestly whether we can solve it.</p>
                        </div>
                        <RouterLink to="/contact" class="btn btn-sun shrink-0">Ask for a custom quote</RouterLink>
                    </div>
                </div>
            </LoadState>
        </div>
    </div>
</template>
