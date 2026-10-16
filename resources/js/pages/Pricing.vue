<script setup>
import PageHero from '../components/PageHero.vue';
import PricingTable from '../components/PricingTable.vue';
import NextSteps from '../components/NextSteps.vue';
import ChatIcon from '../components/ChatIcon.vue';
import { pricingFaqs as faqs, whatsappLink } from '../lib/site';

const goodToKnow = [
    'All prices are in Pakistani Rupees (PKR).',
    'One-time payment for the website.',
    'Fast delivery — small websites are ready in a few days.',
    'Domain and hosting are paid separately. We tell you the cost first.',
];
</script>

<template>
    <PageHero title="Our prices" text="3 simple packages for every type of business. Choose yours and press “Order on WhatsApp”. That's it.">
        <ul class="mt-8 grid max-w-3xl gap-3 sm:grid-cols-2">
            <li
                v-for="(item, i) in goodToKnow"
                :key="item"
                v-reveal="{ dir: i % 2 ? 'right' : 'left', delay: i * 80 }"
                class="flex gap-2.5 rounded-xl border border-line bg-white px-4 py-3 text-ink shadow-sm"
            >
                <svg viewBox="0 0 20 20" class="mt-0.5 size-5 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 10.5l4 4 8-9" />
                </svg>
                {{ item }}
            </li>
        </ul>
    </PageHero>

    <section class="section">
        <div class="wrap">
            <PricingTable />

            <div v-reveal="'zoom'" class="mt-16 flex flex-col gap-6 rounded-2xl border-2 border-dashed border-accent/40 bg-accent-soft/50 p-7 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-2xl">Logo, video editing, ads, SEO or an app?</h2>
                    <p class="mt-2 max-w-2xl text-body">
                        The price depends on the work. Send us a WhatsApp message with what you need and we will tell you the price.
                    </p>
                </div>
                <a :href="whatsappLink('Assalam o Alaikum! I want to know the price for: ')" target="_blank" rel="noopener" class="btn btn-whatsapp shrink-0">
                    <ChatIcon class="size-5" /> Ask the price
                </a>
            </div>
        </div>
    </section>

    <NextSteps title="How to order — 3 easy steps" />

    <section class="section">
        <div class="wrap grid gap-10 lg:grid-cols-[1fr_2fr]">
            <h2 v-reveal="'left'" class="h-section">Common questions</h2>
            <div class="space-y-3">
                <details v-for="(faq, i) in faqs" :key="faq.q" v-reveal="{ dir: 'right', delay: i * 60 }" class="group rounded-2xl border border-line bg-white px-6 py-5 open:border-accent">
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
</template>
