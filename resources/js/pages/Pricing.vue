<script setup>
import PageHero from '../components/PageHero.vue';
import PricingTable from '../components/PricingTable.vue';
import CallToAction from '../components/CallToAction.vue';

import { pricingFaqs as faqs } from '../lib/site';
</script>

<template>
    <PageHero
        title="Pricing"
        text="Clear starting prices in US dollars. Choose a category, compare three plans, and pick the one closest to what you need."
    />

    <section class="section">
        <div class="wrap">
            <PricingTable />
            <p class="mt-8 text-body">
                Need something that is not listed?
                <RouterLink to="/contact" class="link">Ask for a custom quote</RouterLink>.
            </p>
        </div>
    </section>

    <section class="section border-y border-line bg-surface">
        <div class="wrap grid gap-10 lg:grid-cols-[1fr_2fr]">
            <h2 class="h-section">Questions about pricing</h2>
            <div class="space-y-3">
                <details v-for="faq in faqs" :key="faq.q" class="group rounded-2xl border border-line bg-white px-6 py-5 open:border-accent">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-lg font-semibold text-ink [&::-webkit-details-marker]:hidden">
                        {{ faq.q }}
                        <svg viewBox="0 0 20 20" class="size-5 shrink-0 transition-transform group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                            <path d="M10 4v12M4 10h12" />
                        </svg>
                    </summary>
                    <p class="mt-3 max-w-2xl text-body">{{ faq.a }}</p>
                </details>
            </div>
        </div>
    </section>

    <CallToAction />
</template>
