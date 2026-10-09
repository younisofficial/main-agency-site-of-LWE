<script setup>
import ChatIcon from './ChatIcon.vue';
import PhoneIcon from './PhoneIcon.vue';
import { site, whatsappLink, phoneLink } from '../lib/site';

defineProps({
    title: { type: String, default: 'How to start — 3 easy steps' },
});

const steps = [
    { title: 'Choose a package', text: 'Look at our prices. Not sure which one? Just ask us — we will help you choose.' },
    { title: 'Send us a WhatsApp message', text: 'Tell us your business name and what you need. Or call us. We reply within one working day.' },
    { title: 'Pay 50% and we start', text: 'Pay half to start. Pay the other half when your work is ready and you are happy.' },
];
</script>

<template>
    <section class="section band-night" aria-labelledby="steps-heading">
        <div class="wrap">
            <h2 id="steps-heading" class="h-section max-w-2xl">{{ title }}</h2>

            <ol class="mt-10 grid gap-5 md:grid-cols-3">
                <li v-for="(step, index) in steps" :key="step.title" class="rounded-2xl border border-white/10 bg-white/5 p-6">
                    <span class="grid size-12 place-items-center rounded-full bg-sun font-display text-2xl font-extrabold text-night" aria-hidden="true">
                        {{ index + 1 }}
                    </span>
                    <h3 class="mt-4 text-xl">
                        <span class="sr-only">Step {{ index + 1 }}: </span>{{ step.title }}
                    </h3>
                    <p class="mt-2 text-white/75">{{ step.text }}</p>
                </li>
            </ol>

            <div class="mt-10 flex flex-wrap gap-3">
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg">
                    <ChatIcon class="size-6" /> Message us on WhatsApp
                </a>
                <a :href="phoneLink()" class="btn btn-ghost btn-lg">
                    <PhoneIcon class="size-5" /> Call {{ site.phone }}
                </a>
            </div>
        </div>
    </section>
</template>
