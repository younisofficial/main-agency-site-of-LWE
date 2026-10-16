<script setup>
import ChatIcon from './ChatIcon.vue';
import PhoneIcon from './PhoneIcon.vue';
import { site, whatsappLink, phoneLink } from '../lib/site';
</script>

<template>
    <section class="section">
        <div class="wrap">
            <div v-reveal="'zoom'" class="relative overflow-hidden rounded-3xl bg-accent px-7 py-12 text-white sm:px-12 sm:py-16">
                <span class="absolute -right-16 -top-24 size-72 rounded-full bg-mint/25" aria-hidden="true"></span>
                <span class="absolute -bottom-28 right-40 size-56 rounded-full bg-sun/30" aria-hidden="true"></span>
                <div class="relative flex flex-col items-start gap-8 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="h-section text-white!">Ready to start?</h2>
                        <p class="mt-3 max-w-xl text-lg text-white/85">
                            Send us a WhatsApp message or call us. Tell us what you need and we will tell you the price and time.
                        </p>
                    </div>
                    <div class="flex shrink-0 flex-wrap gap-3">
                        <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-sun btn-lg">
                            <ChatIcon class="size-6" /> WhatsApp us
                        </a>
                        <a :href="phoneLink()" class="btn btn-ghost btn-lg">
                            <PhoneIcon class="size-5" /> Call {{ site.phone }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
