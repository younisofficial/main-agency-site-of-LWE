<script setup>
import { whatsappLink } from '../lib/site';
</script>

<template>
    <section class="section">
        <div class="wrap">
            <div class="relative overflow-hidden rounded-3xl bg-accent px-7 py-12 text-white sm:px-12 sm:py-16">
                <span class="absolute -right-16 -top-24 size-72 rounded-full bg-mint/25" aria-hidden="true"></span>
                <span class="absolute -bottom-28 right-40 size-56 rounded-full bg-sun/30" aria-hidden="true"></span>
                <div class="relative flex flex-col items-start gap-8 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="h-section text-white!">Tell us what you are building.</h2>
                        <p class="mt-3 max-w-xl text-lg text-white/80">We reply within one working day with questions, a timeline and a price.</p>
                    </div>
                    <div class="flex shrink-0 flex-wrap gap-3">
                        <RouterLink to="/contact" class="btn btn-sun">Get a free quote</RouterLink>
                        <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-ghost">Chat on WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
