<script setup>
import ServiceCard from './ServiceCard.vue';
import LoadState from './LoadState.vue';
import ChatIcon from './ChatIcon.vue';
import { content } from '../lib/api';
import { whatsappLink } from '../lib/site';
</script>

<template>
    <LoadState what="services">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <ServiceCard v-for="service in content.services" :key="service.slug" :service="service" />

            <div class="band-night flex flex-col justify-between gap-6 rounded-2xl p-7 sm:col-span-2 lg:col-span-3 lg:flex-row lg:items-center">
                <div>
                    <h3 class="text-2xl">Need something else?</h3>
                    <p class="mt-2 text-white/75">Tell us what you need on WhatsApp. We will tell you honestly if we can do it, and the price.</p>
                </div>
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp shrink-0">
                    <ChatIcon class="size-5" /> Ask on WhatsApp
                </a>
            </div>
        </div>
    </LoadState>
</template>
