<script setup>
import ServiceRow from './ServiceRow.vue';
import { categories } from '../lib/site';
import { content, loadContent } from '../lib/api';

const inCategory = (key) => content.services.filter((s) => s.category === key);
</script>

<template>
    <div v-if="content.ready" class="grid gap-x-10 gap-y-12 lg:grid-cols-3">
        <section v-for="category in categories" :key="category.key" :aria-labelledby="`cat-${category.key}`">
            <h3 :id="`cat-${category.key}`" class="text-2xl">{{ category.label }}</h3>
            <p class="mb-5 mt-1 text-body">{{ category.blurb }}</p>
            <ServiceRow v-for="service in inCategory(category.key)" :key="service.slug" :service="service" />
        </section>
    </div>

    <div v-else-if="content.failed" class="rounded-xl border border-line bg-surface p-6" role="alert">
        <p class="font-semibold">The services list did not load.</p>
        <p class="mt-1 text-body">Check your connection, then try again.</p>
        <button type="button" class="btn btn-outline mt-4" @click="content.failed = false; loadContent()">Try again</button>
    </div>

    <p v-else class="text-muted" aria-live="polite">Loading services…</p>
</template>
